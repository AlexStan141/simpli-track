<?php

namespace App\Livewire;

use App\Models\Country;
use App\Models\Region;
use Livewire\Component;

class CountryList extends Component
{
    protected $listeners = [
        'update_selected_region_in_country_list' => 'update_selected_region_in_country_list',
        'region_restore_event' => 'update_regions'
    ];
    public $regions;
    public $selected_region_id;
    public $countries;

    public function render()
    {
        return view('livewire.country-list');
    }

    public function update_selected_region_in_country_list($payload)
    {
        $this->selected_region_id = $payload['selected_region_id'];
        $this->countries =  $payload['selected_region_id'] ?
            Country::withTrashed()->where('region_id', $payload['selected_region_id'])->get() : collect();
    }

    public function update_parent_selected_region($region_id)
    {

        //Tara se actualizeaza in aceasta componenta si update-ul se face si in celelalte componente
        //(AddCountryForm, AddCityForm, CityList)
        //prin componenta parinte LocationSettings

        $this->countries = $region_id ?
            Country::withTrashed()->where('region_id', $region_id)->get() : collect();
        $this->dispatch('update_parent_selected_region', [
            'selected_region_id' => $region_id,
            'source' => 'country_list'
        ]);
    }

    public function mount()
    {
        $this->regions = Region::all();
        $this->selected_region_id = $this->regions->first() ? $this->regions->first()->id : null;
        $this->countries =  $this->selected_region_id ?
            Country::withTrashed()->where('region_id', $this->selected_region_id)->get() : collect();
    }

    public function update_regions()
    {
        $this->regions = Region::all();
        $this->selected_region_id = $this->regions->first() ? $this->regions->first()->id : null;
        $this->countries =  $this->selected_region_id ?
            Country::withTrashed()->where('region_id', $this->selected_region_id)->get() : collect();
    }
}
