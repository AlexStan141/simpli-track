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
    public $sortField = 'invoice_templates.created_at';
    public $sortType = "asc";
    public $selectedStatus;
    public $selectedCity;
    public $selectedCategory;
    public function gotoPage($page)
    {
        $this->setPage($page);
    }

    public function sort($field)
    {
        $fieldMap = [
            'location' => 'cities.name',
            'status' => 'statuses.name',
            'due_date' => 'due_days.day',
            'assignee' => "CONCAT(users.first_name, ' ', users.last_name)",
            'last_updated' => 'updated_at'
        ];

        $field = $fieldMap[$field] ?? $field;

        if ($this->sortField === $field) {
            $this->sortType = $this->sortType === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortType = 'asc';
        }
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
        $invoice_templates = InvoiceTemplate::select('invoice_templates.*', 'cities.name', 'statuses.name', 'due_days.day', 'users.first_name')
            ->with(['landlord', 'status', 'due_day', 'invoices_for_attention', 'city', 'category', 'user'])
            ->join('cities', 'invoice_templates.city_id', '=', 'cities.id')
            ->join('statuses', 'invoice_templates.status_id', '=', 'statuses.id')
            ->join('due_days', 'invoice_templates.due_day_id', '=', 'due_days.id')
            ->join('users', 'invoice_templates.user_id', '=', 'users.id')
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

        if ($this->sortField == 'assignee') {
            $invoice_templates = $invoice_templates
                ->orderByRaw($this->sortField, $this->sortType)
                ->paginate(5);
        } else {
            $invoice_templates = $invoice_templates
                ->orderBy($this->sortField, $this->sortType)
                ->paginate(5);
        }


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
