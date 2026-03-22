<?php

namespace App\Livewire\Home\Cart;

use App\Services\CartService;
use Livewire\Attributes\On;
use Livewire\Component;

class CartUpdate extends Component
{
    public $cartItems = [];
    public $cartTotal = 0;

    public function mount(CartService $cartService)
    {
        $this->loadCart($cartService);
    }

    #[On('cart-updated')]
    public function loadCart(CartService $cartService)
    {
        $data = $cartService->all();
        $this->cartItems = $data['items'];
        $this->cartTotal = $data['total'];
    }


    public function render()
    {
        return view('livewire.home.cart.cart-update')->layout('layouts.app');
    }
}
