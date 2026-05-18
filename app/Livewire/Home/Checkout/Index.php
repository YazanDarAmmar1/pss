<?php

namespace App\Livewire\Home\Checkout;

use App\Enums\PaymentStatus;
use App\Services\BenefitPayWindow;
use App\Services\EazyPayCore;
use App\Services\PaymentServices;
use Livewire\Attributes\On;
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

    #[On('benefit-pay-check-payment')]
    public function resolveBenefitPay(...$args)
    {
        $payment_gateway = new PaymentServices();
        $payment_gateway->benefitPayMakePayment(
            $args[4],
            $args[6]
        );
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
                    if ($pay['status']) {
                        return redirect($pay['transaction']->payment_url);
                    } else {
                        info('error payment:' . ' ' . $pay['error']);
                    }
                }
                if ($this->payment_type == 2) {
                    $benefitPayWindow = new BenefitPayWindow($transaction->no, $transaction->amount_human);
                    $benefitPayWindow->calculateHash();
                    $benefitPayParams = $benefitPayWindow->getTransaction();

                    $transaction->update(['status' => PaymentStatus::Pending]);
                    $this->dispatch('pay-by-benefit-payment', $benefitPayParams);

                }
            }

        }
    }
}
