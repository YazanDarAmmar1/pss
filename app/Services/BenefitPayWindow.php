<?php

namespace App\Services;

class BenefitPayWindow
{
    public $transaction;

    /**
     * @param $transaction
     */
    public function __construct($transaction_no, $amount)
    {
        $this->transaction['appId'] = env("BENEFIT_PAY_APP_ID");
        $this->transaction['merchantId'] = env("BENEFIT_PAY_MERCHANT_ID");
        $this->transaction['hideMobileQR'] = 0;
        $this->transaction['referenceNumber'] = $transaction_no;
        $this->transaction['showResult'] = 1;
        $this->transaction['transactionAmount'] = number_format(
            (float) str_replace(',', '', $amount),
            3, '.', ''
        );
        $this->transaction['transactionCurrency'] = 'BHD';

    }


    /**
     * @return mixed
     */
    public function getTransaction()
    {
        return $this->transaction;
    }

    /**
     * @param mixed $transaction
     */
    public function setTransaction($transaction): void
    {
        $this->transaction = $transaction;
    }

    public function calculateHash()
    {
        $dataToHash = [
            'appId' => (string) $this->transaction['appId'],
            'merchantId' => (string) $this->transaction['merchantId'],
            'referenceNumber' => (string) $this->transaction['referenceNumber'],
            'transactionAmount' => $this->transaction['transactionAmount'],
            'transactionCurrency' => 'BHD',
        ];


        // ترتيب تصاعدي حسب المفتاح
        ksort($dataToHash);

        $pairs = [];
        foreach ($dataToHash as $key => $value) {
            $pairs[] = $key . '="' . $value . '"';
        }

        $payload = implode(',', $pairs);

        // حساب الـ secureHash
        $this->transaction['secure_hash'] = base64_encode(
            hash_hmac(
                'sha256',
                $payload,
                trim(env('BENEFIT_PAY_SECRET_KEY')),
                true
            )
        );

        $this->transaction['paymentType'] = 'web';
    }




}
