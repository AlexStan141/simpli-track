<?php

namespace App\Livewire;

use App\Models\Bill;
use App\Models\Category;
use App\Models\City;
use App\Models\Company;
use App\Models\CompanyRegion;
use App\Models\Country;
use App\Models\InvoiceTemplate;
use App\Models\Note;
use App\Models\Region;
use App\Models\Status;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class BillList extends Component
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
        'categoryChanged' => 'handleCategory',
        'category_list_changed' => 'refresh_bill_list'

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

    public function refresh_bill_list(){
        $bills = Bill::select('bills.*', 'cities.name', 'due_days.day', 'users.first_name')
            ->with(['invoice_template', 'invoice_template.due_day',
            'invoice_template.invoice_for_attention', 'invoice_template.city',
            'invoice_template.category', 'invoice_template.user', 'invoice_template.region', 'status', 'status.company'])
            ->join('invoice_templates', 'invoice_templates.id', '=', 'bills.invoice_template_id')
            ->join('cities', 'invoice_templates.city_id', '=', 'cities.id')
            ->join('due_days', 'invoice_templates.due_day_id', '=', 'due_days.id')
            ->join('invoice_for_attentions', 'invoice_templates.invoice_for_attention_id', '=', 'invoice_for_attentions.id')
            ->join('users', 'invoice_templates.user_id', '=', 'users.id')
            ->where('user_id', Auth::id())
            ->whereHas('invoice_template.region', function ($query) {
                 $query->whereIn('name', $this->selectedRegions);
            })
            ->whereHas('status.company', function($query){
                $query->whereNotNull('id');
            });

        if ($this->selectedStatus !== 'All') {
             $bills->whereHas('status', function ($query) {
                $query->where('name', '=', $this->selectedStatus);
             });
        }
        if ($this->selectedCity !== 'All') {
             $bills->whereHas('invoice_template.city', function ($query) {
                $query->where('name', '=', $this->selectedCity);
             });
        }
        if ($this->selectedCategory !== 'All') {
             $bills->whereHas('invoice_template.category', function ($query) {
                $query->where('name', '=', $this->selectedCategory);
             });
        }

        // if ($this->sortField == 'assignee') {
        //     $invoice_templates = $invoice_templates
        //         ->orderByRaw($this->sortField, $this->sortType)
        //         ->paginate(5);
        // } else {
        //     $invoice_templates = $invoice_templates
        //         ->orderBy($this->sortField, $this->sortType)
        //         ->paginate(5);
        // }
        $bills = $bills->paginate(5);
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
        $bills = Bill::select('bills.*', 'cities.name', 'due_days.day', 'users.first_name')
            ->with(['invoice_template', 'invoice_template.due_day',
            'invoice_template.invoice_for_attention', 'invoice_template.city',
            'invoice_template.category', 'invoice_template.user', 'invoice_template.region', 'status', 'status.company'])
            ->join('invoice_templates', 'invoice_templates.id', '=', 'bills.invoice_template_id')
            ->join('cities', 'invoice_templates.city_id', '=', 'cities.id')
            ->join('due_days', 'invoice_templates.due_day_id', '=', 'due_days.id')
            ->join('invoice_for_attentions', 'invoice_templates.invoice_for_attention_id', '=', 'invoice_for_attentions.id')
            ->join('users', 'invoice_templates.user_id', '=', 'users.id')
            ->where('user_id', Auth::id())
            ->whereHas('invoice_template.region', function ($query) {
                 $query->whereIn('name', $this->selectedRegions);
            })
            ->whereHas('status.company', function($query){
                $query->whereNotNull('id');
            });


        if ($this->selectedStatus !== 'All') {
             $bills->whereHas('status', function ($query) {
                $query->where('name', '=', $this->selectedStatus);
             });
        }
        if ($this->selectedCity !== 'All') {
             $bills->whereHas('invoice_template.city', function ($query) {
                $query->where('name', '=', $this->selectedCity);
             });
        }
        if ($this->selectedCategory !== 'All') {
             $bills->whereHas('invoice_template.category', function ($query) {
                $query->where('name', '=', $this->selectedCategory);
             });
        }

        // if ($this->sortField == 'assignee') {
        //     $invoice_templates = $invoice_templates
        //         ->orderByRaw($this->sortField, $this->sortType)
        //         ->paginate(5);
        // } else {
        //     $invoice_templates = $invoice_templates
        //         ->orderBy($this->sortField, $this->sortType)
        //         ->paginate(5);
        // }
        $bills = $bills->paginate(5);
        return view('livewire.bill-list', [
            'bills' => $bills
        ]);
    }

    public function mount()
    {
        $company = Company::all()->first();
        $regions = $company->regions->where('selected', true);
        $this->selectedRegions = $regions->pluck('name')->toArray();
        $this->selectedStatus = 'All';
        $this->selectedCity = 'All';
        $this->selectedCategory = 'All';
    }
}
