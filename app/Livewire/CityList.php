<?php

namespace App\Livewire;

use App\Models\City;
use App\Models\Country;
use App\Models\Region;
use Livewire\Component;

class CityList extends Component
{
    protected $listeners = [
        'region_list_updated' => 'refreshRegion',
        'country_list_updated' => 'refreshCountry',
        'city_list_updated' => 'refreshCity',
        'close_other_cities' => 'close_other_cities'
    ];
    public $regions;
    public $selected_region_id;
    public $countries;
    public $selected_country_id;
    public $cities;

    public function refreshRegion()
    {
        $this->regions = Region::has('countries')->pluck('name', 'id');
        $this->selected_region_id = Region::has('countries')->first()->id; //Select first region with countries
        $this->countries = Country::where('region_id', $this->selected_region_id)->pluck('name', 'id');
        $this->selected_country_id = Country::where('region_id', $this->selected_region_id)->first()->id;
        $this->cities = City::where('country_id', $this->selected_country_id)->pluck('name', 'id');
    }

    public function refreshCountry()
    {
        $nr_countries = Country::where('region_id', $this->selected_region_id)->count();
        if ($nr_countries) {
            $this->countries = Country::where('region_id', $this->selected_region_id)->pluck('name', 'id');
            $this->selected_country_id = Country::where('region_id', $this->selected_region_id)->first()->id ?? null;
            $this->cities = City::where('country_id', $this->selected_country_id)->get();
        } else {
            $nr_regions = Region::has('countries')->count();
            if ($nr_regions) {
                $this->regions = Region::has('countries')->pluck('name', 'id');
                $this->selected_region_id = Region::has('countries')->first()->id;
                $this->countries = Country::where('region_id', $this->selected_region_id)->pluck('name', 'id');
                $this->selected_country_id = Country::where('region_id', $this->selected_region_id)->first()->id ?? null;
                $this->cities = City::where('country_id', $this->selected_country_id)->get();
            } else {
                $this->countries = collect();
                $this->selected_country_id = null;
                $this->cities = collect();
            }
        }
    }

    public function refreshCity()
    {
        $this->cities = City::withTrashed()->where('country_id', $this->selected_country_id)->get();
    }


    public function render()
    {
        return view('livewire.city-list');
    }
    public function mount()
    {
        $this->selected_region_id = Region::has('countries')->first()->id;
        $this->regions = Region::has('countries')->pluck('name', 'id');
        $this->selected_country_id = Country::where('region_id', $this->selected_region_id)->first()->id;
        $this->countries = Country::where('region_id', $this->selected_region_id)->pluck('name', 'id');
        $this->cities = City::withTrashed()->where('country_id', $this->selected_country_id)->get();
    }

    public function close_other_cities($payload){
        foreach($this->cities as $city){
            if($city->name !== $payload['value']){
                $this->dispatch('close_editable_input', [
                    'old_value' => $city->name,
                    'role' => 'city_settings'
                ]);
            }
        }
    }
}
