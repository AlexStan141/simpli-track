<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class UserList extends Component
{
    protected $listeners = ["user_list_changed" => "render"];
    public $users;
    public function render()
    {
        $this->users = User::all();
        return view('livewire.user-list');
    }
}
