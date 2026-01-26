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

class ListOfItems extends Component
{
    protected $listeners = [
        'close_other_values' => 'close_other_values',
        'list_item_restore_event' => 'restore_value',
        'update_list_item_selected_region' => 'update_list_item_selected_region',
        'update_list_item_selected_country' => 'update_list_item_selected_country',
        'refresh_list_of_cities' => 'refresh_list_of_cities',
        'update_list_items_event' => 'update_list_items',
        'refresh_regions_in_city_list_items' => 'refresh_list_of_cities',
        'refresh_countries_in_city_list_items' => 'refresh_list_of_cities'
    ];
    public $values;
    public $entity;
    public $additional_info;
    public $region_id;
    public $regions;
    public $currency_id;
    public $countries;
    public $country_id;

    public function update_list_items($payload){
        if ($this->entity === 'category' && $payload['entity'] === 'category') {
            $this->values = Category::withTrashed()->get();
        } else if ($this->entity === 'currency' && $payload['entity'] === 'currency') {
            $this->values = Currency::withTrashed()->get();
        } else if ($this->entity === 'status' && $payload['entity'] === 'status') {
            $this->values = Status::withTrashed()->get();
        } else if ($this->entity === 'region' && $payload['entity'] === 'region') {
            $this->values = Region::withTrashed()->get();
        } else if ($this->entity === 'country' && $payload['entity'] === 'country') {
            $this->region_id = $payload['region_id'];
            $this->values = $payload['region_id'] ?
                            Country::withTrashed()->where('region_id', $payload['region_id'])->get() : collect();
        } else if ($this->entity === 'city' && $payload['entity'] === 'city') {
            $this->regions = Region::all();
            $this->region_id = $payload['region_id'];
            $this->countries = Country::where('region_id', $this->region_id)->get();
            $this->country_id = $payload['country_id'];
            $this->values = $payload['country_id'] ?
                            City::withTrashed()->where('country_id', $payload['country_id'])->get() : collect();
        }
    }

    public function update_list_item_selected_region($payload){
        if($this->entity === 'country' && $payload['entity'] === 'country'){
            $this->region_id = $payload['value'];
            $this->values = Country::withTrashed()->where('region_id', $this->region_id)->get();
        }
        if($this->entity === 'city' && $payload['entity'] === 'city'){
            $this->region_id = $payload['value'];
            $this->countries = Country::where('region_id', $this->region_id)->get();
            $this->country_id = $this->countries->first() ? $this->countries->first()->id : null;
            $this->values = $this->country_id ?
                            City::withTrashed()->where('country_id', $this->country_id)->get() :
                            collect();
        }
    }

    public function update_region($value)
    {
        if ($this->entity === 'city') {
            $this->region_id = $value;
            $this->countries = Country::where('region_id', $this->region_id)->get();
            $this->country_id = $this->countries->first() ? $this->countries->first()->id : null;
            $this->values = $this->country_id ?
                            City::withTrashed()->where('country_id', $this->country_id)->get() : collect();
        }
        $this->dispatch('update_region_in_add_country_form', [
            'value' => $value
        ]);
        $this->dispatch('update_region_in_add_city_form', [
            'value' => $value
        ]);
    }

    public function update_list_item_selected_country($payload)
    {
        if($this->entity === 'city'){
            $this->country_id = $payload['value'];
            $this->values = City::withTrashed()->where('country_id', $this->country_id)->get();
        }
    }

    public function update_country($value)
    {
        if($this->entity === 'city'){
            $this->country_id = $value;
            $this->values = City::withTrashed()->where('country_id', $this->country_id)->get();
        }
        $this->dispatch('update_country_in_add_city_form', [
            'value' => $value
        ]);
    }

