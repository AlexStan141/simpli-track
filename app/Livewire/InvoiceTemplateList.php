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

    protected $listeners = ['displayInvoiceAmount' => 'displayInvoiceAmount', 'hideInvoiceAmount' => 'hideInvoiceAmount'];
    public $sortField = 'invoice_templates.created_at';
    public $sortType = "asc";

    public $showInvoiceAmount;

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
        $adminRoleId = Role::where('name', 'Admin')->first()->id;
        if (Auth::user()->role->id === $adminRoleId) {
            $invoice_templates = InvoiceTemplate::select('invoice_templates.*', 'categories.name', 'cities.name', 'due_days.day')
                ->with(['category', 'city', 'user', 'due_day'])
                ->join('categories', 'invoice_templates.category_id', '=', 'categories.id')
                ->join('cities', 'invoice_templates.city_id', '=', 'cities.id')
                ->join('users', 'invoice_templates.user_id', '=', 'users.id')
                ->join('due_days', 'invoice_templates.due_day_id', '=', 'due_days.id')
                ->orderBy($this->sortField, $this->sortType)
                ->paginate(5);
        } else {
            $invoice_templates = InvoiceTemplate::select('invoice_templates.*', 'categories.name', 'cities.name', 'due_days.day')
                ->with(['category', 'city', 'user', 'due_day'])
                ->join('categories', 'invoice_templates.category_id', '=', 'categories.id')
                ->join('cities', 'invoice_templates.city_id', '=', 'cities.id')
                ->join('users', 'invoice_templates.user_id', '=', 'users.id')
                ->join('due_days', 'invoice_templates.due_day_id', '=', 'due_days.id')
                ->where('users.id', '=', Auth::id())
                ->orderBy($this->sortField, $this->sortType)
                ->paginate(5);
        }


        return view('livewire.invoice-template-list', ['user_invoices' => $invoice_templates]);
    }

    public function mount()
    {
        $this->showInvoiceAmount = Auth::user()->company->display_invoice_amount;
    }
}
