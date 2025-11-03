<?php

namespace App\Livewire;

use App\Models\Country;
use Livewire\Component;

class FilterList extends Component
{
    public $regions;
    public $selectedRegions;
    public $countries;
    public $selectedCountry;
    public $statuses;
    public $selectedStatus;
    public $categories;
    public $selectedCategory;

    public function updatedSelectedRegion(){
        $this->countries = Country::where('region_id', 'in', $this->selectedRegions)->pluck('name', 'id');
        $this->selectedCountry = $this->countries->keys()->first();
    }

    public function render()
    {
        return view('livewire.filter-list');
    }
}
