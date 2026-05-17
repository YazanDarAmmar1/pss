<?php

namespace App\Livewire\Home\Components;

use App\Models\Setting;
use Livewire\Component;

class ContactUsPage extends Component
{
    public function render()
    {
        return view('livewire.home.components.contact-us-page', [
            'settings' => Setting::pluck('value', 'key')->toArray(),

        ]);
    }
}
