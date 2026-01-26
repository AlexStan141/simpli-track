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
        'update_region_in_add_country_form' => 'update_region_in_add_country_form',
        'update_region_in_add_city_form' => 'update_region_in_add_city_form',
        'update_country_in_add_city_form' => 'update_country_in_add_city_form',
        'refresh_form_after_region_add' => 'refresh_form_after_region_add',
        'refresh_form_after_country_add' => 'refresh_form_after_country_add',
        'refresh_after_region_delete' => 'refresh_after_region_delete',
        'refresh_after_country_delete' => 'refresh_after_country_delete',
    ];
    public $values;
    public $entity;
    public $value_to_add;
    public $color_to_add;
    public $regions;
    public $region_id;
    public $countries;
    public $country_id;
    public $currencies;
    public $currency_id;

    public function render()
    {
        return view('livewire.form');
    }

    public function update_value_to_add($value)
    {
        if ($this->entity === 'currency') {
            $this->value_to_add = config('constants.CURRENCIES')[$value];
        } else {
            $this->value_to_add = $value;
        }
    }

    public function update_region_in_add_country_form($payload)
    {
        if ($this->entity === 'country') {
            $this->region_id = $payload['value'];
        }
    }

    public function update_region_in_add_city_form($payload)
    {
        if ($this->entity === 'city') {
            $this->region_id = $payload['value'];
            $this->countries = Country::where('region_id', $this->region_id)->get();
            $this->country_id = $this->countries->first() ? $this->countries->first()->id : null;
        }
    }

    public function update_country_in_add_city_form($payload)
    {
        if ($this->entity === 'city') {
            $this->country_id = $payload['value'];
        }
    }

    public function update_region($value)
    {
        $this->region_id = $value;
        $this->countries = Country::where('region_id', $value)->get();
        $this->country_id = $this->countries->first() ? $this->countries->first()->id : null;
        $this->dispatch('update_list_item_selected_region', [
            'entity' => 'country',
            'value' => $value
        ]);
        $this->dispatch('update_list_item_selected_region', [
            'entity' => 'city',
            'value' => $value
        ]);
        $this->dispatch('update_region_in_add_country_form', [
            'value' => $value
        ]);
        $this->dispatch('update_region_in_add_city_form', [
            'value' => $value
        ]);
    }


    public function update_country($value)
    {
        $this->country_id = $value;
        $this->dispatch('update_list_item_selected_country', [
            'entity' => 'city',
            'value' => $value
        ]);
        $this->dispatch('update_country_in_add_city_form', [
            'value' => $value
        ]);
    }

    public function update_currency($value)
    {
        $this->currency_id = $value;
    }

    public function update_color_to_add($value)
    {
        $this->color_to_add = $value;
    }

    public function add_value()
    {
        if ($this->entity === 'currency') {
            Currency::create([
                'name' => $this->value_to_add,
            ]);
            $this->dispatch('update_list_items_event', [
                'entity' => 'currency'
            ]);
        }
        if ($this->entity === 'category') {
            Category::create([
                'name' => $this->value_to_add,
                'company_id' => Company::first()->id
            ]);
            $this->dispatch('update_list_items_event', [
                'entity' => 'category'
            ]);
        }
        if ($this->entity === 'status') {
            Status::create([
                'name' => $this->value_to_add,
                'color' => $this->color_to_add,
                'company_id' => Company::first()->id
            ]);
            $this->dispatch('update_list_items_event', [
                'entity' => 'status'
            ]);
        } else if ($this->entity === 'region') {
            $newRegion = Region::create([
                'name' => $this->value_to_add,
                'selected' => true,
                'selected_before_save' => true
            ]);
            $this->dispatch('update_list_items_event', [
                'entity' => 'region'
            ]);
            $this->dispatch('update_list_items_event', [
                'entity' => 'country',
                'region_id' => $this->region_id
            ]);
            $this->dispatch('update_list_items_event', [
                'entity' => 'city',
                'region_id' => $this->region_id,
                'country_id' => null
            ]);
            $this->dispatch('refresh_form_after_region_add', [
                'value' => $newRegion->id
            ]);
        } else if ($this->entity === 'country') {
            $newCountry = Country::create([
                'name' => $this->value_to_add,
                'region_id' => $this->region_id,
                'currency_id' => $this->currency_id
            ]);
            $this->dispatch('update_list_items_event', [
                'entity' => 'country',
                'region_id' => $this->region_id
            ]);
            $this->dispatch('update_list_items_event', [
                'entity' => 'city',
                'region_id' => $this->region_id,
                'country_id' => $newCountry->id
            ]);
            $this->dispatch('refresh_form_after_country_add', [
                'value' => $newCountry->id
            ]);
        } else if ($this->entity === 'city') {
            City::create([
                'name' => $this->value_to_add,
                'country_id' => $this->country_id
            ]);
            $this->dispatch('update_list_items_event', [
                'entity' => 'city',
                'region_id' => $this->region_id,
                'country_id' => $this->country_id
            ]);
        }
    }

    public function refresh_form_after_region_add($payload)
    {
        if ($this->entity === 'country') {
            $this->regions = Region::all();
            $this->region_id = $payload['value'];
            $this->currencies = Currency::all();
            $this->currency_id = $this->currencies->first() ? $this->currencies->first()->id : null;
        } else if ($this->entity === 'city') {
            $this->regions = Region::all();
            $this->region_id = $payload['value'];
            $this->countries = Country::where('region_id', $this->region_id)->get();
            $this->country_id = $this->countries->first() ? $this->countries->first()->id : null;
        }
    }



    public function refresh_form_after_country_add($payload)
    {
        if ($this->entity === 'city') {
            $this->regions = Region::all();
            $this->region_id = Country::find($payload['value'])->region_id;
            $this->countries = Country::where('region_id', $this->region_id)->get();
            $this->country_id = $payload['value'];
        }
    }

    public function refresh_after_region_delete($payload)
    {
        if ($this->entity === 'country') {
            $this->regions = Region::all();
            $this->region_id = $this->regions->first() ? $this->regions->first()->id : null;
            $this->currencies = Currency::all();
            $this->currency_id = $this->currencies->first() ? $this->currencies->first()->id : null;
        } else if ($this->entity === 'city') {
            $this->regions = Region::all();
            $this->region_id = $this->regions->first() ? $this->regions->first()->id : null;
            $this->countries = $this->region_id
                ? Country::where('region_id', $this->region_id)->get()
                : collect();
            $this->country_id = $this->countries->first() ? $this->countries->first()->id : null;
        }
    }

    public function refresh_after_country_delete($payload)
    {
        if ($this->entity === 'city') {
            $this->regions = Region::all();
            $this->region_id = Country::withTrashed()->find($payload['value'])->region_id;
            $this->countries = $this->region_id
                ? Country::where('region_id', $this->region_id)->get()
                : collect();
            $this->country_id = $this->countries->first() ? $this->countries->first()->id : null;
            $this->dispatch('update_list_items_event', [
                'region_id' => $this->region_id,
                'country_id' => $this->country_id,
                'entity' => 'city'
            ]);
        }
    }



    public function mount()
    {
        if ($this->entity === 'currency') {
            $all_currencies = config('constants.CURRENCIES');
            $currency_names = Currency::withTrashed()->pluck('name')->toArray();
            $this->values = array_diff($all_currencies, $currency_names);
            $first_value_key = array_keys($this->values)[0];
            $this->value_to_add = $this->values[$first_value_key];
        } else if ($this->entity === 'status') {
            $this->color_to_add = sprintf('#%06X', 0);
        } else if ($this->entity === 'country') {
            $this->regions = Region::all();
            $this->region_id = $this->regions->first() ? $this->regions->first()->id : null;
            $this->currencies = Currency::all();
            $this->currency_id = $this->currencies->first() ? $this->currencies->first()->id : null;
        } else if ($this->entity === 'city') {
            $this->regions = Region::all();
            $this->region_id = $this->regions->first() ? $this->regions->first()->id : null;
            $this->countries = $this->region_id
                ? Country::where('region_id', $this->region_id)->get()
                : collect();
            $this->country_id = $this->countries->first() ? $this->countries->first()->id : null;
        }
    }
}
