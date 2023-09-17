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

    public function delete(User $user)
    {
        $user->delete();
    }

    public function render()
    {
        $users = User::search($this->search)
            // when() fica responsavel por adicionar determinada clasula à uma consulta, somente se a condição passada como 1º parâmetro for true.
            // neste caso, somente se a variavel $this->admin não for uma string vazia. se for vazia, irá retornar todos os tipos de usuário (admin e usuário comum).
            ->when($this->admin !== '', function ($query) {
                $query->where('is_admin', $this->admin);
            })
            ->paginate($this->perPage);

        return view('livewire.users-table', compact('users'));
    }
}
