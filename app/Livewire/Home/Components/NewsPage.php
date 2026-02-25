<?php

namespace App\Livewire\Home\Components;

use App\Models\News;
use Livewire\Component;

class NewsPage extends Component
{
    public $news;

    public function mount()
    {
        $this->news = News::active()->orderBy('created_at','desc')->limit(3)->get();
    }
    public function render()
    {
        return view('livewire.home.components.news-page');
    }
}
