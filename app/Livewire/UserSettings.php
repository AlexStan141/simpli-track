<?php

namespace App\Livewire;

use App\Models\Company;
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
    public $role_id;
    public $phone;
    public $country;
    public $companies;
    public $company_id;
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
            'role_id' => ['required', 'integer', 'min:1', 'max:' . Role::all()->count()],
            'phone' => [
                'required',
                'string',
                'min:7',
                'max:20',
                'regex:/^\+?[0-9\s\-\(\)]+$/'
            ],
            'country' => ['required'],
            'company_id' => ['required', 'integer', 'min:1', 'max:' . Company::all()->count()]
        ]);

        User::create([
            'first_name' => $this->firstName,
            'last_name' => $this->lastName,
            'email' => $this->email,
            'phone' => $this->phone,
            'password' => $this->password,
            'company_id' => Auth::user()->company->id,
            'role_id' => $this->role_id,
            'country' => $this->country,
        ]);

        $this->dispatch("user_list_changed");
        return back()->with('success', 'User saved successfully');
    }

    public function render()
    {
        return view('livewire.user-settings');
    }

    public function mount()
    {
        $this->roles = Role::pluck('name', 'id');
        $this->role_id = Role::all()->first()->id;
        $this->companies = Company::pluck('name', 'id');
        $this->company_id = Company::all()->first()->id;
    }
}
