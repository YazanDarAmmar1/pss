<?php

namespace App\Services;

use App\Enums\PaymentMethods;
use App\Enums\PaymentStatus;
use App\Models\PaymentTransaction;




class PaymentServices
{
    /**
     * @throws \Exception
     */
    public function convertCartToInvoice()
    {
        $cartService = new CartService();
        $cart = $cartService->getCart();

        if ($cart->items()->count() === 0) {
            throw new \Exception("Cart is empty.");
        }

        $invoice = $cart->invoices()
            ->where('status', PaymentStatus::Pending)
            ->first();

        if ($invoice) {
            $invoice->update([
                'amount' => $cart->items()->sum('amount'),
            ]);
        } else {
            $invoice = $cart->invoices()->create([
                'user_id' => $cart->user_id,
                'amount' => $cart->items()->sum('amount'),
                'status' => PaymentStatus::Pending->value,
            ]);
        }

        $invoice->items()->delete();

        foreach ($cart->items as $cartItem) {
            $invoice->items()->create([
                'project_id' => $cartItem->project_id,
                'amount' => $cartItem->amount,
            ]);
        }

        return $invoice;
    }

    public function initiateTransaction($invoice)
    {
        return $invoice->transactions()->create([
            'amount' => $invoice->amount,
            'user_id' => $invoice->user_id,
            'created_at' => $invoice->created_at,
        ]);
    }

    public function benefitPayMakePayment($referenceNumber, $merchantId)
    {
        $check_status = new BenefitPayCheckStatus($referenceNumber, $merchantId);
        $result = $check_status->check_status();
        $transaction = PaymentTransaction::where('no', $referenceNumber)->first();
        if ($transaction && $transaction->exists()) {
            if ($result['down'] and $transaction->changeStatus(PaymentStatus::Down->value)) {
                return redirect()->route('down-payment', $transaction->no);
            }
            if ($result['status'] and $transaction->changeStatus(PaymentStatus::Paid->value)) {
                $transaction->makeReceipt(PaymentMethods::BENEFIT->value);
                return redirect()->route('success-payment', $transaction->no);
            } else {
                $transaction->changeStatus(PaymentStatus::Failed->value);
                return redirect()->route('failed-payment', $transaction->no);
            }
        }

        return redirect()->route('home');
    }

}
