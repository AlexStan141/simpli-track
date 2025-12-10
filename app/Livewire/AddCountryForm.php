<?php

namespace App\Livewire;

use App\Models\Company;
use App\Models\Country;
use App\Models\Currency;
use App\Models\Region;
use Livewire\Component;

class AddCountryForm extends Component
{
    protected $listeners = ['region_list_updated' => 'render'];
    public $regions;
    public $selected_region_id;
    public $currencies;
    public $selected_currency_id;
    public $countryToAdd;
    public function addCountry()
    {
        Country::create([
            'region_id' => $this->selected_region_id,
            'name' => $this->countryToAdd,
            'currency_id' => $this->selected_currency_id
        ]);
        $this->countryToAdd = '';
        $this->dispatch('region_list_updated');
    }
    public function render()
    {
        return view('livewire.add-country-form');
    }
    public function mount()
    {
        $this->regions = Region::pluck('name', 'id');
        $this->selected_region_id = Region::all()->first()->id;

        $this->currencies = Currency::pluck('name', 'id');
        $this->selected_currency_id = Currency::all()->first()->id;
    }
}
