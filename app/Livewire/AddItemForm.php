<?php

namespace App\Livewire;

use Livewire\Component;

class AddItemForm extends Component
{
    protected $listeners = [
        'update_add_item_form_selected_region' => 'update_add_item_form_selected_region',
        'update_add_item_form_selected_currency' => 'update_add_item_form_selected_currency',
        'update_add_item_form_selected_country' => 'update_add_item_form_selected_country'
    ];
    public $entity;
    public $value_to_add;
    public $selected_region;
    public $selected_currency;
    public $selected_country;
    public function update_add_item_form_selected_region($payload){
        $this->selected_region = $payload['value'];
    }
    public function update_add_item_form_selected_currency($payload){
        $this->selected_currency = $payload['value'];
    }
    public function update_add_item_form_selected_country($payload){
        $this->selected_country = $payload['value'];
    }
    public function render()
    {
        return view('livewire.add-item-form');
    }
}
