<?php

namespace App\Livewire\Home\Projects;

use App\Models\Project;
use App\Services\CartService;
use Livewire\Component;

class Details extends Component
{
    public $project;
    public $amount = 1;

    public function rules()
    {
        return [
            'amount' => 'required|numeric|min:0.1',
        ];
    }

    public function mount($no): void
    {
        $this->project = Project::Published()->where('no', $no)->firstOrFail();
        $this->amount = $this->project->default_amount;

    }

    public function render()
    {
        return view('livewire.home.projects.details')->layout('layouts.app');
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
