<?php

namespace App\Livewire\Home;

use App\Models\BoardMember;
use Livewire\Component;

class AboutUs extends Component
{
    public function render()
    {
        return view('livewire.home.about-us',[
            'members' => BoardMember::all(),
        ])->layout('layouts.app');
    }
}
