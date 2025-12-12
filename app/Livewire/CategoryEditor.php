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
        $this->dispatch('edit_category', [
            'category' => $this->oldCategory
        ]);
    }

    public function saveCategory()
    {
        $category = Category::find($this->categoryId);
        $category->name = $this->newCategory;
        $category->save();

        $this->oldCategory = $this->newCategory;
    }

    public function deleteCategory()
    {
        $this->dispatch('confirm-delete-modal-display', [
            'entity' => 'category',
            'entity_id' => $this->categoryId,
            'action' => 'delete'
        ]);
    }
}
