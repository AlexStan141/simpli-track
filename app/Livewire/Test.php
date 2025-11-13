<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\CompanyRegion;
use App\Models\Region;
use Illuminate\Support\Facades\Auth;

class Test extends Component
{
    public $variable;
    public $existingRegions;
    public $allRegions;
    public $companyName;
    public $companyAddress;

    public function something($payload)
    {
        dump($this->existingRegions);
        dump($this->allRegions);
    }

    public function save()
    {
        $this->validate([
            'companyName' => 'required|string',
            'companyAddress' => 'required|string',
        ]);

        $company = Auth::user()->company;
        $company->name = $this->companyName;
        $company->address = $this->companyAddress;
        $company->save();

        $companyRegions = CompanyRegion::where('company_id', $company->id)->get();
        foreach ($companyRegions as $companyRegion) {
            if (isset($companyRegion->selectedBeforeSave)) {
                $companyRegion->selected = $companyRegion->selectedBeforeSave;
                $companyRegion->save();
            }
        }
    }

    public function toggleRegion($region){
        $companyId = Auth::user()->company->id;
        $regionId = Region::where('name', $region)->value('id');
        $companyRegion = CompanyRegion::where('company_id', $companyId)->where('region_id', $regionId)->first();
        if (in_array($region, $this->existingRegions)) {
            $this->existingRegions = array_filter($this->existingRegions, function ($el) use ($region) {
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


    public function render()
    {
        return view('livewire.test');
    }

    public function mount()
    {
        $company = Auth::user()->company;
        $this->companyName = $company->name;
        $this->companyAddress = $company->address;
        $companyRegions = CompanyRegion::where('company_id', Auth::user()->company->id)
            ->where('selected', true)->get();
        $regionIds = $companyRegions->pluck('region_id');
        $regions = Region::whereIn('id', $regionIds)->get();
        $regionNames = $regions->pluck('name')->toArray();
        $this->existingRegions = $regionNames;
        $this->allRegions = Region::all()->pluck('name')->toArray();
    }
}


