<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;
use App\Models\CategoryUser;
use App\Models\Company;
use Illuminate\Support\Facades\Auth;

class CategoriesSettings extends Component
{
    public function render()
    {
        return view('livewire.categories-settings');
    }
}
