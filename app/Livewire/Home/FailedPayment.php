<?php

namespace App\Livewire\Home;

use App\Models\PaymentTransaction;
use Livewire\Component;

class FailedPayment extends Component
{
    public $transaction;

    public function mount($transaction): void
    {
        $this->transaction = PaymentTransaction::failed()
            ->where('no', $transaction)
            ->firstOrFail();
    }

    public function render()
    {
        return view('livewire.home.failed-payment')->layout('layouts.app');
    }
}
