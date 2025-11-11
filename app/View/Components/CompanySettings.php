<?php

namespace App\View\Components;

use App\Models\Company;
use App\Models\CompanyRegion;
use App\Models\Region;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CompanySettings extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public $companyName,
        public $companyAddress
    )
    {}

    public function saveRegions(){
        $company = Company::where('name', $this->companyName)->where('address', $this->companyAddress);
        $companyId = $company->pluck('id');
        $regionsIds = Region::where('company_id', $company->pluck('id')[0])->pluck("id");
        $companyRegions = CompanyRegion::where('company_id', $companyId)->whereIn('region_id', $regionsIds);
        foreach($companyRegions as $companyRegion){
            $companyRegion->selected = $companyRegion->selectedBeforeSave;
            $companyRegion->save();
        }
    }
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {

        return view('components.company-settings');
    }
}
