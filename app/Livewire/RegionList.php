<?php

namespace App\Livewire;

use App\Models\Region;
use Livewire\Component;

class RegionList extends Component
{
    protected $listeners = ['region_list_updated' => 'render'];
    public $regions;
    public function render()
    {
        return view('livewire.region-list');
    }

    public function mount()
    {
        $this->regions = Region::all();
    }
}
