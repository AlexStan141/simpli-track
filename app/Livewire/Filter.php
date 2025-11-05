<?php

namespace App\Livewire;
use Livewire\Component;

class Filter extends Component
{
    public $type;
    public $values;
    public $selectedValue;
    public function triggerUpdatedSelectedValue(){
        $this->updatedSelectedValue();
    }
    public function updatedSelectedValue(){
        if($this->type === 'status'){
            $this->dispatch('statusChanged', statusValue : $this->selectedValue);
        }
    }
    public function render()
    {
        return view('livewire.filter');
    }
}
