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
        'country_list_updated' => 'update_countries',
        'city_list_updated' => 'update_cities',
        'region_list_updated' => 'update_regions',
        'selected_region_updated' => 'update_selected_region',
    ];
    public $regions;
    public $selected_region_id;
    public $countries;
    public $selected_country_id;
    public $cities;
    public $currencies;
    public $selected_currency_id;
    public function render()
    {
        return view('livewire.location-settings');
    }

    public function update_selected_region($data)
    {
        $this->selected_region_id = $data['region_id'];
        $this->update_countries();
    }

    public function update_regions()
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

    public function update_countries()
    {
        $this->countries =  $this->selected_region_id ?
            Country::where('region_id', $this->selected_region_id)->get() : collect();
        $this->selected_country_id = $this->selected_region_id ?
            (Country::where('region_id', $this->selected_region_id)->first() ?
                Country::where('region_id', $this->selected_region_id)->first()->id : null)
            : null;
        $this->cities = $this->selected_country_id ?
            City::where('country_id', $this->selected_country_id)->get() : collect();
    }

    public function update_cities()
    {
        $this->cities = $this->selected_country_id ?
            City::where('country_id', $this->selected_country_id)->get() : collect();
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
