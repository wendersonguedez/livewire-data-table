<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UsersTable extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 5;

    public $admin = '';

    public function render()
    {
        $users = User::search($this->search)
            ->when($this->admin !== '', function ($query) {
                // /* se $this->$admin for uma string vazia, não será feita uma pesquisa, então mostrará todos os usuários */
                $query->where('is_admin', $this->admin);
            })
            ->paginate($this->perPage);

        return view('livewire.users-table', compact('users'));
    }
}
