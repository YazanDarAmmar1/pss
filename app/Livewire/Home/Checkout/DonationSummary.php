<?php

namespace App\Livewire\Home\Checkout;

use App\Services\CartService;
use Livewire\Component;

class DonationSummary extends Component
{
    public function render(CartService $cartService)
    {
        $cart = $cartService->all();

        return view('livewire.home.checkout.donation-summary',
            [
                'cartItems' => $cart['items'],
                'cartTotal' => $cart['total'],
            ]);
    }
}
