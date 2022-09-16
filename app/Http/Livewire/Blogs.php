<?php

namespace App\Http\Livewire;

use App\Models\Blog;
use Livewire\Component;
use Livewire\WithPagination;

class Blogs extends Component
{
    use WithPagination;

    public $perPage = 5;
    public $searchTerm = '';

    public function render()
    {
        return view('livewire.blogs', [
            'blogs' => auth()->user()->id == 1?
                Blog::latest()->search(trim($this->searchTerm))->simplePaginate($this->perPage)
                : auth()->user()->blogs()->search(trim($this->searchTerm))->simplePaginate($this->perPage)

//            'blogs' => Blog::latest()->search(trim($this->searchTerm))->simplePaginate($this->perPage)
        ]);
    }

    public function updatingPerPage()
    {
        $this->resetPage();
    }
}
