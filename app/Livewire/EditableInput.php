<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\City;
use App\Models\Country;
use App\Models\Currency;
use App\Models\Region;
use App\Models\Status;
use Livewire\Component;

class EditableInput extends Component
{
    public $old_value;
    public $role;
    public $new_value;
    public $edit_mode = false;
    public $deleted;
    public $parent_id = null;
    public $editable;
    public $deletable;
    public function mount($old_value)
    {
        $this->old_value = $old_value;
        $this->new_value = $old_value;
        if ($this->role == 'currency_settings') {
            $this->editable = false;
        } else {
            $this->editable = true;
        }
    }

    public function edit()
    {
        $this->edit_mode = true;
        if ($this->role == 'category_settings') {
            $this->dispatch('close_other_categories', [
                'value' => $this->old_value
            ]);
        } else if ($this->role == 'region_settings') {
            $this->dispatch('close_other_regions', [
                'value' => $this->old_value
            ]);
        } else if ($this->role == 'country_settings') {
            $this->dispatch('close_other_countries', [
                'value' => $this->old_value
            ]);
        } else if ($this->role == 'city_settings') {
            $this->dispatch('close_other_cities', [
                'value' => $this->old_value
            ]);
        }
    }

    public function save()
    {
        if ($this->role == 'city_settings') {
            $city = City::where('name', $this->old_value)->first();
            $city->name = $this->new_value;
            $city->save();
            $this->dispatch('city_list_updated');
        } else if ($this->role == 'country_settings') {
            $country = Country::where('name', $this->old_value)->first();
            $country->name = $this->new_value;
            $country->save();
            $this->dispatch('country_list_updated');
        } else if ($this->role == 'region_settings') {
            $region = Region::where('name', $this->old_value)->first();
            $region->name = $this->new_value;
            $region->save();
            $this->dispatch('region_list_updated');
        } else if ($this->role == 'category_settings') {
            $category = Category::where('name', $this->old_value)->first();
            $category->name = $this->new_value;
            $category->save();
            $this->dispatch('category_list_updated');
        } else if ($this->role == 'status_settings') {
            $status = Status::where('name', $this->old_value)->first();
            $status->name = $this->new_value;
            $status->save();
            $this->dispatch('status_list_updated');
        }
        $this->old_value = $this->new_value;
        $this->edit_mode = false;
    }

    public function deleteInput()
    {
        if ($this->role == 'city_settings') {
            $city = City::where('name', $this->old_value)->first();
            $this->dispatch('confirm-delete-modal-display', [
                'entity' => 'city',
                'entity_id' => $city->id,
                'action' => 'delete'
            ]);
            // $this->dispatch('city_list_updated');
        } else if ($this->role == 'country_settings') {
            $country = Country::where('name', $this->old_value)->first();
            $this->dispatch('confirm-delete-modal-display', [
                'entity' => 'country',
                'entity_id' => $country->id,
                'action' => 'delete'
            ]);
            // $this->dispatch('country_list_updated');
            // $this->dispatch('update_after_country_delete', [
            //     'country_id' => $country->id
            // ]);
        } else if ($this->role == 'region_settings') {
            $region = Region::where('name', $this->old_value)->first();
            $this->dispatch('confirm-delete-modal-display', [
                'entity' => 'region',
                'entity_id' => $region->id,
                'action' => 'delete'
            ]);
            // $this->dispatch('region_list_updated');
            // $this->dispatch('update_after_region_delete', [
            //     'region_id' => $region->id
            // ]);
        } else if ($this->role == 'category_settings') {
            $category = Category::where('name', $this->old_value)->first();
            $this->dispatch('confirm-delete-modal-display', [
                'entity' => 'category',
                'entity_id' => $category->id,
                'action' => 'delete'
            ]);
        } else if ($this->role == 'currency_settings') {
            $currency = Currency::where('name', $this->old_value)->first();
            $this->dispatch('confirm-delete-modal-display', [
                'entity' => 'currency',
                'entity_id' => $currency->id,
                'action' => 'delete'
            ]);
        }
    }

    public function restore()
    {
        if ($this->role == 'category_settings') {
            $category = Category::withTrashed()->where('name', $this->old_value)->first();
            $category->restore();
        } else if ($this->role == 'status_settings') {
            $status = Status::withTrashed()->where('name', $this->old_value)->first();
            $status->restore();
        } else if ($this->role == 'region_settings') {
            $region = Region::withTrashed()->where('name', $this->old_value)->first();
            $region->restore();
            $this->dispatch('region_restore_event');
            $this->deleted = false;
            $country_names = Country::where('region_id', $region->id)->pluck('name');
            foreach ($country_names as $country_name) {
                $this->dispatch('restore-country', [
                    'role' => 'country_settings',
                    'name' => $country_name
                ]);
            }

            $country_ids = Country::where('region_id', $region->id)->pluck('id');
            $city_names = City::whereIn('country_id', $country_ids)->pluck('name');
            foreach ($city_names as $city_name) {
                $this->dispatch('restore-city', [
                    'role' => 'city_settings',
                    'name' => $city_name
                ]);
            }
        } else if ($this->role == 'country_settings') {
            $country = Country::withTrashed()->where('name', $this->old_value)->first();
            if (!$country->currency->deleted_at) {
                $country->restore();
                $this->dispatch('country_restore_event', [
                    'country_id' => $country->id
                ]);

                $city_names = City::where('country_id', $country->id)->pluck('name');
                foreach ($city_names as $city_name) {
                    $this->dispatch('restore-city', [
                        'role' => 'city_settings',
                        'name' => $city_name
                    ]);
                }
            } else {
                dd("Restore " . $country->currency->name . " currency!");
            }
        } else if ($this->role == 'city_settings') {
            $city = City::withTrashed()->where('name', $this->old_value)->first();
            $city->restore();
            $this->dispatch('city_list_updated');
        } else if ($this->role == 'currency_settings') {
            $currency = Currency::withTrashed()->where('name', $this->old_value)->first();
            $currency->restore();
            $this->dispatch('currency_restore_event', [
                'name' => $this->old_value
            ]);
        }
        $this->deleted = false;
    }

    public function close_editable_input($payload)
    {
        if ($payload['old_value'] == $this->old_value && $payload['role'] == $this->role) {
            $this->edit_mode = false;
        }
    }

    public function update_after_country_delete($payload)
    {

        //Each city has an editable input related to it
        //Change EditableInput state of country related cities to deleted

        if ($this->role == 'city_settings') {
            if ($this->parent_id == $payload['country_id']) {
                $this->deleted = true;
            }
        }
    }

    public function update_after_region_delete($payload)
    {

        //Each country and city has an editable input related to it
        //Change EditableInput state of region related countries and cities to deleted

        if ($this->role == 'country_settings') {
            if ($this->parent_id == $payload['region_id']) {
                $this->deleted = true;
            }
        }
        if ($this->role == 'city_settings') {
            $country = Country::withTrashed()->where('id', $this->parent_id)->first();
            if ($country && $country->region_id == $payload['region_id']) {
                $this->deleted = true;
            }
        }
    }

    public function delete_if_value($role, $value)
    {
        if ($this->role == $role && $this->old_value == $value) {
            $this->deleted = true;
        }
    }

    public function restore_if_value($payload)
    {
        if ($this->role == $payload['role'] && $this->old_value == $payload['name']) {
            $this->deleted = false;
        }
    }

    public function render()
    {
        return view('livewire.editable-input');
    }
}
