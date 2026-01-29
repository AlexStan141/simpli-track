<?php

namespace App\Livewire;

use App\Models\City;
use App\Models\Country;
use App\Models\Currency;
use App\Models\Region;
use Livewire\Component;
use PHPUnit\Framework\Constraint\Count;

class SelectInput extends Component
{
    protected $listeners = [
        'updateValue' => 'updateValue',
        'refreshValues' => 'refreshValues'
    ];
    public $values;
    public $entity;
    public $selectedValue = null;

    public function render()
    {
        return view('livewire.select-input');
    }

    public function updateSelectedValue($value){
        if($this->entity === 'region'){
            $this->dispatch('refreshValues', [
                'entity' => 'region',
                'value' => $value,
            ]);
            $countries = Country::where('region_id', $value)->get();
            $first_country_id = $countries->first()->id;
            $this->dispatch('refreshValues', [
                'entity' => 'country',
                'value' => $value,
                'selected_value' => $first_country_id,
                'details' => 'after region select change'
            ]);
            $this->dispatch('updateListItem', [
                'entity' => 'country',
                'region_id' => $value
            ]);
            $first_country = Country::where('region_id', $value)->first();
            $this->dispatch('updateListItem', [
                'entity' => 'city',
                'country_id' => $first_country->id ?? null
            ]);
        } else if($this->entity === 'country'){
            $this->dispatch('updateListItem', [
                'entity' => 'city',
                'country_id' => $value
            ]);
            $this->dispatch('refreshValues', [
                'entity' => 'country',
                'value' => Country::find($value)->region_id,
                'selected_value' => $value
            ]);
        } else if ($this->entity === 'city'){
           $this->selectedValue = $value;
        }
    }

    public function refreshValues($payload){
        if($payload['entity'] === 'region' && $this->entity === 'region'){
            $this->values = Region::pluck('name', 'id')->toArray();
            $this->selectedValue = $payload['value'] ?? null; //prima regiune existenta
            $countries = $this->selectedValue ?
                        Country::where('region_id', $this->selectedValue)->get() : collect();
            $first_country = $countries->first() ? $countries->first()->id : null;
            $this->dispatch('updateSelectedRegion', [
                'value' => $this->selectedValue
            ]);
            $this->dispatch('updateSelectedCountry', [
                'value' => $first_country
            ]);
            $this->dispatch('refreshValues', [
                'entity' => 'country',
                'value' => $this->selectedValue,
                'selected_value' => $first_country
            ]);
        } else if ($payload['entity'] === 'country' && $this->entity === 'country'){
            $this->values = Country::where('region_id', $payload['value'])->pluck('name', 'id')->toArray();
            $this->selectedValue = $payload['selected_value'];
            $this->dispatch('updateSelectedCountry', [
                'value' => $this->selectedValue
            ]);
        }
    }


    public function mount()
    {
        if ($this->entity === 'region') {
            $this->values = Region::pluck('name', 'id')->toArray();
            $smallest_id = array_key_first($this->values);
            $this->selectedValue = $smallest_id;
        } else if ($this->entity === 'country') {
            $regions = Region::all();
            $region_id = $regions->first()->id ?? null;
            $this->values = Country::where('region_id', $region_id)->pluck('name', 'id')->toArray();
            $smallest_id = array_key_first($this->values);
            $this->selectedValue = $smallest_id;
            return view('livewire.select-input');
        } else if ($this->entity === 'currency') {
            $this->values = Currency::pluck('name', 'id')->toArray();
        }
    }
}
