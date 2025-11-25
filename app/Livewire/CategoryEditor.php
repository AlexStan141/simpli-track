<?php

namespace App\Livewire;

use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CategoryEditor extends Component
{
    public $oldCategory;
    public $categoryId;
    public $editMode = false;
    public $newCategory;

    public function mount($oldCategory, $categoryId)
    {
        $this->oldCategory = $oldCategory;
        $this->newCategory = $oldCategory;
        $this->categoryId = $categoryId;
    }

    public function editCategory()
    {
        $this->editMode = true;
    }

    public function saveCategory()
    {
        $category = Category::find($this->categoryId);
        $category->name = $this->newCategory;
        $category->save();

        $this->oldCategory = $this->newCategory;
        $this->editMode = false;
    }

    public function deleteCategory()
    {
        $category = Category::find($this->categoryId);
        $category->delete();
        $this->dispatch('category_list_changed');
    }
}
