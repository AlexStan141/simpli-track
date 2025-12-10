<?php

namespace App\Livewire;

use App\Models\City;
use App\Models\Country;
use App\Models\Currency;
use App\Models\Region;
use Livewire\Component;

class LocationSettings extends Component
{
    protected $listeners = [
        'region_list_updated' => 'update_page',
        'country_list_updated' => 'update_region',
        'city_list_updated' => 'update_country'
    ];
    public $regions;
    public $selected_region_id;
    public $countries;
    public $selected_country_id;
    public $cities;
    public $currencies;
    public $selected_currency_id;
    public $regionToAdd;
    public $countryToAdd;
    public $cityToAdd;
    public function render()
    {
        return view('livewire.location-settings');
    }

    public function addRegion()
    {
        Region::create([
            'name' => $this->regionToAdd,
            'selected' => true,
            'selected_before_save' => true
        ]);
        $this->regionToAdd = '';
        $this->update_page();
    }

    public function addCountry()
    {
        Country::create([
            'name' => $this->countryToAdd,
            'region_id' => $this->selected_region_id,
            'currency_id' => $this->selected_currency_id
        ]);
        $this->countryToAdd = '';
        $this->update_region();
    }

    public function addCity()
    {
        City::create([
            'name' => $this->cityToAdd,
            'country_id' => $this->selected_country_id,
        ]);
        $this->cityToAdd = '';
        $this->update_country();
    }

    public function update_page()
    {
        $this->regions = Region::all();
        $this->selected_region_id = Region::first() ? Region::first()->id : null;
        $this->countries =  $this->selected_region_id ?
            Country::where('region_id', $this->selected_region_id)->get() : collect();
        $this->selected_country_id = $this->selected_region_id ?
            (Country::where('region_id', $this->selected_region_id)->first() ?
                Country::where('region_id', $this->selected_region_id)->first()->id : null)
            : null;
        $this->cities = $this->selected_country_id ?
            City::where('country_id', $this->selected_country_id)->get() : collect();
    }

    public function update_region()
    {
        $this->countries = Country::where('region_id', $this->selected_region_id)->get();
        $this->selected_country_id = Country::where('region_id', $this->selected_region_id)->first() ?
            Country::where('region_id', $this->selected_region_id)->first()->id : null;
        $this->cities = $this->selected_country_id ?
            City::where('country_id', $this->selected_country_id)->get() : collect();
    }

    public function update_country()
    {
        $this->cities = City::where('country_id', $this->selected_country_id)->get();
    }

    public function mount()
    {
        $this->regions = Region::all();
        $this->selected_region_id = Region::first() ? Region::first()->id : null;
        $this->countries =  $this->selected_region_id ?
            Country::where('region_id', $this->selected_region_id)->get() : collect();
        $this->selected_country_id = $this->selected_region_id ?
            (Country::where('region_id', $this->selected_region_id)->first() ?
                Country::where('region_id', $this->selected_region_id)->first()->id : null)
            : null;
        $this->cities = $this->selected_country_id ?
            City::where('country_id', $this->selected_country_id)->get() : collect();
        $this->currencies = Currency::pluck('name', 'id');
        $this->selected_currency_id = Currency::all()->first()->id;
    }
}
