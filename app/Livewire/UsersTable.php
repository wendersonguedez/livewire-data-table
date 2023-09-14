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
        return view('livewire.users-table', [
            'users' => User::search($this->search)
                /* se $this->$admin for uma string vazia, não será feita uma pesquisa, então mostrará todos os usuários */
                ->when($this->admin !== '', function ($query) {
                    dd("entrou");
                    $query->where('is_admin', $this->admin);
                })
                ->paginate($this->perPage),
        ]);
    }
}
