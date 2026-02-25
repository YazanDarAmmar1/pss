<?php

namespace App\Livewire\Home;

use App\Services\AuthServices;
use Livewire\Component;

class Login extends Component
{
    public $email;
    public $password;

    public function render()
    {
        return view('livewire.home.login')->layout('layouts.app');
    }

    public function login()
    {

        $authService = new AuthServices();
        $result = $authService->login([
            'email' => $this->email,
            'password' => $this->password,
        ]);

        if ($result['status']) {
            return redirect()->intended($result['redirect']);
        }

        $this->addError('email', $result['error']);
        $this->resetInputFields();

    }

    public function resetInputFields()
    {
        $this->reset([
            'password',
        ]);
    }
}
