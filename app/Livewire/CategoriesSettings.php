<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;

class CategoriesSettings extends Component
{
    public $categories;
    public $selectedCategory;
    public function render()
    {
        return view('livewire.categories-settings');
    }

    public function mount()
    {
        $this->categories = Category::pluck('name');
    }
}
