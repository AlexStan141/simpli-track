<?php

namespace App\Livewire;

use App\Models\City;
use App\Models\Country;
use App\Models\Region;
use Livewire\Component;

class CityList extends Component
{
    protected $listeners = [
        'region_list_updated' => 'refresh',
        'country_list_updated' => 'refresh',
        'city_list_updated' => 'refresh'
    ];
    public $regions;
    public $selected_region_id;
    public $countries;
    public $selected_country_id;
    public $cities;
    public function trigger_region_update()
    {
        $this->countries = Country::where('region_id', $this->selected_region_id)
            ->whereNotNull('company_id')->pluck('name', 'id');
        $this->selected_country_id = Country::where('region_id', $this->selected_region_id)
            ->whereNotNull('company_id')->first() ?
            Country::where('region_id', $this->selected_region_id)
            ->whereNotNull('company_id')->first()->id : null;
        $this->cities = $this->selected_country_id ? City::where('country_id', $this->selected_country_id)
            ->whereNotNull('company_id')->get() : [];
    }

    public function trigger_country_update()
    {
        $this->cities = City::where('country_id', $this->selected_country_id)
            ->whereNotNull('company_id')->get();
    }

    public function refresh()
    {
        $this->selected_country_id = Country::all()->first()->id;
        $this->cities = City::where('country_id', $this->selected_country_id)->get();
        $this->regions = Region::pluck('name', 'id');
        $this->selected_region_id = Country::where('id', $this->selected_country_id)->first()->region->id;
        $this->countries = Country::where('region_id', $this->selected_region_id)->pluck('name', 'id');
    }
    public function render()
    {
        return view('livewire.city-list');
    }
    public function mount()
    {
        $this->selected_country_id = Country::all()->first()->id;
        $this->cities = City::where('country_id', $this->selected_country_id)->get();
        $this->regions = Region::pluck('name', 'id');
        $this->selected_region_id = Country::where('id', $this->selected_country_id)->first()->region->id;
        $this->countries = Country::where('region_id', $this->selected_region_id)->pluck('name', 'id');
    }
}
