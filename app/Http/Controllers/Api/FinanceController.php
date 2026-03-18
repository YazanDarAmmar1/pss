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
        info($request);

        $rules = [
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
            "dccReceiptText" => 'nullable'

        ];

        $validator = \Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return $validator->errors();
        }
        $validated_data = $validator->validated();

        $global_transaction_id = Arr::get($validated_data, 'globalTransactionsId');
        $transaction_id = Arr::get($validated_data, 'transactionsId');
        $invoice_id = Arr::get($validated_data, 'invoiceId');
        $currency = Arr::get($validated_data, 'currency');
        $amount = Arr::get($validated_data, 'amount');
        $is_paid = Arr::get($validated_data, 'isPaid');
        $paid_on = Arr::get($validated_data, 'paidOn');
        $eazy_payment_method = Arr::get($validated_data, 'paymentMethod');
        $user_token = Arr::get($validated_data, 'userToken');
        $status = Arr::get($validated_data, 'status');
        $auth_code = Arr::get($validated_data, 'authCode');
        $gateway_code = Arr::get($validated_data, 'gatewayCode');
        $auth_resp_code = Arr::get($validated_data, 'authRespCode');
        $error_message = Arr::get($validated_data, 'errorMessage');
        $error_code = Arr::get($validated_data, 'errorCode');
        $payment_id = Arr::get($validated_data, 'paymentId');
        $dcc_uptake = Arr::get($validated_data, 'dccUptake');
        $dcc_ccy = Arr::get($validated_data, 'dccCcy');
        $dcc_amount = Arr::get($validated_data, 'dccAmount');
        $dcc_receipt_text = Arr::get($validated_data, 'dccReceiptText');


        try {


            if ($global_transaction_id) {

                $transaction = PaymentTransaction::where('global_transaction_id', $global_transaction_id)->first();
                if ($transaction) {


                    // start Eazy

                    $eazy_timestamp = $request->header('Eazy-Timestamp');
                    $eazy_signature = $request->header('Eazy-Signature');
                    $eazy_nonce = $request->header('Eazy-Nonce');


                    if ($eazy_timestamp
                        && $eazy_signature
                        && $eazy_nonce
                    ) {
                        $msg = $eazy_timestamp
                            . $eazy_nonce
                            . $global_transaction_id
                            . $is_paid;

                        if (Str::lower($eazy_signature) == Str::lower(hash_hmac(
                                algo: 'sha256',
                                data: $msg,
                                key: env('EAZY_PAY_SECRET_KEY')))
                        ) {


                            if ($is_paid == 1) {

                                $payment_method = PaymentMethods::MASTERCARD->value;
                                if ($eazy_payment_method == 'Apple Pay') {
                                    $payment_method = PaymentMethods::APPLE->value;
                                }

                                if ($transaction->changeStatus(PaymentStatus::Paid->value)) {
                                    $receipt = $transaction->makeReceipt($payment_method);
                                    event(new ReceiptCreated($receipt));
                                }

                            } else {
                                $transaction->changeStatus(PaymentStatus::Failed->value);
                            }
                        } else {
                            info('=====----- Invalid EAZY SIGN -----=====');
                            $transaction->changeStatus(PaymentStatus::Invalid->value);
                        }
                    } else {
                        $transaction->changeStatus(PaymentStatus::Error->value);
                    }
                } else {
                    $transaction->changeStatus(PaymentStatus::Error->value);
                }
            }
        } catch (\Exception $e) {
            info($e->getMessage());
            return $e->getMessage();
        }
    }

}
