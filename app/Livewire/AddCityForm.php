<?php

namespace App\Livewire;

use App\Models\City;
use App\Models\Company;
use App\Models\Country;
use App\Models\Region;
use Livewire\Component;

class AddCityForm extends Component
{
    protected $listeners = [
        'country_list_updated' => 'update_countries',
        'region_list_updated' => 'update_regions',
    ];
    public $cityToAdd;
    public $regions;
    public $selected_region_id;
    public $countries;
    public $selected_country_id;
    public function addCity()
    {
        City::create([
            'country_id' => $this->selected_country_id,
            'name' => $this->cityToAdd,
        ]);
        $this->cityToAdd = '';
        $this->dispatch('city_list_updated');
    }
    public function render()
    {
        return view('livewire.add-city-form');
    }

    public function mount()
    {
        $this->regions = Region::all();
        $this->selected_region_id = Region::first() ? Region::first()->id : null;
        $this->countries =  $this->selected_region_id ?
            Country::where('region_id', $this->selected_region_id)->get() : collect();
        $this->selected_country_id = $this->countries->first() ?
            $this->countries->first()->id : null;
    }

    public function update_regions(){
        $this->regions = Region::all();
        $this->selected_region_id = Region::first() ? Region::first()->id : null;
        $this->countries =  $this->selected_region_id ?
            Country::where('region_id', $this->selected_region_id)->get() : collect();
        $this->selected_country_id = $this->countries->first() ?
            $this->countries->first()->id : null;
    }

    public function update_countries(){
        $this->countries =  $this->selected_region_id ?
            Country::where('region_id', $this->selected_region_id)->get() : collect();
        $this->selected_country_id = $this->countries->first() ?
            $this->countries->first()->id : null;
    }
}
