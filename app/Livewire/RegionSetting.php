<?php

namespace App\Livewire;

use App\Models\Company;
use App\Models\Region;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class RegionSetting extends Component
{
    public $selected;
    public $value;
    public function toggle(){
        $this->selected = !$this->selected;
        $company = Auth::user()->company;
        $region = Region::where('name', $this->value)->first();
        if(!$this->selected){
            $region->companies()->detach($company->id);
            $company->regions()->detach($region->id);
        } else {
            $region->companies()->attach($company->id);
        }
    }
    public function render()
    {
        return view('livewire.region-setting');
    }
}
