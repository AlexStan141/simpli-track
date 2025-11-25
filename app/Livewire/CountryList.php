<?php

namespace App\Livewire;

use App\Models\Country;
use App\Models\Region;
use Livewire\Component;

class CountryList extends Component
{
    protected $listeners = ['renderCountries', 'render'];
    public $regions;
    public $selected_region_id;
    public $countries;
    public function render()
    {
        $this->countries = Country::where('region_id', $this->selected_region_id)->get();
        return view('livewire.country-list');
    }

    public function triggerRegionFilterUpdate(){
        $this->updatedRegion();
    }

    public function updatedRegion(){
        $this->countries = Country::where('region_id', $this->selected_region_id)->get();
    }

    public function mount(){
        $this->regions = Region::pluck('name', 'id');
        $this->selected_region_id = Region::all()->first()->id;
        $this->countries = Country::where('region_id', $this->selected_region_id)->get();
    }
}
