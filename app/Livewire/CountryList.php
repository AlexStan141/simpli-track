<?php

namespace App\Livewire;

use App\Models\Country;
use App\Models\Region;
use Livewire\Component;

class CountryList extends Component
{
    protected $listeners = ['update_selected_region_in_country_list' => 'update_selected_region_in_country_list'];
    public $regions;
    public $selected_region_id;
    public $countries;

    public function render()
    {
        return view('livewire.country-list');
    }

    public function update_selected_region_in_country_list($payload)
    {
        $this->selected_region_id = $payload['selected_region_id'];
        $this->countries =  $payload['selected_region_id'] ?
            Country::withTrashed()->where('region_id', $payload['selected_region_id'])->get() : collect();
    }

    public function update_parent_selected_region($region_id)
    {
        $this->countries = $region_id ?
            Country::where('region_id', $region_id)->get() : collect();
        $this->dispatch('update_parent_selected_region', [
            'selected_region_id' => $region_id,
            'source' => 'country_list'
        ]);
    }

    public function mount()
    {
        $this->regions = Region::withTrashed()->get();
        $this->selected_region_id = Region::withTrashed()->first() ? Region::withTrashed()->first()->id : null;
        $this->countries =  $this->selected_region_id ?
            Country::withTrashed()->where('region_id', $this->selected_region_id)->get() : collect();
    }
}
