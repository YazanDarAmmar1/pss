<?php

namespace App\Livewire\User;

use App\Models\AppUser;
use App\Models\Country;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProfileSetting extends Component
{
    use WithFileUploads;

    public AppUser $user;
    public $selectedCountry;
    public $avatar;

    public $current_password;
    public $new_password;
    public $new_password_confirmation;
    public $saved = false;

    protected $rules = [
        'user.phone' => 'required|numeric',
        'user.country_id' => 'required|exists:countries,id',
        'avatar' => 'nullable|image|max:3048',
    ];

    public function mount()
    {
        $this->user = auth()->guard('app')->user()->load('country');
        $this->selectedCountry = $this->user->country;
    }

    public function updated($propertyName, $value)
    {
        if ($propertyName === 'user.country_id') {
            $this->selectedCountry = Country::find($value);
        }
    }

    public function save()
    {
        $this->validate();
        $this->saved = false;


        if ($this->avatar) {
            if ($this->user->image_path && Storage::disk('files')->exists($this->user->image_path)) {
                Storage::disk('files')->delete($this->user->image_path);
            }
            $this->user->image_path = $this->avatar->store('image_profile', 'files');
            $this->avatar = null;
        }

        if ($this->current_password || $this->new_password) {
            $this->validate([
                'current_password' => 'required',
                'new_password' => 'required|min:8|confirmed',
            ]);

            if (!Hash::check($this->current_password, $this->user->password)) {
                $this->addError('current_password', 'كلمة السر الحالية غير صحيحة');
                return;
            }

            $this->user->password = Hash::make($this->new_password);
            $this->reset(['current_password', 'new_password', 'new_password_confirmation']);
        }

        $this->user->save();
        $this->saved = true;

    }

    public function render()
    {
        return view('livewire.user.profile-setting', [
            'countries' => Country::all(),
        ])->layout('layouts.app');
    }
}
