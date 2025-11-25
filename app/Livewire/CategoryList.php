<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Component;

class CategoryList extends Component
{
    protected $listeners = ['category_list_updated' => 'render'];
    public $categories;
    public function render()
    {
        $this->categories = Category::all();
        return view('livewire.category-list');
    }

    public function mount()
    {
        $this->categories = Category::all();
    }
}
