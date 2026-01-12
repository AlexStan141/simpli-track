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
        if(count($this->existingRegions) == 0)
        {
            $regions = Region::all();
            foreach($regions as $region){
                $region->selected_before_save = $region->selected;
                $region->save();
            }
            $this->existingRegions = Region::where('selected', true)->pluck('name', 'id')->toArray();
            return redirect()->back()->with('error', 'You must select at least one region');
        }

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

        $companyRegions = Region::all();
        foreach ($companyRegions as $companyRegion) {
            $companyRegion->selected = $companyRegion->selected_before_save;
            $companyRegion->save();
        }

        return redirect()->to(route('settings.company'))->with("success", "Settings updated successfully!");
    }

    public function toggleRegion($region)
    {
        $companyRegion = Region::where('name', $region)->first();
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
        $this->defaultCurrency = Auth::user()->company->currency->id ?? null;
        $this->displayInvoiceAmount = $company->display_invoice_amount ?? 'false';
        $this->logo = $company->logo ?? null;
        $regions = Region::where('selected', true);
        $regionNames = $regions->pluck('name')->toArray();
        $this->existingRegions = $regionNames;
        $this->allRegions = Region::all()->pluck('name')->toArray();
    }
}
