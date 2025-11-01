<?php

namespace App\Livewire;

use App\Models\InvoiceTemplate;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class InvoiceTemplateList extends Component
{
    protected $listeners = ['invoiceTemplateCreated' => 'render'];
    public function render()
    {
        $invoice_templates = InvoiceTemplate::where('user_id', Auth::user()->id)->latest()->paginate(5);
        return view('livewire.invoice-template-list', ['user_invoices' => $invoice_templates]);
    }
}
