<?php

namespace App\Livewire\Home\Projects;

use App\Models\Project;
use Livewire\Component;

class Details extends Component
{
    public $project;

    public function mount($no): void
    {
        $this->project = Project::Published()->where('no',$no)->firstOrFail();
    }
    public function render()
    {
        return view('livewire.home.projects.details')->layout('layouts.app');
    }
}
