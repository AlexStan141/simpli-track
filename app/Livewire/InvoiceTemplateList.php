<?php

namespace App\Livewire;

use App\Models\InvoiceTemplate;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class InvoiceTemplateList extends Component
{

    public $sortField = 'invoice_templates.created_at';
    public $sortType = "asc";

    public function sort($field)
    {
        $fieldMap = [
            'category' => 'categories.name',
            'landlord' => 'landlords.name',
            'status' => 'statuses.name',
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
        $invoice_templates = InvoiceTemplate::select('invoice_templates.*', 'categories.name', 'landlords.name', 'due_days.day')
            ->with(['category', 'landlord', 'status', 'user', 'due_day'])
            ->join('categories', 'invoice_templates.category_id', '=', 'categories.id')
            ->join('landlords', 'invoice_templates.landlord_id', '=', 'landlords.id')
            ->join('statuses', 'invoice_templates.status_id', '=', 'statuses.id')
            ->join('users', 'invoice_templates.user_id', '=', 'users.id')
            ->join('due_days', 'invoice_templates.due_day_id', '=', 'due_days.id')
            ->where('users.id', '=', Auth::id())
            ->orderBy($this->sortField, $this->sortType)
            ->paginate(5);
        return view('livewire.invoice-template-list', ['user_invoices' => $invoice_templates]);
    }
}
