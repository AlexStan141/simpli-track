<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\CompanyRegion;
use App\Models\Region;
use App\Models\Currency;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;

class CompanySettings extends Component
{
    use WithFileUploads;
    public $variable;
    public $existingRegions;
    public $allRegions;
    public $companyName;
    public $companyAddress;
    public $defaultCurrency;
    public $displayInvoiceAmount;
    public $currencies;

    public $logo;

    public function updatedPhoto()
    {
        $this->validate([
            'logo' => 'image|max:204800',
        ]);
    }

    public function save()
    {
        $this->validate([
            'companyName' => 'required|string',
            'companyAddress' => 'required|string',
            'displayInvoiceAmount' => 'required|boolean',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png|max:204800'
        ]);

        $company = Auth::user()->company;

        if ($this->logo instanceof UploadedFile) {
            $path = $this->logo->store('company_logos', 'public');
            $this->logo = $path;
            $company->logo = $path;
        }

        $company->name = $this->companyName;
        $company->currency_id = $this->defaultCurrency;
        $company->address = $this->companyAddress;
        $company->display_invoice_amount = $this->displayInvoiceAmount;
        $company->save();

        $companyRegions = CompanyRegion::where('company_id', $company->id)->get();
        foreach ($companyRegions as $companyRegion) {
            if (isset($companyRegion->selectedBeforeSave)) {
                $companyRegion->selected = $companyRegion->selectedBeforeSave;
                $companyRegion->save();
            }
        }
    }

    public function toggleRegion($region)
    {
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
        return view('livewire.company-settings');
    }

    public function mount()
    {
        $company = Auth::user()->company;
        $this->companyName = $company->name;
        $this->companyAddress = $company->address;
        $companyRegions = CompanyRegion::where('company_id', Auth::user()->company->id)
            ->where('selected', true)->get();
        $this->currencies = Currency::pluck('name', 'id');
        $this->defaultCurrency = Auth::user()->company->currency->id;
        $this->displayInvoiceAmount = $company->display_invoice_amount ?? 'false';
        $this->logo = $company->logo ?? null;
        $regionIds = $companyRegions->pluck('region_id');
        $regions = Region::whereIn('id', $regionIds)->get();
        $regionNames = $regions->pluck('name')->toArray();
        $this->existingRegions = $regionNames;
        $this->allRegions = Region::all()->pluck('name')->toArray();
    }
}
