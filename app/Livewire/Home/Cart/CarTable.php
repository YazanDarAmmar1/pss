<?php

namespace App\Livewire\Home\Cart;

use App\Services\CartService;
use Livewire\Component;

class CarTable extends Component
{
    public $cartItems = [];
    public $cartTotal = 0;

    public function mount($cartItems = [], $cartTotal = 0)
    {
        $this->cartItems = $cartItems;
        $this->cartTotal = $cartTotal;
    }

    #[On('cart-updated')]
    public function refresh(CartService $cartService)
    {
        $data = $cartService->all();
        $this->cartItems = $data['items'];
        $this->cartTotal = $data['total'];
    }

    public function render()
    {
        return view('livewire.home.cart.car-table');
    }
}
