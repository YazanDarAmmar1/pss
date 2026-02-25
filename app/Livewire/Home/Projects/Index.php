<?php

namespace App\Livewire\Home\Projects;

use App\Models\Category;
use App\Models\Project;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search;
    public $selected_category;

    protected $queryString = ['search' => ['except' => ''], 'selected_category' => ['except' => '']];

    public function updated()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.home.projects.index')->layout('layouts.app');
    }

    public function selectedCategory($category_id = null)
    {
        $this->selected_category = $category_id;
        $this->resetPage();
    }

    public function getProjectListProperty()
    {
        return Project::Published()
            ->when($this->search, function ($query) {
                $query->where('name->ar', 'like', '%' . $this->search . '%')
                ->orWhere('name->en', 'like', '%' . $this->search . '%');
            })
            ->when($this->selected_category, function ($query) {
                $query->where('category_id', $this->selected_category);
            })
            ->paginate(6);
    }

    public function getProjectCategoryProperty()
    {
        return Category::Active()->get();
    }
}
