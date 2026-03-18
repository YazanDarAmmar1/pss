<?php

namespace App\Livewire\Home;

use App\Services\AuthServices;
use Livewire\Component;

class Login extends Component
{
    public function render()
    {
        return view('livewire.home.login')->layout('layouts.app');
    }
}
