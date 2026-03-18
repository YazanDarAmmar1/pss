<?php

namespace App\Livewire\Home\Auth;

use App\Services\AuthServices;
use Livewire\Component;

class Login extends Component
{
    public $email;
    public $password;
    public $redirect;

    public function mount($redirect = null)
    {
        $this->redirect = $redirect;
    }

    public function render()
    {
        return view('livewire.home.auth.login');
    }

    public function login()
    {
        $authService = new AuthServices();
        $result = $authService->login(credentials: [
            'email' => $this->email,
            'password' => $this->password,
        ], redirectTo: $this->redirect);

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
