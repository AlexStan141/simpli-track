<?php

namespace App\Livewire;

use Livewire\Component;

class Form extends Component
{
    public $values;
    public $entity;
    public $value_to_add;
    public function render()
    {
        return view('livewire.form');
    }
    public function remove_value($value)
    {
        $this->values = array_filter($this->values, function($current_value) use ($value){
            return $current_value !== $value;
        });
        $this->dispatch('add_value_to_list_event', [
            'value' => $value
        ]);
    }

    public function update_value_to_add($value)
    {
        $this->value_to_add = $value;
    }

    public function add_value(){
        $this->dispatch('add_value_to_list_event', [
            'value' => $this->value_to_add
        ]);
    }
}
