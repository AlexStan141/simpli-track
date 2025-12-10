<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Component;

class CategoryList extends Component
{
    protected $listeners = ['category_list_updated' => 'render',
                            'edit_category' => 'start_edit'];
    public $categories;
    public $category_to_edit;
    public function render()
    {
        $this->categories = Category::all();
        return view('livewire.category-list');
    }

    public function mount()
    {
        $this->categories = Category::all();
    }

    public function start_edit($payload){
        $this->category_to_edit = $payload['category'];
    }
}
