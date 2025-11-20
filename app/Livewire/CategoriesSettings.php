<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;
use App\Models\CategoryUser;
use App\Models\Company;
use Illuminate\Support\Facades\Auth;

class CategoriesSettings extends Component
{
    protected $listeners = ['categoryDeleted' => 'loadCategories'];
    public $categories;
    public $categoryToAdd;
    public function render()
    {
        return view('livewire.categories-settings');
    }

    public function addCategory()
    {
        $user = Auth::user();
        $company = $user->company;

        Category::create([
            'name' => $this->categoryToAdd,
            'company_id' => $company->id
        ]);

        $this->categoryToAdd = '';
        $this->loadCategories();
    }

    public function mount()
    {
        $this->loadCategories();
    }

    public function loadCategories()
    {
        $user = Auth::user();
        $company = $user->company;

        $this->categories = Category::where('company_id', $company->id)->get();
    }
}
