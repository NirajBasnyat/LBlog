<?php

namespace App\Http\Livewire;

use App\Models\Admin\Role;
use Livewire\Component;
use Livewire\WithPagination;

class Roles extends Component
{
    use WithPagination;

    public $perPage = 5;
    public $searchTerm = '';

    public function render()
    {
        return view('livewire.roles', [
            'roles' => Role::with('permissions')->latest()->search(trim($this->searchTerm))->simplePaginate($this->perPage)
        ]);
    }

    public function updatingPerPage()
    {
        $this->resetPage();
    }

}
