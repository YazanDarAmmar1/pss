<?php

namespace App\Livewire\Layouts\Home;

use App\Services\CartService;
use Livewire\Attributes\On;
use Livewire\Component;

class Header extends Component
{
    public $cartCount = 0;

    public function mount(CartService $cartService)
    {
        $this->cartCount = $cartService->getCount();
    }

    #[On('cart-updated')]
    public function updateCartCount(CartService $cartService)
    {
        $this->cartCount = $cartService->getCount();
    }

    public function userBasketBoxModal()
    {
        if ($this->cartCount > 0) {
            $this->dispatch('show-user-basket-box-modal');
        } else {
            $this->dispatch('show-user-empty-basket-box-modal');
        }
    }

    public function render()
    {
        return view('livewire.layouts.home.header');
    }
}
