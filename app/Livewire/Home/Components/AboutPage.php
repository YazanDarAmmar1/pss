<?php

namespace App\Livewire\Home\Components;

use App\Models\Setting;
use Livewire\Component;

class AboutPage extends Component
{
    public $settings;
    public function mount()
    {
        $this->settings = Setting::pluck('value','key')->toArray();
    }
    public function render()
    {
        return view('livewire.home.components.about-page');
    }
}
