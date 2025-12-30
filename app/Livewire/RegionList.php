<?php

namespace App\Livewire;

use App\Models\Region;
use Livewire\Component;

class RegionList extends Component
{
    protected $listeners = ['region_list_updated' => 'refresh_regions'];
    public $regions;

    public function refresh_regions()
    {
        $this->regions = Region::withTrashed()->get();
    }

    public function render()
    {
        return view('livewire.region-list');
    }

    public function mount()
    {
        $this->regions = Region::withTrashed()->get();
    }
}
