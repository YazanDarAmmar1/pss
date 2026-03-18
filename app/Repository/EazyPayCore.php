<?php

namespace App\Repository;

use App\Models\PaymentTransaction;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class EazyPayCore
{
    private string $secretKey;
    private string $appId;
    private string $merchantId;
    private string $endpoint;
    private string $webhookUrl;
    private string $currency = 'BHD';

    private string $amount;
    private string $invoiceId;
    private array $paymentMethods;
    private PaymentTransaction $transaction;

    public function __construct(PaymentTransaction $transaction, array $paymentMethods)
    {
        $this->appId = config('services.eazy_pay.app_id');
        $this->merchantId = config('services.eazy_pay.merchant_id');
        $this->secretKey = config('services.eazy_pay.secret_key');
        $this->endpoint = config('services.eazy_pay.endpoint');
        $this->webhookUrl = config('services.eazy_pay.webhook_url');

        $this->transaction = $transaction;
        $this->amount = number_format((float) $transaction->amount, 3, '.', '');
        $this->invoiceId = $transaction->no;
        $this->paymentMethods = $paymentMethods;
    }

    public function generatePaymentUrl(): array
    {
        if ($this->transaction->global_transaction_id) {
            return [
                'status' => true,
                'transaction' => $this->transaction,
            ];
        }

        $timestamp = (string)floor(microtime(true) * 1000);
        $msg = $timestamp . $this->currency . $this->amount . $this->appId;
        $secretHash = hash_hmac('sha256', $msg, $this->secretKey);

        $user = $this->transaction->user;

        $nameParts = explode(' ', $user?->name ?? '', 2);
        $firstName = !empty($nameParts[0]) ? $nameParts[0] : 'Guest';
        $lastName  = !empty($nameParts[1]) ? $nameParts[1] : 'User';

        $payload = [
            'appId' => $this->appId,
            'invoiceId' => $this->invoiceId,
            'currency' => $this->currency,
            'amount' => $this->amount,
            'paymentMethod' => implode(',', $this->paymentMethods),
            'firstName' => $firstName,
            'lastName' => $lastName,
            'customerEmail' => $user?->email,
            'customerCountryCode' => '973',
            'customerMobile' => $user?->phone ?? '00000000',
            'webhookUrl' => $this->webhookUrl,
            'returnUrl' => config('services.eazy_pay.return_url'),
        ];
        Log::info('EazyPay Request', [
            'headers' => [
                'Secret-Hash' => $secretHash,
                'Timestamp'   => $timestamp,
            ],
            'payload' => $payload,
            'msg_used_for_hash' => $msg,
        ]);
        try {
            $response = Http::withHeaders([
                'Secret-Hash' => $secretHash,
                'Timestamp' => $timestamp,
                'Content-Type' => 'application/json; charset=utf-8',
            ])->post($this->endpoint . '/createInvoice', $payload);

            $responseJson = $response->json();

            if ($response->ok() && Arr::get($responseJson, 'result.code') == '1') {
                $this->transaction->update([
                    'global_transaction_id' => Arr::get($responseJson, 'data.0.globalTransactionsId'),
                    'payment_url' => Arr::get($responseJson, 'data.0.paymentUrl'),
                ]);

                return [
                    'status' => true,
                    'transaction' => $this->transaction->fresh(),
                ];
            }

            Log::warning('EazyPay invoice creation failed', [
                'transaction' => $this->invoiceId,
                'response' => $responseJson,
            ]);

            return [
                'status' => false,
                'error' => Arr::get($responseJson, 'result.description', 'لا يمكن إتمام العملية'),
            ];

        } catch (\Exception $e) {
            Log::error('EazyPay request error: ' . $e->getMessage());

            return [
                'status' => false,
                'error' => 'حدث خطأ أثناء الاتصال ببوابة الدفع',
            ];
        }
    }
}
