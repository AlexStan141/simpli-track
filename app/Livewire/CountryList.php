<?php

namespace App\Livewire;

use App\Models\Country;
use App\Models\Region;
use Livewire\Component;

class CountryList extends Component
{
    protected $listeners = [
        'country_list_updated' => 'update_countries',
        'region_list_updated' => 'update_regions'
    ];
    public $regions;
    public $selected_region_id;
    public $countries;

    public function update_regions(){
        $this->regions = Region::all();
        $this->selected_region_id = Region::first() ? Region::first()->id : null;
        $this->countries =  $this->selected_region_id ?
            Country::withTrashed()->where('region_id', $this->selected_region_id)->get() : collect();
    }

    public function update_countries(){
        $this->countries =  $this->selected_region_id ?
            Country::withTrashed()->where('region_id', $this->selected_region_id)->get() : collect();
    }

    public function render()
    {
        return view('livewire.country-list');
    }

    public function mount()
    {
        $this->regions = Region::all();
        $this->selected_region_id = Region::first() ? Region::first()->id : null;
        $this->countries =  $this->selected_region_id ?
            Country::withTrashed()->where('region_id', $this->selected_region_id)->get() : collect();
    }
}
