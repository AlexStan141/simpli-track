<?php

namespace App\Livewire;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UserSettings extends Component
{
    public $firstName;
    public $lastName;
    public $password;
    public $confirmPassword;
    public $email;
    public $roles;
    public $role;

    public function save(){
        $this->validate([
            'firstName' => ['required', 'min:3', 'max:10'],
            'lastName' => ['required', 'min:3', 'max:10'],
            'password' => [
                'required',
                'string',
                'min:8',
                'max:20',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*#?&]/',
            ],
            'confirmPassword' => ['required', 'same:password'],
            'email' => ['required', 'email'],
        ]);

        User::create([
            'first_name' => $this->firstName,
            'last_name' => $this->lastName,
            'email' => $this->email,
            'phone' => '',
            'password' => $this->password,
            'company_id' => Auth::user()->company->id,
            'role_id' => $this->role
        ]);

        return back()->with('success', 'User saved successfully');
    }

    public function render()
    {
        return view('livewire.user-settings');
    }

    public function mount()
    {
        $this->roles = Role::pluck('name', 'id');
        $this->role = Role::all()->first()->id;
    }
}
