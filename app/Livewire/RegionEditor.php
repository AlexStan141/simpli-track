<?php

namespace App\Livewire;

use App\Models\Region;
use Livewire\Component;

class RegionEditor extends Component
{
    public $old_region;
    public $region_id;
    public $editMode = false;
    public $new_region;
    public function mount($old_region, $region_id)
    {
        $this->old_region = $old_region;
        $this->new_region = $old_region;
        $this->region_id = $region_id;
    }
    public function editRegion()
    {
        $this->editMode = true;
    }

    public function saveRegion()
    {
        $region = Region::find($this->region_id);
        $region->name = $this->new_region;
        $region->save();

        $this->old_region = $this->new_region;
        $this->editMode = false;
    }

    public function deleteRegion()
    {
        $region = Region::find($this->region_id);
        $region->company_id = null;
        $region->save();
    }

    public function render()
    {
        return view('livewire.region-editor');
    }
}
