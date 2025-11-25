<?php

namespace App\Livewire;

use App\Models\Company;
use App\Models\Region;
use Livewire\Component;

class AddRegionForm extends Component
{
    public $regionToAdd;
    public function addRegion()
    {
        $region = Region::where('name', $this->regionToAdd)->first();
        if($region && $region->company_id){
            return redirect()->route('settings.locations')->with('error', 'Cannot insert the same region twice!');
        }
        Region::create([
            'name' => $this->regionToAdd,
            'company_id' => Company::all()->first()->id,
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
}
