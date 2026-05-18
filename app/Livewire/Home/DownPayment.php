<?php

namespace App\Livewire\Home;

use App\Models\PaymentTransaction;
use Livewire\Component;

class DownPayment extends Component
{
    public $transaction;

    public function mount($transaction): void
    {
        $this->transaction = PaymentTransaction::down()
            ->where('no', $transaction)
            ->firstOrFail();
    }

    public function render()
    {
        return view('livewire.home.down-payment');
    }
}
