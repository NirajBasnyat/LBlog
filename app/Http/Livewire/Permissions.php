<?php

namespace App\Http\Livewire;

use App\Models\Admin\Permission;
use Livewire\Component;
use Livewire\WithPagination;

class Permissions extends Component
{
    use WithPagination;

    public $perPage = 5;
    public $searchTerm = '';

    public function render()
    {
        return view('livewire.permissions',[
            'permissions' => Permission::latest()->search(trim($this->searchTerm))->simplePaginate($this->perPage)
        ]);
    }

    public function updatingPerPage()
    {
        $this->resetPage();
    }

}
