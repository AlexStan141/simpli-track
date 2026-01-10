<?php

namespace App\Livewire;

use App\Models\City;
use App\Models\Country;
use App\Models\Currency;
use App\Models\Region;
use Livewire\Component;

class LocationSettings extends Component
{
    protected $listeners = [
        'update_parent_selected_region' => 'update_selected_region',
        'update_parent_selected_country' => 'update_selected_country'
    ];
    public $regions;
    public $selected_region_id;
    public $countries;
    public $selected_country_id;
    public $cities;
    public $currencies;
    public $selected_currency_id;
    public function render()
    {
        return view('livewire.location-settings');
    }

    public function update_selected_region($payload)
    {
        if ($payload['source'] !== 'country_list') {
            $this->dispatch('update_selected_region_in_country_list', [
                'selected_region_id' => $payload['selected_region_id']
            ]);
        }
        if ($payload['source'] !== 'add_country_form') {
            $this->dispatch('update_selected_region_in_add_country_form', [
                'selected_region_id' => $payload['selected_region_id']
            ]);
        }
        if ($payload['source'] !== 'add_city_form') {
            $this->dispatch('update_selected_region_in_add_city_form', [
                'selected_region_id' => $payload['selected_region_id']
            ]);
        }
        if ($payload['source'] !== 'city_list') {
            $this->dispatch('update_selected_region_in_city_list', [
                'selected_region_id' => $payload['selected_region_id']
            ]);
        }
    }

    public function update_selected_country($payload)
    {
        if ($payload['source'] !== 'add_city_form') {
            $this->dispatch('update_selected_country_in_add_city_form', [
                'selected_country_id' => $payload['selected_country_id']
            ]);
        }
        if ($payload['source'] !== 'city_list') {
            $this->dispatch('update_selected_country_in_city_list', [
                'selected_country_id' => $payload['selected_country_id']
            ]);
        }
    }
}
