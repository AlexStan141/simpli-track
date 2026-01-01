<?php

namespace App\Livewire;

use App\Models\City;
use App\Models\Country;
use App\Models\Region;
use Livewire\Component;

class CityList extends Component
{
    protected $listeners = [
        'city_list_updated' => 'refresh',
        'country_list_updated' => 'refresh',
        'region_list_updated' => 'refresh',
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
            Country::withTrashed()->where('region_id', $this->selected_region_id)->get() : collect();

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

    public function change_region()
    {
        $this->countries =  $this->selected_region_id ?
            Country::withTrashed()->where('region_id', $this->selected_region_id)->get() : collect();

        $this->selected_country_id = $this->countries->first() ?
            $this->countries->first()->id : null;

        $this->cities =  $this->selected_country_id ?
            City::withTrashed()->where('country_id', $this->selected_country_id)->get() : collect();
    }

    public function change_country()
    {
        $this->cities =  $this->selected_country_id ?
            City::withTrashed()->where('country_id', $this->selected_country_id)->get() : collect();
    }

    public function refresh()
    {
        $this->regions = Region::all();

        $this->selected_region_id = $this->regions->first() ?
            $this->regions->first()->id : null;

        $this->countries =  $this->selected_region_id ?
            Country::withTrashed()->where('region_id', $this->selected_region_id)->get() : collect();

        $this->selected_country_id = $this->countries->first() ?
            $this->countries->first()->id : null;

        $this->cities =  $this->selected_country_id ?
            City::withTrashed()->where('country_id', $this->selected_country_id)->get() : collect();
    }
}
