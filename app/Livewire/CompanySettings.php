<?php

namespace App\Livewire;

use Livewire\Component;

use App\Models\Region;
use App\Models\CompanyRegion;
use App\Services\CompanyService;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;

class CompanySettings extends Component
{
    use WithFileUploads;
    protected $listeners = ['setCompanyRegions' => 'setCompanyRegions'];
    public $companyName;
    public $companyAddress;
    public $currencies;
    public $existingRegions;
    public $allRegions;
    public $defaultCurrency;
    public $displayInvoiceAmount;
    public $success;
    public function toggleRegion($region)
    {
        $companyId = Auth::user()->company->id;
        $regionId = Region::where('name', $region)->pluck('id');
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

    public function updatedDisplayInvoiceAmount()
    {
        $company = Auth::user()->company;
        $company->display_invoice_amount = $this->displayInvoiceAmount;
        if ($this->displayInvoiceAmount) {
            $this->dispatch('displayInvoiceAmount');
        } else {
            $this->dispatch('hideInvoiceAmount');
        }
    }

    public function updatedDefaultCurrency()
    {
        $company = Auth::user()->company;
        $company->default_currency = $this->currencies[$this->defaultCurrency];
    }

    public function save()
    {
        $this->validate([
            'companyName' => 'required|string',
            'companyAddress' => 'required|string',
            'defaultCurrency' => 'required|string',
            'displayInvoiceAmount' => 'required|boolean'
        ]);

        $company = Auth::user()->company;

        app(CompanyService::class)->updateCompany($company, [
            'name' => $this->companyName,
            'address' => $this->companyAddress,
            'default_currency' => $this->defaultCurrency,
            'display_invoice_amount' => $this->displayInvoiceAmount,
            'logo' => $this->logo,
        ]);

        $companyRegions = CompanyRegion::where('company_id', $company->id)->get();
        foreach ($companyRegions as $companyRegion) {
            if (isset($companyRegion->selectedBeforeSave)) {
                $companyRegion->selected = $companyRegion->selectedBeforeSave;
                $companyRegion->save();
            }
        }

        $this->success = true;
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
        $this->displayInvoiceAmount = Auth::user()->company->display_invoice_amount ?? 'false';
        $this->success = false;
    }
}
