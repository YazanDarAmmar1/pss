<?php

namespace App\Livewire\Home\Components;

use App\Models\Slider;
use Livewire\Component;

class SliderPage extends Component
{
    public $sliders;

    public function mount()
    {
        $this->sliders =Slider::active()->get();
    }
    public function render()
    {
        return view('livewire.home.components.slider-page');
    }
}
