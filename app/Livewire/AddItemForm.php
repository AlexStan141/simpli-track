<?php

namespace App\Livewire;

use Livewire\Component;

class AddItemForm extends Component
{
    public $entity;
    public $value_to_add;
    public function render()
    {
        return view('livewire.add-item-form');
    }
}
