<?php

namespace App\Livewire;

use App\Models\Company;
use App\Models\Country;
use App\Models\Region;
use Livewire\Component;

class AddCountryForm extends Component
{
    protected $listeners = ['region_list_updated' => 'render'];
    public $regions;
    public $selected_region_id;
    public $countryToAdd;
    public function addCountry()
    {
        Country::create([
            'region_id' => $this->selected_region_id,
            'name' => $this->countryToAdd,
            'company_id' => Company::all()->first()->id
        ]);
        $this->countryToAdd = '';
        $this->dispatch('renderCountries');
    }
    public function render()
    {
        $this->regions = Region::pluck('name', 'id');
        return view('livewire.add-country-form');
    }
    public function mount()
    {
        $this->regions = Region::pluck('name', 'id');
        $this->selected_region_id = Region::all()->first()->id;
    }
}
