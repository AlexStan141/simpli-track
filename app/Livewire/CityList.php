<?php

namespace App\Livewire;

use App\Models\City;
use App\Models\Country;
use App\Models\Region;
use Livewire\Component;
use Livewire\Attributes\On;

class CityList extends Component
{
    protected $listeners = [
        'update_selected_region_in_city_list' => 'update_selected_region_in_city_list',
        'update_selected_country_in_city_list' => 'update_selected_country_in_city_list',
        'region_restore_event' => 'update_regions',
        'country_restore_event' => 'update_countries'
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
        $this->regions = Region::all();

        $this->selected_region_id = $this->regions->first() ?
            $this->regions->first()->id : null;

        $this->countries =  $this->selected_region_id ?
            Country::where('region_id', $this->selected_region_id)->get() : collect();

        $this->selected_country_id = $this->countries->first() ?
            $this->countries->first()->id : null;

        $this->cities =  $this->selected_country_id ?
            City::withTrashed()->where('country_id', $this->selected_country_id)->get() : collect();
    }

    public function close_other_cities($payload)
    {
        foreach ($this->cities as $city) {
            if ($city->name !== $payload['value']) {
                $this->dispatch('close_editable_input', [
                    'old_value' => $city->name,
                    'role' => 'city_settings'
                ]);
            }
        }
    }

    public function update_parent_selected_region($region_id)
    {

        //Parent is LocationSettings Livewire Component (the whole page)

        $this->dispatch('update_parent_selected_region', [
            'selected_region_id' => $region_id,
            'source' => 'city_list'
        ]);

        $this->countries = Country::where('region_id', $region_id)->get();
        $this->selected_country_id = $this->countries->first()->id;
        $this->cities = City::withTrashed()->where('country_id', $this->selected_country_id)->get();
        $this->dispatch('update_parent_selected_country', [
            'selected_country_id' => $this->selected_country_id,
            'source' => 'city_list'
        ]);
    }

    public function update_parent_selected_country($country_id)
    {
        $this->cities = City::withTrashed()->where('country_id', $country_id)->get();
        $this->dispatch('update_parent_selected_country', [
            'selected_country_id' => $country_id,
            'source' => 'city_list'
        ]);
    }

    public function update_regions()
    {
        $this->regions = Region::all();
        $this->selected_region_id = $this->regions->first() ? $this->regions->first()->id : null;
        $this->countries =  $this->selected_region_id ?
            Country::where('region_id', $this->selected_region_id)->get() : collect();
        $this->selected_country_id = $this->countries->first() ? $this->countries->first()->id : null;
        $this->cities =  $this->selected_country_id ?
            City::withTrashed()->where('country_id', $this->selected_country_id)->get() : collect();
    }

    public function update_countries($payload)
    {
        $this->regions = Region::all();
        $country = Country::find($payload['country_id']);
        $this->selected_region_id = $country->region_id;
        $this->countries = $this->selected_region_id ?
            Country::where('region_id', $this->selected_region_id)->get() : collect();
        $this->selected_country_id = $this->countries->first() ? $this->countries->first()->id : null;
        $this->cities = $this->selected_country_id ?
            City::withTrashed()->where('country_id', $this->selected_country_id)->get() : collect();
    }

    public function update_selected_region_in_city_list($payload)
    {
        $this->selected_region_id = $payload['selected_region_id'];
        $this->countries =  $payload['selected_region_id'] ?
            Country::where('region_id', $payload['selected_region_id'])->get() : collect();
        $this->selected_country_id = $this->countries->first() ?
            $this->countries->first()->id : null;
        $this->cities = $this->selected_country_id ?
            City::where('country_id', $this->selected_country_id)->get() : collect();
    }

    public function update_selected_country_in_city_list($payload)
    {
        $this->selected_country_id = $payload['selected_country_id'];
        $this->cities = $this->selected_country_id ?
            City::where('country_id', $this->selected_country_id)->get() : collect();
    }
}
