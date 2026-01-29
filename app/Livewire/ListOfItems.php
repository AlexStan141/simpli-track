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
        'updateListItemAfterDelete' => 'updateListItemAfterDelete',
        'updateListItemAfterRestore' => 'updateListItemAfterRestore',
        'updateListItem' => 'updateListItem'
    ];
    public $values;
    public $entity;
    public $selected_region;
    public $selected_currency;
    public $selected_country;

    public function updateListItem($payload)
    {
        if (isset($payload['region_id']) && $payload['entity'] === 'country' && $this->entity === 'country') {
            $this->values = Country::withTrashed()->where('region_id', $payload['region_id'])->get();
        } else if (isset($payload['country_id']) && $payload['entity'] === 'city' && $this->entity === 'city') {
            $this->values = City::withTrashed()->where('country_id', $payload['country_id'])->get();
        }
    }

    public function updateListItemAfterDelete($payload)
    {
        if ($payload['entity'] === 'region' && $this->entity === 'region') {

            $this->values = Region::withTrashed()->get();

            $next_region = Region::first() ? Region::first()->id : null;
            $this->selected_region = $next_region;
            $this->dispatch('update_add_item_form_selected_region', [
                'value' => $this->selected_region
            ]);

            $country_id = $next_region ?
                        Country::where('region_id', $next_region)->first()->id : collect();

            $this->dispatch('updateListItemAfterDelete', [
                'entity' => 'country',
                'region' => $next_region,
                'value' => $country_id
            ]);

            $this->dispatch('refreshValues', [
                'entity' => 'region',
                'value' => $next_region
            ]);

        } else if ($payload['entity'] === 'country' && $this->entity === 'country') {

            $country_id = $payload['value'];

            $this->values = $payload['region'] ?
                        Country::withTrashed()->where('region_id', $payload['region'])->get() : collect();

            $next_country = $payload['region'] ?
                        (Country::where('region_id', $payload['region'])->first() ?
                            Country::where('region_id', $payload['region'])->first()->id: null) : null;

            $this->selected_country = $next_country;
            $this->dispatch('update_add_item_form_selected_country', [
                'value' => $this->selected_country
            ]);

            $this->dispatch('updateListItemAfterDelete', [
                    'entity' => 'city',
                    'country' => $next_country
            ]);

            $this->dispatch('refreshValues', [
                'entity' => 'country',
                'value' => $payload['region'],
                'selected_value' => $next_country
            ]);

        } else if ($payload['entity'] === 'city' && $this->entity === 'city') {
            $this->selected_country = $payload['country'];
            $this->values = isset($payload['country']) ?
                        City::withTrashed()->where('country_id', $payload['country'])->get() : collect();
        }
    }

    public function updateListItemAfterRestore($payload)
    {
        if ($this->entity === 'region' && $payload['entity'] === 'region') {

            $this->values = Region::withTrashed()->get();

            $first_region = Region::first() ? Region::first()->id : null;
            $this->selected_region = $first_region;
            $this->dispatch('update_add_item_form_selected_region', [
                'value' => $this->selected_region
            ]);

            $country_id = $first_region ?
                        Country::where('region_id', $first_region)->first()->id : collect();

            $this->dispatch('updateListItemAfterRestore', [
                'entity' => 'country',
                'region' => $first_region,
                'value' => $country_id
            ]);

            $this->dispatch('refreshValues', [
                'entity' => 'region',
                'value' => $first_region
            ]);

        } else if ($this->entity === 'country' && $payload['entity'] === 'country') {

            $country_id = $payload['value'];
            $this->selected_country = $country_id;
            $this->dispatch('update_add_item_form_selected_country', [
                'value' => $this->selected_country
            ]);

            $this->values = $payload['region'] ?
                        Country::withTrashed()->where('region_id', $payload['region'])->get() : collect();

            $this->dispatch('updateListItemAfterRestore', [
                    'entity' => 'city',
                    'country' => $country_id
            ]);

            $this->dispatch('refreshValues', [
                'entity' => 'country',
                'value' => $payload['region'],
                'selected_value' => $country_id
            ]);

        } else if ($this->entity === 'city' && $payload['entity'] === 'city') {
            $this->selected_country = $payload['country'];
            $this->values = isset($payload['country']) ?
                        City::withTrashed()->where('country_id', $payload['country'])->get() : collect();
        }
    }

    public function deleteItem($item_id)
    {
        if ($this->entity === 'region') {
            Region::find($item_id)->delete();
            $this->dispatch('updateListItemAfterDelete', [
                'entity' => 'region',
                'value' => $item_id
            ]);
        } elseif ($this->entity === 'country') {
            $region_id = Country::find($item_id)->region_id;
            Country::find($item_id)->delete();
            $this->dispatch('updateListItemAfterDelete', [
                'entity' => 'country',
                'region' => $region_id,
                'value' => $item_id,
            ]);
        } elseif ($this->entity === 'city') {
            $country_id = City::find($item_id)->country_id;
            City::find($item_id)->delete();
            $this->dispatch('updateListItemAfterDelete', [
                'entity' => 'city',
                'country' => $country_id
            ]);
        }
    }

    public function restoreItem($item_id)
    {
        if ($this->entity === 'region') {
            Region::withTrashed()->find($item_id)->restore();
            $this->dispatch('updateListItemAfterRestore', [
                'entity' => 'region',
                'value' => $item_id
            ]);
        } elseif ($this->entity === 'country') {
            $region_id = Country::withTrashed()->find($item_id)->region_id; //2
            Country::withTrashed()->find($item_id)->restore();
            $this->dispatch('updateListItemAfterRestore', [
                'entity' => 'country',
                'region' => $region_id,
                'value' => $item_id
            ]);
        } elseif ($this->entity === 'city') {
            $country_id = City::withTrashed()->find($item_id)->country_id;
            City::withTrashed()->find($item_id)->restore();
            $this->dispatch('updateListItemAfterRestore', [
                'entity' => 'city',
                'country' => $country_id
            ]);
        }
    }

    public function render()
    {
        return view('livewire.list-of-items');
    }

    public function mount()
    {
        if ($this->entity === 'region') {
            $this->values = Region::withTrashed()->get();
        } elseif ($this->entity === 'country') {
            $regions = Region::all();
            $first_region = $regions->first();
            $this->values = $first_region ?
                Country::withTrashed()->where('region_id', $first_region->id)->get() : collect();
            $this->selected_region = $regions->first() ? $regions->first()->id : null;
            $this->dispatch('update_add_item_form_selected_region', [
                'value' => $this->selected_region
            ]);
            $this->selected_currency = Currency::first()->id;
            $this->dispatch('update_add_item_form_selected_currency', [
                'value' => $this->selected_currency
            ]);
        } elseif ($this->entity === 'city') {
            $regions = Region::all();
            $first_region = $regions->first();
            $countries = $first_region ?
                Country::where('region_id', $first_region->id)->get() : collect();
            $first_country = $countries->first();
            $this->values = $first_country ?
                City::withTrashed()->where('country_id', $first_country->id)->get() : collect();
            $this->selected_region = $regions->first() ? $regions->first()->id : null;
            $this->dispatch('update_add_item_form_selected_region', [
                'value' => $this->selected_region
            ]);
            $this->selected_country = $countries->first() ? $countries->first()->id : null;
            $this->dispatch('update_add_item_form_selected_country', [
                'value' => $this->selected_country
            ]);
        } elseif ($this->entity === 'currency') {
            $this->values = Currency::all();
        } elseif ($this->entity === 'category') {
            $this->values = Category::all();
        } elseif ($this->entity === 'status') {
            $this->values = Status::all();
        }
    }
}
