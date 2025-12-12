<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Component;

class CategoryList extends Component
{
    protected $listeners = ['category_list_updated' => 'render',
                            'close_other_categories' => 'close_other_categories'];
    public $categories;
    public function render()
    {
        return view('livewire.category-list');
    }

    public function mount()
    {
        $this->categories = Category::withTrashed()->get();
    }

    public function close_other_categories($payload){
        foreach($this->categories as $category){
            if($category->name !== $payload['value']){
                $this->dispatch('close_editable_input', [
                    'old_value' => $category->name,
                    'role' => 'category_settings'
                ]);
            }
        }
    }
}
