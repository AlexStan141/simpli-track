<?php

namespace App\Livewire;

use App\Models\Company;
use App\Models\CompanyRegion;
use App\Models\Region;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class RegionFilterList extends Component
{

    public array $allRegions;
    public array $selectedRegions;

    protected $listeners = ["setRegionFilters" => "setRegionFilters"];

    public function setRegionFilters($payload){
        if($payload['selected']){
            $this->selectedRegions = array_filter($this->selectedRegions, function($el) use($payload){
                return $el !== $payload['value'];
            });
        } else {
            $this->selectedRegions[] = $payload['value'];
        }
    }

    public function render()
    {
        return view('livewire.region-filter-list');
    }

    public function mount()
    {
        $company = Company::all()->first();
        $companyRegions = $company->regions->where('selected', true);
        $regionNames = $companyRegions->pluck('name')->toArray();
        $this->allRegions = $regionNames;
        $this->selectedRegions = $this->allRegions;
    }
}
