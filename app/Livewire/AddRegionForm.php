<?php

namespace App\Livewire;

use App\Models\Region;
use Livewire\Component;

class AddRegionForm extends Component
{
    public $regionToAdd;
    public function addRegion()
    {
        Region::create([
            'name' => $this->regionToAdd,
            'selected' => true,
            'selected_before_save' => true
        ]);
        $this->regionToAdd = '';
        $this->dispatch('region_list_updated');
    }
    public function render()
    {
        return view('livewire.add-region-form');
    }

    public function mount()
    {
        $this->regionToAdd = '';
    }
}
