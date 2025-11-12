<?php

namespace App\Livewire;

use Livewire\Component;

use App\Models\Region;
use App\Models\CompanyRegion;
use Illuminate\Support\Facades\Auth;

class CompanySettings extends Component
{
    protected $listeners = ['setCompanyRegions' => 'setCompanyRegions'];
    public $companyName;
    public $companyAddress;
    public $currencies;
    public $existingRegions;
    public $allRegions;
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
    }

    public function toggleRegion($region){
        $companyId = Auth::user()->company->id;
        $regionId = Region::where('name', $region)->pluck('id');
        $companyRegion = CompanyRegion::where('company_id', $companyId)->where('region_id', $regionId)->first();
        if(in_array($region, $this->existingRegions)){
            $this->existingRegions = array_filter($this->existingRegions, function($el) use($region){
                return $el !== $region;
            });
            $companyRegion->selectedBeforeSave = false;
            $companyRegion->save();
        } else {
            $this->existingRegions[] = $region;
            $companyRegion->selectedBeforeSave = true;
            $companyRegion->save();
        }
    }

    public function updatedDefaultCurrency(){
        $company = Auth::user()->company;
        $company->default_currency = $this->currencies[$this->defaultCurrency];
        $company->save();
    }

    public function save(){
        $companyId = Auth::user()->company->id;
        $companyRegions = CompanyRegion::where('company_id', $companyId)->get();
        foreach($companyRegions as $companyRegion){
            $companyRegion->selected = $companyRegion->selectedBeforeSave;
            $companyRegion->save();
        }
    }

    public function render()
    {
        return view('livewire.company-settings');
    }

    public function mount()
    {
        $this->companyName = Auth::user()->company->name;
        $this->companyAddress = Auth::user()->company->address;
        $companyRegions = CompanyRegion::where('company_id', Auth::user()->company->id)
                            ->where('selected', true)->get();
        $regionIds = $companyRegions->pluck('region_id');
        $regions = Region::whereIn('id', $regionIds)->get();
        $regionNames = $regions->pluck('name')->toArray();
        $this->existingRegions = $regionNames;
        $this->allRegions = Region::all()->pluck('name')->toArray();
        $this->currencies = collect([1 => 'USD', 2 => 'RON', 3 => 'ARS']);
        $this->defaultCurrency = Auth::user()->company->default_currency;
    }
}
