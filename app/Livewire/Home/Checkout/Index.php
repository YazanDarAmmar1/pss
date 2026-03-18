<?php

namespace App\Livewire\Home\Checkout;

use App\Repository\EazyPayCore;
use App\Services\PaymentServices;
use Livewire\Component;

class Index extends Component
{
    public $payment_type;

    public function rules()
    {
        return [
            'payment_type' => 'required|in:1,2',
        ];
    }

    public function render()
    {
        return view('livewire.home.checkout.index')->layout('layouts.app');
    }

    public function pay()
    {
        $this->validate();
        $paymentServices = new PaymentServices();
        $invoice = $paymentServices->convertCartToInvoice();
        if ($invoice) {
            $transaction = $paymentServices->initiateTransaction($invoice);
            if ($transaction) {
                if ($this->payment_type == 1) {
                    $pay = new EazyPayCore($transaction, [
                        'ALL'
                    ]);
                    $pay = $pay->generatePaymentUrl();
                    dd($pay);
                    if ($pay['status']) {
                        return redirect($pay['transaction']->payment_url);
                    } else {
                        info('error payment:' . ' ' . $pay['error']);
                    }
                }
            }

        }
    }
}
