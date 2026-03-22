<?php

namespace App\Livewire\Home\Auth;

use App\Models\Country;
use App\Services\AuthServices;
use App\Services\CartService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class Register extends Component
{
    public $name;
    public $email;
    public $password;
    public $password_confirmation;
    public $phone;
    public $country_id = 1;
    public $otp;
    public $otpCooldown = 0;
    public $country_code = 1;
    public $redirect;

    public function mount($redirect = null)
    {
        $this->redirect = $redirect;
    }

    public function render()
    {
        return view('livewire.home.auth.register', [
            'countries' => Country::all(),
        ]);
    }

    public function register()
    {
        try {
            $authService = new AuthServices();
            $result = $authService->register($this->all(), $this->redirect);

            if ($result['status']) {
                if ($this->redirect) {
                    $currentSessionId = Session::getId();
                    Auth::guard('app')->login($result['user']);
                    (new CartService())->mergeSessionCartToUser(\auth('app')->user()->id, $currentSessionId);

                    return redirect()->intended($result['redirect']);
                }
                $this->dispatch('registered');
                $this->reset();
            }
        } catch (ValidationException $e) {
            $this->setErrorBag($e->validator->getMessageBag());
        }
    }

    public function sendOtp()
    {
        $this->validate([
            'email' => 'required|email|unique:app_users,email',
        ]);

        app(AuthServices::class)->sendEmailOtp($this->email);

        $this->otpCooldown = 60;
    }

    public function decrementOtpCooldown()
    {
        if ($this->otpCooldown > 0) {
            $this->otpCooldown--;
        }
    }

    public function getSelectedCountryProperty()
    {
        return Country::find($this->country_id);
    }
}
