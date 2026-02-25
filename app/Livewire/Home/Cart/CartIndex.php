<?php

namespace App\Livewire\Home\Cart;

use App\Services\CartService;
use Livewire\Attributes\On;
use Livewire\Component;

class CartIndex extends Component
{
    #[On('cart-updated')]
    public function resolveParams()
    {
        $this->dispatch('$refresh');
    }

    public function render(CartService $cartService)
    {
        $data = $cartService->all();

        return view('livewire.home.cart.cart-index', [
            'cartItems' => $data['items'],
            'cartTotal' => $data['total'],
        ]);
    }
}
