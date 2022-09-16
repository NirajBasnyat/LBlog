<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Users extends Component
{
    use WithPagination;

    public $perPage = 5;
    public $searchTerm = '';

    public function render()
    {
        return view('livewire.users',[
            'users' => User::with('permissions')->latest()->search(trim($this->searchTerm))->simplePaginate($this->perPage)

        ]);
    }

    public function updatingPerPage()
    {
        $this->resetPage();
    }
}
