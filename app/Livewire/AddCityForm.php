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
        'country_deleted' => 'update_after_country_delete'
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
        $this->dispatch('city_list_updated', [
            'event' => 'add',
            'country_id' => $this->selected_country_id
        ]);
    }
    public function render()
    {
        return view('livewire.add-city-form');
    }

    public function refresh(){
        $this->regions = Region::has('countries')->pluck('name', 'id');
        $this->selected_region_id = Region::has('countries')->first()->id;
        $this->countries = Country::where('region_id', $this->selected_region_id)->pluck('name', 'id');
        $this->selected_country_id = Country::where('region_id', $this->selected_region_id)->first()->id;
    }

    public function refreshCountry()
    {
        $nr_countries = Country::where('region_id', $this->selected_region_id)->count();
        if ($nr_countries) {
            $this->countries = Country::where('region_id', $this->selected_region_id)->pluck('name', 'id');
            $this->selected_country_id = Country::where('region_id', $this->selected_region_id)->first()->id ?? null;
        } else {
            $nr_regions = Region::has('countries')->count();
            if ($nr_regions) {
                $this->regions = Region::has('countries')->pluck('name', 'id');
                $this->selected_region_id = Region::has('countries')->first()->id;
                $this->countries = Country::where('region_id', $this->selected_region_id)->pluck('name', 'id');
                $this->selected_country_id = Country::where('region_id', $this->selected_region_id)->first()->id ?? null;
            } else {
                $this->countries = collect();
                $this->selected_country_id = null;
            }
        }
    }

    public function update_after_country_delete($payload)
    {
        $region_id = $payload['region_id'];
        $nr_countries = Country::where('region_id', $region_id)->count();
        if($nr_countries == 0){
            //Regiunea nu mai are tari, se schimba regiunea
            $this->regions = Region::has('countries')->pluck('name', 'id');
            $this->selected_region_id = Region::has('countries')->first()->id;
            $this->countries = Country::where('region_id', $this->selected_region_id)->pluck('name', 'id');
            $this->selected_country_id = Country::where('region_id', $this->selected_region_id)->first()->id;
        } else {
            $this->countries = Country::where('region_id', $this->selected_region_id)->pluck('name', 'id');
            $this->selected_country_id = Country::where('region_id', $this->selected_region_id)->first()->id;
        }
    }

    public function update_country_list()
    {
        $this->countries = Country::where('region_id', $this->selected_region_id)->pluck('name', 'id');
        $this->selected_country_id = $this->countries->keys()->first();
    }
    public function mount()
    {
        $this->selected_country_id = Country::all()->first() ? Country::all()->first()->id : null;
        $this->regions = Region::has('countries')->pluck('name', 'id');
        $this->selected_region_id = $this->selected_country_id ?
                                    Country::where('id', $this->selected_country_id)->first()->region->id : null;
        $this->countries =  $this->selected_region_id ?
                            Country::where('region_id', $this->selected_region_id)->pluck('name', 'id') : collect();
    }
}
