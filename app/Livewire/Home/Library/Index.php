<?php

namespace App\Livewire\Home\Library;

use App\Models\Book;
use App\Models\BookCategory;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    public $category_id;
    public $search;


    public function render()
    {
        return view('livewire.home.library.index')->layout('layouts.app');
    }

    public function filterByCategory($id)
    {
        $this->category_id = $id;
        $this->resetPage();
    }

    public function getBookCategoryProperty()
    {
        return BookCategory::all();
    }


    public function getBooksProperty()
    {
        return Book::query()
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('name->ar', 'like', '%' . $this->search . '%')
                        ->orWhere('name->en', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->category_id, function ($query) {
                $query->where('book_category_id', $this->category_id);
            })
            ->paginate(6);
    }

}
