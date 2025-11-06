<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\City;
use App\Models\Country;
use App\Models\InvoiceTemplate;
use App\Models\Region;
use App\Models\Status;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class InvoiceTemplateListDashboard extends Component
{
    use WithPagination;
    public array $selectedRegions = [];
    public $selectedStatus;
    public $selectedCity;
    public $selectedCategory;
    public function gotoPage($page)
    {
        $this->setPage($page);
    }
    protected $listeners = [
        'toggleRegion' => 'handleToggle',
        'statusChanged' => 'handleStatus',
        'cityChanged' => 'handleCity',
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

    public function handleStatus($payload)
    {
        $this->selectedStatus = $payload['statusValue'];
        $this->render();
    }

    public function handleCity($payload)
    {
        $this->selectedCity = $payload['cityValue'];
        $this->render();
    }

    public function handleCategory($payload)
    {
        $this->selectedCategory = $payload['categoryValue'];
        $this->render();
    }

    public function render()
    {
        $invoice_templates = InvoiceTemplate::with(['landlord', 'status', 'due_day', 'invoices_for_attention', 'city', 'category', 'user'])
            ->where('user_id', Auth::id())
            ->whereHas('region', function ($query) {
                $query->whereIn('name', $this->selectedRegions);
            });

        if ($this->selectedStatus !== 'All') {
            $invoice_templates->whereHas('status', function ($query) {
                $query->where('name', '=', $this->selectedStatus);
            });
        }
        if ($this->selectedCity !== 'All') {
            $invoice_templates->whereHas('city', function ($query) {
                $query->where('name', '=', $this->selectedCity);
            });
        }
        if ($this->selectedCategory !== 'All') {
            $invoice_templates->whereHas('category', function ($query) {
                $query->where('name', '=', $this->selectedCategory);
            });
        }
        $invoice_templates = $invoice_templates->paginate(5);
        return view('livewire.invoice-template-list-dashboard', [
            'user_invoices' => $invoice_templates,
        ]);
    }

    public function mount()
    {
        $this->selectedRegions = Region::pluck('name')->toArray();
        $this->selectedStatus = Status::pluck('name')->first();
        $this->selectedCity = City::pluck('name')->first();
        $this->selectedCategory = Category::pluck('name')->first();
    }
}
