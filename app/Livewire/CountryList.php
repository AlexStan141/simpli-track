<?php

namespace App\Livewire;

use App\Models\Country;
use App\Models\Region;
use Livewire\Component;

class CountryList extends Component
{
    protected $listeners = ['region_list_updated' => 'refresh',
                            'country_list_updated' => 'refresh'];
    public $regions;
    public $selected_region_id;
    public $countries;

    public function trigger_region_update(){
        $this->countries = Country::where('region_id', $this->selected_region_id)
                            ->whereNotNull('company_id')->get();
    }

    public function refresh()
    {
        $this->regions = Region::pluck('name', 'id');
        $this->selected_region_id = Region::all()->first()->id;
        $this->countries = Country::where('region_id', $this->selected_region_id)->get();
    }

    public function render()
    {
        return view('livewire.country-list');
    }

    public function mount(){
        $this->regions = Region::pluck('name', 'id');
        $this->selected_region_id = Region::all()->first()->id;
        $this->countries = Country::where('region_id', $this->selected_region_id)->get();
    }
}
