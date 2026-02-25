<?php

namespace App\Livewire\Home;

use App\Models\BankAccount;
use App\Models\Setting;
use Livewire\Component;

class ContactUs extends Component
{
    public function render()
    {
        return view('livewire.home.contact-us',[
            'settings' =>Setting::pluck('value','key')->toArray(),
            'accounts' => BankAccount::all(),
        ])->layout('layouts.app');
    }
}
