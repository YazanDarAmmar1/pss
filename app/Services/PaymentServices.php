<?php

namespace App\Services;

use App\Enums\PaymentStatus;
use App\Models\Invoice;
use App\Models\PaymentTransaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class PaymentServices
{
    /**
     * @throws \Exception
     */
    public function convertCartToInvoice()
    {
        $cart = (new cartService())->getCart();

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

}
