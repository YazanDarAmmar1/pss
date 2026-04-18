<?php

namespace App\Livewire\Home\Components;

use App\Models\Category;
use Livewire\Component;

class CategoryPage extends Component
{
    public $categories;
    public function mount()
    {
        $this->categories = Category::active()->limit(4)->get();
    }
    public function render()
    {
        return view('livewire.home.components.category-page');
    }
}
