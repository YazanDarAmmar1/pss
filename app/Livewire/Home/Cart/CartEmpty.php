<?php

namespace App\Livewire\Home\Cart;

use Livewire\Component;

class CartEmpty extends Component
{
    public function close()
    {
        $this->dispatch('hide-user-empty-basket-box-modal');
    }

    public function render()
    {
        return view('livewire.home.cart.cart-empty');
    }
}
