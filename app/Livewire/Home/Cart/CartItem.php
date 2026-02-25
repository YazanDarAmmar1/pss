<?php

namespace App\Livewire\Home\Cart;

use App\Services\CartService;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CartItem extends Component
{
    public $item;
    #[Validate('required|numeric|min:0.1')]
    public $amount;

    public function mount($item): void
    {
        $this->item = $item;
    }

    public function render()
    {
        return view('livewire.home.cart.cart-item');
    }
    public function deleteItem($project_id)
    {
        $cartService = new CartService();
        $cartService->remove($project_id);

        if ($cartService->isEmpty()) {
            $this->dispatch('hide-user-basket-box-modal');
        }

        $this->dispatch('cart-updated');
    }

    public function saveAmount()
    {
        $this->validate();

        app(CartService::class)->updateAmount($this->item['id'], $this->amount);

        $this->item['amount'] = $this->amount;
        $this->dispatch('cart-updated');

    }
}
