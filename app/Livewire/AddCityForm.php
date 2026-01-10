<?php

namespace App\Livewire;

use App\Models\City;
use App\Models\Country;
use App\Models\Region;
use Livewire\Component;

class AddCityForm extends Component
{
    protected $listeners = [
        'update_selected_region_in_add_city_form' => 'update_selected_region_in_add_city_form',
        'update_selected_country_in_add_city_form' => 'update_selected_country_in_add_city_form'
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
        $this->regions = Region::has('countries')->get();
        $this->selected_region_id = $this->regions->first() ?
            $this->regions->first()->id : null;
        $this->countries =  $this->selected_region_id ?
            Country::where('region_id', $this->selected_region_id)->get() : collect();
        $this->selected_country_id = $this->countries->first() ?
            $this->countries->first()->id : null;
    }

    public function update_selected_region_in_add_city_form($payload)
    {
        $this->selected_region_id = $payload['selected_region_id'];
        $this->countries =  $payload['selected_region_id'] ?
            Country::where('region_id', $payload['selected_region_id'])->get() : collect();
        $this->selected_country_id = $this->countries->first() ?
            $this->countries->first()->id : null;
    }

    public function update_selected_country_in_add_city_form($payload)
    {
        $this->selected_country_id = $payload['selected_country_id'];
    }

    public function update_parent_selected_region($region_id)
    {
        //Parent is LocationSettings Livewire Component (the whole page)

        $this->dispatch('update_parent_selected_region', [
            'selected_region_id' => $region_id,
            'source' => 'add_city_form'
        ]);
        $this->countries = Country::where('region_id', $region_id)->get();
        $this->selected_country_id =
            $this->countries->count() > 0 ? $this->countries->first()->id : null;
        if (!empty($this->selected_country_id)) {
            $this->dispatch('update_parent_selected_country', [
                'selected_country_id' => $this->selected_country_id,
                'source' => 'add_city_form'
            ]);
        }
    }

    public function update_parent_selected_country($country_id)
    {
        $this->dispatch('update_parent_selected_country', [
            'selected_country_id' => $country_id,
            'source' => 'add_city_form'
        ]);
    }
}
