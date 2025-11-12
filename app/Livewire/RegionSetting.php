<?php

namespace App\Livewire;

use App\Models\Company;
use App\Models\CompanyRegion;
use App\Models\Region;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class RegionSetting extends Component
{
    protected $listeners = ['toggleRegions' => 'toggle'];
    public $selected;
    public $selectedBeforeSave;
    public $value;
    public function toggleBeforeSave(){
        $company = Auth::user()->company;
        $region = Region::where('name', $this->value)->first();
        $record = CompanyRegion::where('company_id', $company->id)->where('region_id', $region->id)->first();
        $record->selectedBeforeSave = !$record->selectedBeforeSave;
        $this->selectedBeforeSave = $record->selectedBeforeSave;
        $record->save();
    }

     public function toggle(){
        $company = Auth::user()->company;
        $region = Region::where('name', $this->value)->first();
        $record = CompanyRegion::where('company_id', $company->id)->where('region_id', $region->id)->first();
        $record->selected = $this->selectedBeforeSave;
        $this->selected = $this->selectedBeforeSave;
        $record->save();
        $this->dispatch('setCompanyRegions', [
            'selected' => $this->selected,
            'value' => $this->value
        ])->component('company-settings');
        $this->dispatch('setRegionFilters', [
            'selected' => $this->selected,
            'value' => $this->value,
        ])->component('region-filter-list');
    }

    public function render()
    {
        return view('livewire.region-setting');
    }

    public function mount()
    {
        $companyRegions = CompanyRegion::where('company_id', Auth::user()->company->id)
                            ->where('selected', true)->get();
        $regionIds = $companyRegions->pluck('region_id');
        $regionNames = Region::whereIn('id', $regionIds)->pluck('name')->toArray();
        $this->selectedBeforeSave = in_array($this->value, $regionNames);
    }
}
