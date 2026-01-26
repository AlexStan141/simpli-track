<?php

namespace App\Livewire;

use App\Models\Country;
use App\Models\Region;
use Livewire\Component;

class SelectInput extends Component
{
    protected $listeners = ['refreshSelect' => 'refreshSelect'];
    public $values;
    public $entity;
    public $selectedValue = null;

    public function updateSelectedValue($value)
    {
        $this->selectedValue = $value;
        if($this->entity === 'region'){
            $this->dispatch('refreshSelect', [
                'entity' => 'region',
                'value' => $value
            ]);
            $this->dispatch('refreshSelect', [
                'entity' => 'country',
                'value' => $value
            ]);
            $this->dispatch('update_list_items_event',[
                'entity' => 'country',
                'region_id' => $value
            ]);
            $this->dispatch('update_list_items_event', [
                'entity' => 'city',
                'region_id' => $value,
                'country_id' => Country::where('region_id', $value)->first()->id
            ]);
        } else if ($this->entity === 'country'){
            $this->dispatch('update_list_items_event',[
                'entity' => 'country',
                'region_id' => Country::where('id', $value)->first()->region_id
            ]);
            $this->dispatch('update_list_items_event', [
                'entity' => 'city',
                'region_id' => Country::where('id', $value)->first()->region_id,
                'country_id' => $value
            ]);
            $this->dispatch('refreshSelect', [
                'entity' => 'country',
                'value' => Country::where('id', $value)->first()->region_id,
                'country_id' => $value
            ]);
        }
    }

    public function refreshSelect($payload)
    {
        if ($this->entity === 'region' && $payload['entity'] === 'region') {
            $this->values = Region::pluck('name', 'id')->toArray();
            $smallest_id = array_key_first($this->values);
            $this->selectedValue = $payload['value'] ?? $smallest_id;
            $this->dispatch('refreshSelect', [
                'entity' => 'country',
                'value' => $this->selectedValue
            ]);
            $this->dispatch('update_list_items_event',[
                'entity' => 'country',
                'region_id' => $this->selectedValue
            ]);
        } else if ($this->entity === 'country' && $payload['entity'] === 'country') {
            $this->values = Country::where('region_id', '=', $payload['value'])->pluck('name', 'id')->toArray();
            $smallest_id = array_key_first($this->values);
            $this->selectedValue = $payload['country_id'] ?? $smallest_id;
            $this->dispatch('update_list_items_event',[
                'entity' => 'city',
                'region_id' => $payload['value'],
                'country_id' => $this->selectedValue
            ]);
        }
    }

    public function render()
    {
        return view('livewire.select-input');
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
            $this->values = Country::where('region_id', '=', $region_id)->pluck('name', 'id')->toArray();
            $smallest_id = array_key_first($this->values);
            $this->selectedValue = $smallest_id;
            return view('livewire.select-input');
        }
    }
}
