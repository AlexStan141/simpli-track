<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\City;
use App\Models\Country;
use App\Models\Region;
use App\Models\Status;
use Livewire\Component;

class EditableInput extends Component
{
    protected $listeners = ['close_editable_input' => 'close_editable_input'];
    public $old_value;
    public $role;
    public $new_value;
    public $edit_mode = false;
    public $deleted;

    public function mount($old_value)
    {
        $this->old_value = $old_value;
        $this->new_value = $old_value;
    }

    public function edit()
    {
        $this->edit_mode = true;
        if($this->role == 'category_settings')
        {
            $this->dispatch('close_other_categories', [
                'value' => $this->old_value
            ]);
        }
        else if($this->role == 'region_settings')
        {
            $this->dispatch('close_other_regions', [
                'value' => $this->old_value
            ]);
        }
        else if($this->role == 'country_settings')
        {
            $this->dispatch('close_other_countries', [
                'value' => $this->old_value
            ]);
        }
        else if($this->role == 'city_settings')
        {
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
            $city->delete();
            $this->dispatch('city_list_updated');
        } else if ($this->role == 'country_settings') {
            $country = Country::where('name', $this->old_value)->first();
            $country_id = $country->id;
            $region_id = $country->region_id;
            $country->delete();
            $this->dispatch('country_list_updated');
        } else if ($this->role == 'region_settings') {
            $region = Region::where('name', $this->old_value)->first();
            $region->delete();
            $this->dispatch('region_list_updated');
        } else if ($this->role == 'status_settings') {
            $status = Status::where('name', $this->old_value)->first();
            $status->delete();
            $this->dispatch('status_list_updated');
        } else if ($this->role == 'category_settings') {
            $category = Category::where('name', $this->old_value)->first();
            $this->dispatch('confirm-delete-modal-display', [
                'entity' => 'category',
                'entity_id' => $category->id,
                'action' => 'delete'
            ]);
        }
    }

    public function restore(){
        if($this->role == 'category_settings'){
            $category = Category::withTrashed()->where('name', $this->old_value)->first();
            $category->restore();
        }
        $this->deleted = false;
    }

    public function close_editable_input($payload)
    {
        if($payload['old_value'] == $this->old_value && $payload['role'] == $this->role){
            $this->edit_mode = false;
        }
    }

    public function render()
    {
        return view('livewire.editable-input');
    }
}
