<?php

namespace App\Livewire;

use App\Models\City;
use App\Models\Country;
use App\Models\Region;
use Livewire\Component;

class CityList extends Component
{
    protected $listeners = [
        'city_list_updated' => 'update_cities',
        'country_list_updated' => 'update_countries',
        'region_list_updated' => 'update_regions',
    ];
    public $regions;
    public $selected_region_id;
    public $countries;
    public $selected_country_id;
    public $cities;

    public function render()
    {
        return view('livewire.city-list');
    }
    public function mount()
    {
        $this->regions = Region::has('countries')->pluck('name', 'id');
        $this->selected_region_id = Region::has('countries')->first() ?
                                    Region::has('countries')->first()->id : null;
        $this->countries =  $this->selected_region_id ?
                            Country::withTrashed()->where('region_id', $this->selected_region_id)->get() : collect();
        $this->selected_country_id = $this->countries->first() ?
                                    $this->countries->first()->id : null;
        $this->cities =  $this->selected_country_id ?
                            City::withTrashed()->where('country_id', $this->selected_country_id)->get() : collect();
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

    public function update_regions()
    {
        $this->regions = Region::has('countries')->pluck('name', 'id');
        $this->selected_region_id = Region::has('countries')->first() ?
                                    Region::has('countries')->first()->id : null;
        $this->countries =  $this->selected_region_id ?
                            Country::where('region_id', $this->selected_region_id)->get() : collect();
        $this->selected_country_id = $this->countries->first() ?
                                    $this->countries->first()->id : null;
        $this->cities =  $this->selected_country_id ?
                            City::withTrashed()->where('country_id', $this->selected_country_id)->get() : collect();
    }

    public function update_countries()
    {
        $this->countries =  $this->selected_region_id ?
                            Country::where('region_id', $this->selected_region_id)->get() : collect();
        $this->selected_country_id = $this->countries->first() ?
                                    $this->countries->first()->id : null;
        $this->cities =  $this->selected_country_id ?
                            City::withTrashed()->where('country_id', $this->selected_country_id)->get() : collect();
    }

    public function update_cities()
    {
        $this->cities =  $this->selected_country_id ?
                            City::withTrashed()->where('country_id', $this->selected_country_id)->get() : collect();
    }
}