    public function restore_value($payload)
    {
        if ($this->entity === 'category' && $payload['entity'] === 'category') {
            $category = Category::withTrashed()->where('name', $payload['value'])->first();
            if ($category) {
                $category->restore();
            }
            $this->values = Category::withTrashed()->get();
        } else if ($this->entity === 'currency' && $payload['entity'] === 'currency') {
            $currency = Currency::withTrashed()->where('name', $payload['value'])->first();
            if ($currency) {
                $currency->restore();
            }
            $this->values = Currency::withTrashed()->get();
        } else if ($this->entity === 'status' && $payload['entity'] === 'status') {
            $status = Status::withTrashed()->where('name', $payload['value'])->first();
            if ($status) {
                $status->restore();
            }
            $this->values = Status::withTrashed()->get();
        } else if ($this->entity === 'region' && $payload['entity'] === 'region') {
            $region = Region::withTrashed()->where('name', $payload['value'])->first();
            if ($region) {
                $region->restore();
            }
            $this->values = Region::withTrashed()->get();
        } else if ($this->entity === 'country' && $payload['entity'] === 'country') {
            $country = Country::withTrashed()->where('name', $payload['value'])->first();
            if ($country) {
                $country->restore();
            }
            $this->values = Country::withTrashed()->where('region_id', $country->region_id)->get();
        } else if ($this->entity === 'city' && $payload['entity'] === 'city') {
            $city = City::withTrashed()->where('name', $payload['value'])->first();
            if ($city) {
                $city->restore();
            }
            $this->values = City::withTrashed()->where('country_id', $this->country_id)->get();
        }
    }

    public function close_other_values($payload)
    {
        foreach ($this->values as $current_value) {
            if ($current_value->name !== $payload['value']) {
                if ($this->entity === 'currency') {
                    $this->dispatch('close_editable_input', [
                        'old_value' => $current_value->name,
                        'role' => 'currency_settings'
                    ]);
                } else if ($this->entity === 'category') {
                    $this->dispatch('close_editable_input', [
                        'old_value' => $current_value->name,
                        'role' => 'category_settings'
                    ]);
                } else if ($this->entity === 'status') {
                    $this->dispatch('close_editable_input_for_status', [
                        'old_value' => $current_value->name,
                    ]);
                } else if ($this->entity === 'region') {
                    $this->dispatch('close_editable_input', [
                        'old_value' => $current_value->name,
                        'role' => 'region_settings'
                    ]);
                } else if ($this->entity === 'country') {
                    $this->dispatch('close_editable_input', [
                        'old_value' => $current_value->name,
                        'role' => 'country_settings'
                    ]);
                } else if ($this->entity === 'city') {
                    $this->dispatch('close_editable_input', [
                        'old_value' => $current_value->name,
                        'role' => 'city_settings'
                    ]);
                }
            }
        }
    }

    public function mount()
    {
        if ($this->entity === 'category') {
            $this->values = Category::withTrashed()->get();
        } else if ($this->entity === 'currency') {
            $this->values = Currency::withTrashed()->get();
        } else if ($this->entity === 'status') {
            $this->values = Status::withTrashed()->get();
        } else if ($this->entity === 'region') {
            $this->values = Region::withTrashed()->get();
        } else if ($this->entity === 'country') {
            $this->region_id = Region::first() ? Region::first()->id : null;
            $this->currency_id = Currency::first()->id;
            $this->values = $this->region_id ?
                            Country::withTrashed()->where('region_id', $this->region_id)->get() : collect();
        } else if ($this->entity === 'city') {
            $this->regions = Region::all();
            $this->region_id = Region::first() ? Region::first()->id : null;
            $this->countries =  $this->region_id ?
                                Country::where('region_id', $this->region_id)->get() : collect();
            $this->country_id = $this->countries->first() ? $this->countries->first()->id : null;
            $this->values = $this->country_id ?
                            City::withTrashed()->where('country_id', $this->country_id)->get() : collect();
        }
    }

    public function refresh_list_of_cities(){
        if ($this->entity === 'city') {
            $this->regions = Region::all();
            $this->region_id = Region::first() ? Region::first()->id : null;
            $this->countries =  $this->region_id ?
                                Country::where('region_id', $this->region_id)->get() : collect();
            $this->country_id = $this->countries->first() ? $this->countries->first()->id : null;
            $this->values = $this->country_id ?
                            City::withTrashed()->where('country_id', $this->country_id)->get() : collect();
        }
    }

    public function render()
    {
        return view('livewire.list-of-items');
    }
}
