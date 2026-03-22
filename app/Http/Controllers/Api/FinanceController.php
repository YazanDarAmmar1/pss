<?php

namespace App\Http\Controllers\Api;

use App\Enums\InvoiceStatus;
use App\Enums\PaymentMethods;
use App\Enums\PaymentStatus;
use App\Events\ReceiptCreated;
use App\Http\Controllers\Controller;
use App\Models\PaymentTransaction;
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

}
