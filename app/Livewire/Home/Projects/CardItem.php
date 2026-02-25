<?php

namespace App\Livewire\Home\Projects;

use App\Services\CartService;
use Livewire\Component;

class CardItem extends Component
{
    public $project;
    public $amount = 1;

    public function rules()
    {
        return [
            'amount' => 'required|numeric|min:0.1',
        ];
    }

    public function mount($project): void
    {
        $this->project = $project;
        $this->amount = $this->project->default_amount;
    }

    public function render()
    {
        return view('livewire.home.projects.card-item');
    }

    public function increment()
    {
        $this->amount += $this->project->default_amount;
    }

    public function decrement()
    {
        $step = $this->project->default_amount ?? 1;
        $minAmount = $step;

        if ($this->amount > $minAmount) {
            $this->amount -= $step;
        }
    }

    public function addToCart($redirect = null)
    {
        $this->validate();
        app(CartService::class)->add($this->project->id, $this->amount);
        if ($redirect) {
            return redirect()->route('checkout');
        } else {
            $this->dispatch('show-user-basket-added-modal');
            $this->dispatch('cart-updated');
        }
    }
}
