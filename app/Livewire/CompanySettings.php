<?php

namespace App\Livewire;

use Livewire\Component;

use App\Models\Region;
use App\Models\CompanyRegion;
use App\Services\CompanyService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\UploadedFile;
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
    public $region = null;
    public $defaultCurrency;
    public $displayInvoiceAmount;
    public $logo;
    public $success;
    public function toggleRegion($region)
    {
        dd("Enters here");
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
        dd("Enters here");
        $this->validate([
            'companyName' => 'required|string',
            'companyAddress' => 'required|string',
            'defaultCurrency' => 'required|string',
            'displayInvoiceAmount' => 'required|boolean',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $company = Auth::user()->company;

        if ($this->logo instanceof UploadedFile) {
            $path = $this->logo->store('logos', 'public');
            $company->logo = $path;
        }

        $company->name = $this->companyName;
        $company->address = $this->companyAddress;
        $company->default_currency = $this->defaultCurrency;
        $company->display_invoice_amount = $this->displayInvoiceAmount;
        $company->save();

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
        $company = Auth::user()->company;
        $this->companyName = $company->name;
        $this->companyAddress = $company->address;
        $this->currencies = collect([1 => 'USD', 2 => 'RON', 3 => 'ARS']);
        $this->defaultCurrency = $company->default_currency;
        $this->displayInvoiceAmount = $company->display_invoice_amount ?? 'false';
        $this->success = false;
        $companyRegions = CompanyRegion::where('company_id', Auth::user()->company->id)
            ->where('selected', true)->get();
        $regionIds = $companyRegions->pluck('region_id');
        $regions = Region::whereIn('id', $regionIds)->get();
        $regionNames = $regions->pluck('name')->toArray();
        $this->existingRegions = $regionNames;
        $this->allRegions = Region::all()->pluck('name')->toArray();
    }
}
