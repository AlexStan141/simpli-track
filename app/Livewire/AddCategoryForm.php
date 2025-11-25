<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Company;
use Livewire\Component;

class AddCategoryForm extends Component
{
    public $categoryToAdd;
    public function addCategory()
    {
        Category::create([
            'name' => $this->categoryToAdd,
            'company_id' => Company::all()->first()->id
        ]);
        $this->categoryToAdd = '';
        $this->dispatch('category_list_updated');
    }

    public function render()
    {
        return view('livewire.add-category-form');
    }
}
