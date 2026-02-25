<?php

namespace App\Livewire\Home\Components;

use App\Models\News;
use Livewire\Component;

class NewsDetailsPage extends Component
{
    public $news;
    public $otherNews;

    public function mount($news_id)
    {
        $this->news = News::active()->findOrFail($news_id);

        $this->otherNews = News::active()
            ->where('id', '!=', $this->news->id)
            ->limit(3)
            ->get();
    }


    public function render()
    {
        return view('livewire.home.components.news-details-page')
            ->layout('layouts.app');
    }

    public function otherNewsProperty()
    {
        return News::active()->where('id', '!=', $this->news->id)->limit(3)->get();
    }
}
