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
            $this->dispatch('statusChanged', ['statusValue' => $this->selectedValue])->to('invoice-template-list-dashboard');
        } else if ($this->type === 'country'){
            $this->dispatch('countryChanged', ['countryValue' => $this->selectedValue])->to('invoice-template-list-dashboard');
        } else {
            $this->dispatch('categoryChanged', ['categoryValue' => $this->selectedValue])->to('invoice-template-list-dashboard');
        }
    }
    public function render()
    {
        return view('livewire.filter');
    }
}
