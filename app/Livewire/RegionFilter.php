<?php

namespace App\Livewire;

use Livewire\Component;

class RegionFilter extends Component
{
    public $selected;
    public $value;

    public function toggle(){
        $this->selected = !$this->selected;
        $this->dispatch('toggleRegion', [
            'selected' => $this->selected,
            'value' => $this->value
        ])->to('invoice-template-list-dashboard');
    }

    public function render()
    {
        return view('livewire.region-filter');
    }
}
