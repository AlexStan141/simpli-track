<?php

namespace App\Livewire;

use App\Models\InvoiceTemplate;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class InvoiceTemplateList extends Component
{
    use WithPagination;

    protected $listeners = [
        'displayInvoiceAmount' => 'displayInvoiceAmount',
        'hideInvoiceAmount' => 'hideInvoiceAmount',
        'invoice-template-status-filter-value-updated' => 'update_list'
    ];
    public $sortField = 'invoice_templates.created_at';
    public $sortType = "desc";
    public $showInvoiceAmount;
    public $filterStatus = "All";
    public function update_list($payload)
    {
        $this->filterStatus = $payload['value'];
    }
    public function gotoPage($page)
    {
        $this->setPage($page);
    }

    public function displayInvoiceAmount()
    {
        $this->showInvoiceAmount = true;
    }

    public function hideInvoiceAmount()
    {
        $this->showInvoiceAmount = false;
    }

    public function activate($invoice_template_id)
    {
        $invoice_template = InvoiceTemplate::where('id', $invoice_template_id);
        $invoice_template->restore();
    }

    public function sort($field)
    {
        $fieldMap = [
            'category' => 'categories.name',
            'city' => 'cities.name',
            'created_at' => 'invoice_templates.created_at',
        ];

        $field = $fieldMap[$field] ?? $field;

        if ($this->sortField === $field) {
            $this->sortType = $this->sortType === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortType = 'asc';
        }
    }

    public function render()
    {
        $invoice_templates = InvoiceTemplate::select('invoice_templates.*', 'categories.name', 'cities.name', 'due_days.day')
            ->with([
                'category' => function ($q) {
                    $q->withTrashed();
                },
                'city',
                'due_day'
            ])
            ->join('categories', 'invoice_templates.category_id', '=', 'categories.id')
            ->join('cities', 'invoice_templates.city_id', '=', 'cities.id')
            ->join('due_days', 'invoice_templates.due_day_id', '=', 'due_days.id');

        if ($this->filterStatus == "Cancelled") {
            $invoice_templates = $invoice_templates->whereNotNull('invoice_templates.deleted_at');
        } else if ($this->filterStatus == "Active") {
            $invoice_templates = $invoice_templates->whereNull('invoice_templates.deleted_at');
        }

        $invoice_templates = $invoice_templates
            ->orderBy($this->sortField, $this->sortType)
            ->withTrashed()
            ->paginate(5);

        return view('livewire.invoice-template-list', ['user_invoices' => $invoice_templates]);
    }

    public function mount()
    {
        $this->showInvoiceAmount = Auth::user()->company->display_invoice_amount;
    }
}
