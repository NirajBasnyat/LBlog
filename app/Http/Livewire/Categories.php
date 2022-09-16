<?php

namespace App\Http\Livewire;

use App\Models\Admin\Category;
use Livewire\Component;
use Livewire\WithPagination;

class Categories extends Component
{

    use WithPagination;

    public $perPage = 5;
    public $searchTerm = '';

    public function render()
    {
        return view('livewire.categories', [
            'categories' => Category::latest()->search(trim($this->searchTerm))->simplePaginate($this->perPage)
        ]);
    }

    /* public function updatingSearchTerm()
     {
         $this->resetPage();
     }
    */

     public function updatingPerPage()
     {
         $this->resetPage();
     }

}
