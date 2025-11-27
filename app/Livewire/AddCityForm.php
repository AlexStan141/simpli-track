<?php

namespace App\Livewire;

use App\Models\City;
use App\Models\Company;
use App\Models\Country;
use App\Models\Region;
use Livewire\Component;

class AddCityForm extends Component
{
    protected $listeners = ['region_list_updated' => 'refresh',
                            'country_list_updated' => 'refresh'];
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
            'company_id' => Company::all()->first()->id
        ]);
        $this->cityToAdd = '';
        $this->dispatch('city_list_updated');
    }
    public function render(){
        return view('livewire.add-city-form');
    }
    public function refresh()
    {
        $this->regions = Region::pluck('name', 'id');
        $this->selected_region_id = $this->regions->keys()->first();
        $this->countries = Country::where('region_id', $this->selected_region_id)->pluck('name', 'id');
        return view('livewire.add-city-form');
    }
    public function update_country_list()
    {
        $this->countries = Country::where('region_id', $this->selected_region_id)->pluck('name', 'id');
        $this->selected_country_id = $this->countries->keys()->first();
    }
    public function mount()
    {
        $this->regions = Region::pluck('name', 'id');
        $this->selected_region_id = $this->regions->keys()->first();
        $this->countries = Country::where('region_id', $this->selected_region_id)->pluck('name', 'id');
        $this->selected_country_id = $this->countries->keys()->first();
    }
}
