<?php

namespace App\Http\Controllers\Api;

use App\Enums\InvoiceStatus;
use App\Enums\PaymentMethods;
use App\Enums\PaymentStatus;
use App\Events\ReceiptCreated;
use App\Http\Controllers\Controller;
use App\Models\PaymentTransaction;
use App\Services\BenefitPayCheckStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class FinanceController extends Controller
{
    public function eazyPayCallback(Request $request)
    {
        info('========== EAZY WEBHOOK ==========');

        $validator = \Validator::make($request->all(), [
            "globalTransactionsId" => 'required',
            "transactionsId" => 'required',
            "invoiceId" => 'required',
            "currency" => 'required',
            "amount" => 'required',
            "isPaid" => 'required',
            "paidOn" => 'nullable',
            "paymentMethod" => 'nullable',
            "userToken" => 'nullable',
            "status" => 'nullable',
            "authCode" => 'nullable',
            "gatewayCode" => 'nullable',
            "authRespCode" => 'nullable',
            "errorMessage" => 'nullable',
            "errorCode" => 'nullable',
            "paymentId" => 'nullable',
            "dccUptake" => 'nullable',
            "dccCcy" => 'nullable',
            "dccAmount" => 'nullable',
            "dccReceiptText" => 'nullable',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $validated = $validator->validated();

        $globalTransactionId = Arr::get($validated, 'globalTransactionsId');
        $isPaid = Arr::get($validated, 'isPaid');
        $eazyPaymentMethod = Arr::get($validated, 'paymentMethod');

        try {
            $transaction = PaymentTransaction::where('global_transaction_id', $globalTransactionId)->first();

            if (!$transaction) {
                info('Transaction not found: ' . $globalTransactionId);
                return response()->json(['message' => 'Transaction not found'], 404);
            }

            // التحقق من headers الأمان
            $eazyTimestamp = $request->header('Eazy-Timestamp');
            $eazySignature = $request->header('Eazy-Signature');
            $eazyNonce = $request->header('Eazy-Nonce');

            if (!$eazyTimestamp || !$eazySignature || !$eazyNonce) {
                info('Missing Eazy security headers');
                $transaction->changeStatus(PaymentStatus::Error->value);
                return response()->json(['message' => 'Missing security headers'], 400);
            }

            // التحقق من التوقيع
            $msg = $eazyTimestamp . $eazyNonce . $globalTransactionId . $isPaid;
            $expectedSignature = hash_hmac('sha256', $msg, config('services.eazy_pay.secret_key'));

            if (!hash_equals(Str::lower($expectedSignature), Str::lower($eazySignature))) {
                info('Invalid Eazy Signature for transaction: ' . $globalTransactionId);
                $transaction->changeStatus(PaymentStatus::Invalid->value);
                return response()->json(['message' => 'Invalid signature'], 401);
            }

            // معالجة نتيجة الدفع
            if ($isPaid == 1) {
                $paymentMethod = $eazyPaymentMethod === 'Apple Pay'
                    ? PaymentMethods::APPLE->value
                    : PaymentMethods::MASTERCARD->value;

                if ($transaction->changeStatus(PaymentStatus::Paid->value)) {
                    $transaction->makeReceipt($paymentMethod);
                }
            } else {
                $transaction->changeStatus(PaymentStatus::Failed->value);
            }

            return response()->json(['message' => 'Processed successfully'], 200);

        } catch (\Exception $e) {
            info('EazyPay callback error: ' . $e->getMessage());
            return response()->json(['message' => 'Server error'], 500);
        }
    }

    public function benefitResponseURL(Request $request)
    {
        info('BenefitPay raw', [
            'method' => $request->method(),
            'content_type' => $request->header('Content-Type'),
            'raw_body' => $request->getContent(),
            'query' => $request->query(),
        ]);

        // Verify signature header exists
        if (!$request->hasHeader('x-foo-signature')) {
            return self::buildResponse(401, 'Authentication failure');
        }

        // Extract request data
        $signature = $request->header('x-foo-signature');
        $referenceNumber = $request->input('reference_number');
        $merchantId = $request->input('merchant_id');
        $status = $request->input('status');
        $appId = $request->input('app_id');
        $secretToken = env('BENEFIT_PAY_SECRET_CALLBACK_KEY');

        info('BenefitPay callback', [
            'signature' => $signature,
            'secretToken' => $secretToken,
            'referenceNumber' => $referenceNumber,
            'merchantId' => $merchantId,
            'status' => $status,
            'appId' => $appId,
        ]);

        // Validate required parameters
        if (!$status || !$merchantId || !$referenceNumber || !$appId) {
            return self::buildResponse(400, 'Bad Request');
        }

        // Verify HMAC-SHA256 signature
        $encodedJson = json_encode($request->all());
        $hmac = hash_hmac('sha256', $encodedJson, $secretToken, true);
        $isValidSignature = hash_equals($signature, base64_encode($hmac));

        if (!$isValidSignature) {
            return self::buildResponse(401, 'Authentication failure');
        }

        // Validate merchant credentials
        $isValidMerchant = $merchantId === env('BENEFIT_PAY_MERCHANT_ID')
            && $appId === env('BENEFIT_PAY_APP_ID')
            && $status <= 1;

        if (!$isValidMerchant) {
            return self::buildResponse(300, 'Failure');
        }

        // Find transaction
        $transaction = PaymentTransaction::where('no', $referenceNumber)->first();

        if (!$transaction) {
            return self::buildResponse(300, 'Failure');
        }

        // Find invoice
        $invoice = $transaction->Invoice;

        if (!$invoice) {
            return self::buildResponse(300, 'Failure');
        }

        // Check payment status from BenefitPay
        $checkStatus = new BenefitPayCheckStatus($referenceNumber, $merchantId);
        $result = $checkStatus->check_status();

        if ($result['down']) {
            $transaction->changeStatus(PaymentStatus::Down->value);
        }

        // Process payment result
        if ($result['status']) {
            if ($transaction->changeStatus(PaymentStatus::Paid->value)) {
                $transaction->makeReceipt(PaymentMethods::BENEFIT->value);
            }
        } else {
            $transaction->changeStatus(PaymentStatus::Failed->value);
        }

        return self::buildResponse(200, 'Success');
    }

    private static function buildResponse(int $statusCode, string $message): array
    {
        info('BenefitPay callback response', [
            'statusCode' => $statusCode,
            'message' => $message,
        ]);
        return [
            'response' => [
                'statusCode' => $statusCode,
                'message' => $message,
            ],
        ];
    }

}
