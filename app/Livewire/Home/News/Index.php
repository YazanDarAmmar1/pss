<?php

namespace App\Livewire\Home\News;

use App\Models\News;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{

    public function render()
    {
        return view('livewire.home.news.index',[
        'news' => News::Active()->paginate(10)
        ])->layout('layouts.app');
    }
}
