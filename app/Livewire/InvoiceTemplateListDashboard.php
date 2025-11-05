<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Country;
use App\Models\InvoiceTemplate;
use App\Models\Region;
use App\Models\Status;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class InvoiceTemplateListDashboard extends Component
{
    public array $selectedRegions = [];
    public $selectedStatus;
    public $selectedCountry;
    public $selectedCategory;
    protected $listeners = [
        'toggleRegion' => 'handleToggle',
        'statusChanged' => 'handleStatus',
        'countryChanged' => 'handleCountry',
        'categoryChanged' => 'handleCategory'
    ];
    public function handleToggle($payload)
    {
        if ($payload['selected']) {
            $this->selectedRegions[] = trim((string) $payload['value']);
        } else {
            $value = trim((string) $payload['value']);
            $key = array_search($value, array_map('strval', $this->selectedRegions));

            if ($key !== false) {
                unset($this->selectedRegions[$key]);
                $this->selectedRegions = array_values($this->selectedRegions);
            }
        }
        $this->render();
    }

    public function handleStatus($payload){
        $this->selectedStatus = $payload['statusValue'];
        $this->render();
    }

    public function handleCountry($payload){
        $this->selectedCountry = $payload['countryValue'];
        $this->render();
    }

    public function handleCategory($payload){
        $this->selectedCategory = $payload['categoryValue'];
        $this->render();
    }

    public function render()
    {
        $invoice_templates = InvoiceTemplate::select('invoice_templates.*', 'landlords.name')
            ->join('landlords', 'invoice_templates.landlord_id', '=', 'landlords.id')
            ->join('statuses', 'invoice_templates.status_id', '=', 'statuses.id')
            ->join('due_days', 'invoice_templates.due_day_id', '=', 'due_days.id')
            ->join('countries', 'invoice_templates.country_id', '=', 'countries.id')
            ->join('categories', 'invoice_templates.category_id', '=', 'categories.id')
            ->join('users', 'invoice_templates.user_id', '=', 'users.id')
            ->where('invoice_templates.user_id', '=', Auth::id())
            ->whereHas('region', function ($query) {
                $query->whereIn('name', $this->selectedRegions);
            })->whereHas('status', function($query){
                $query->where('name', '=', $this->selectedStatus);
            })->whereHas('country', function($query){
                $query->where('name', '=', $this->selectedCountry);
            })->whereHas('category', function($query){
                $query->where('name', '=', $this->selectedCategory);
            })
            ->paginate(5);
        return view('livewire.invoice-template-list-dashboard', [
            'user_invoices' => $invoice_templates,
        ]);
    }

    public function mount()
    {
        $this->selectedRegions = Region::pluck('name')->toArray();
        $this->selectedStatus = Status::pluck('name')->toArray()[0];
        $this->selectedCountry = Country::pluck('name')->toArray()[0];
        $this->selectedCategory = Category::pluck('name')->toArray()[0];
    }
}
