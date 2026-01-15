<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Currency;
use Livewire\Component;

class EditableInputList extends Component
{
    protected $listeners = [
        'editable_input_delete_event' => 'delete_editable_input',
        'editable_input_add_event' => 'add_editable_input'
    ];
    public $values;
    public $role;
    public $nr_columns;
    public function delete_editable_input($payload){
        if($this->role == 'currency_settings'){
            $currency = Currency::where('name', $payload['value']);
            $currency->delete();
            $this->values = Currency::withTrashed()->get();
        }
        else if($this->role == 'categories_settings'){
            $category = Category::where('name', $payload['value']);
            $category->delete();
            $this->values = Category::withTrashed()->get();
        }
    }

    public function close_other_values($value)
    {
        foreach($this->values as $current_value)
        {
            if($current_value !== $value)
            {
                $this->dispatch('close_editable_input', [
                    'value' => $current_value
                ]);
            }
        }
    }

    public function mount(){
        if($this->role == 'currency_settings'){
            $this->values = Currency::withTrashed()->get();
        }
        else if ($this->role == 'categories_settings'){
            $this->values = Category::withTrashed()->get();
        }
    }

    public function add_editable_input($payload){
        if($this->role == 'currency_settings' && $payload['role'] == 'currency'){
            Currency::create(['name' => $payload['value']]);
            $this->values = Currency::withTrashed()->get();
        }
        else if ($this->role == 'categories_settings'){
            $this->values = Category::withTrashed()->get();
        }
    }

    public function render()
    {
        return view('livewire.editable-input-list');
    }
}
