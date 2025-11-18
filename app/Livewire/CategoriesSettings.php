<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

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
        $user = Auth::user();
        $categories_ids = $user->category_users->pluck('category_id');
        $categories = Category::whereIn('id', $categories_ids)->pluck('name');
        $this->categories = $categories;
    }
}
