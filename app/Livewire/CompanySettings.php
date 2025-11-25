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
            'logo' => 'image|mimes:jpg,jpeg,png|max:204800',
        ]);
    }

    public function save()
    {
        $this->validate([
            'companyName' => 'required|string',
            'companyAddress' => 'required|string',
            'displayInvoiceAmount' => 'required|boolean',
        ]);

        $company = Auth::user()->company;

        if ($this->logo instanceof UploadedFile) {
            $this->validate([
                'logo' => 'nullable|image|mimes:jpg,jpeg,png|max:204800',
            ]);
            $path = $this->logo->store('company_logos', 'public');
            $company->logo = $path;
        } else {
            // deja e path salvat, nu mai validezi ca imagine
            $company->logo = $this->logo;
        }

        $company->name = $this->companyName;
        $company->currency_id = $this->defaultCurrency;
        $company->address = $this->companyAddress;
        $company->display_invoice_amount = $this->displayInvoiceAmount;
        $company->save();

        $companyRegions = Region::where('company_id', $company->id)->get();
        foreach ($companyRegions as $companyRegion) {
            $companyRegion->selected = $companyRegion->selected_before_save;
            $companyRegion->save();
        }

        return redirect()->to(route('settings.company'))->with("success", "Settings updated successfully!");
    }

    public function toggleRegion($region)
    {
        $company = Auth::user()->company;
        $companyRegion = Region::where('name', $region)->where('company_id', $company->id)->first();
        if (in_array($region, $this->existingRegions)) {
            $this->existingRegions = array_filter($this->existingRegions, function ($el) use ($region) {
                return $el !== $region;
            });
            $companyRegion->selected_before_save = false;
            $companyRegion->save();
        } else {
            $this->existingRegions[] = $region;
            $companyRegion->selected_before_save = true;
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
        $this->currencies = Currency::pluck('name', 'id');
        $this->defaultCurrency = Auth::user()->company->currency->id;
        $this->displayInvoiceAmount = $company->display_invoice_amount ?? 'false';
        $this->logo = $company->logo ?? null;
        $regions = $company->regions->where('selected', true);
        $regionNames = $regions->pluck('name')->toArray();
        $this->existingRegions = $regionNames;
        $this->allRegions = Region::all()->where('company_id', $company->id)->pluck('name')->toArray();
    }
}
