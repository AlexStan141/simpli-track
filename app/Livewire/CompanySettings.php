<?php

namespace App\Livewire;

use Livewire\Component;

use App\Models\Company;
use App\Models\Region;
use App\Models\CompanyRegion;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;

class CompanySettings extends Component
{
    public $companyName;
    public $companyAddress;
    public $currencies;
    public $existingRegions;
    public $deletedRegions;
    public $defaultCurrency;
    public function saveRegions()
    {
        $this->validate([
            'companyName' => 'required|string',
            'companyAddress' => 'required|string',
            'defaultCurrency' => 'required|string'
        ]);

        Auth::user()->company->update([
            'name' => $this->companyName,
            'address' => $this->companyAddress,
            'default_currency' => $this->defaultCurrency

        ]);

        $this->dispatch('toggleRegions')->component('region-setting');
    }
    public function render()
    {
        return view('livewire.company-settings');
    }

    public function mount()
    {
        $companyRegions = CompanyRegion::where('company_id', Auth::user()->company->id)
                            ->where('selected', true)->get();
        $regionIds = $companyRegions->pluck('region_id');
        $regions = Region::whereIn('id', $regionIds)->get();
        $regionNames = $regions->pluck('name')->toArray();
        $this->existingRegions = $regionNames;
        $this->deletedRegions = Region::all()->diff($regions)->pluck('name');
    }
}
