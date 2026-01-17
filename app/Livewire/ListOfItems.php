<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Company;
use Livewire\Component;

class ListOfItems extends Component
{
    protected $listeners = [
        'add_value_to_list_event' => 'add_value',
        'close_other_values' => 'close_other_values'
    ];
    public $values;
    public $entity;
    public $nr_columns;
    public function add_value($payload)
    {
        if ($this->entity === 'category') {
            Category::create([
                'name' => $payload['value'],
                'company_id' => Company::first()->id
            ]);
            $this->values = Category::all();
        }
    }

    public function close_other_values($payload)
    {
        foreach($this->values as $current_value)
        {
            if($current_value->name !== $payload['value'])
            {
                $this->dispatch('close_editable_input', [
                    'old_value' => $current_value->name,
                    'role' => 'category_settings'
                ]);
            }
        }
    }

    public function mount() {
        $this->values = Category::withTrashed()->get();
    }

    public function render()
    {
        return view('livewire.list-of-items');
    }
}
