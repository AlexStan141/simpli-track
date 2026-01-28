<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\City;
use App\Models\Company;
use App\Models\Country;
use App\Models\Currency;
use App\Models\Region;
use App\Models\Status;
use Livewire\Component;

class Form extends Component
{
    protected $listeners = [
        'updateSelectedRegion' => 'updateSelectedRegion',
        'updateSelectedCountry' => 'updateSelectedCountry',
    ];
    public $selectedRegion;
    public $selectedCountry;
    public $entity;

    public function mount()
    {
        if ($this->entity === 'country') {
            $regions = Region::all();
            $this->selectedRegion = $regions->first()->id ?? null;
        } else if ($this->entity === 'city') {
            $regions = Region::all();
            $this->selectedRegion = $regions->first()->id ?? null;
            $countries =  $this->selectedRegion ?
                Country::where('region_id', $this->selectedRegion)->get() : collect();
            $this->selectedCountry = $countries->first()->id ?? null;
        }
    }

    public function updateSelectedRegion($payload)
    {
        $this->selectedRegion = $payload['value'];
        $countries =  $this->selectedRegion ?
            Country::where('region_id', $this->selectedRegion)->get() : collect();
        $this->selectedCountry = $countries->first()->id ?? null;
    }

    public function updateSelectedCountry($payload)
    {
        $this->selectedCountry = $payload['value'];
    }

    public function render()
    {
        return view('livewire.form');
    }
}
