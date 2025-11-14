<?php

namespace App\Livewire;

use App\Models\DueDay;
use App\Models\InvoiceForAttention;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PrioritySettings extends Component
{
    public $dueDays;
    public $defaultDueDate;
    public $invoicesForAttention;
    public $defaultInvoicesForAttention;
    public function updateDefaultDueDate()
    {
        $company = Auth::user()->company;
        $company->due_day_id = $this->defaultDueDate;
        $company->save();
    }
    public function updateDefaultInvoicesForAttention()
    {
        $company = Auth::user()->company;
        $company->invoice_for_attention_id = $this->defaultInvoicesForAttention;
        $company->save();
    }
    public function render()
    {
        return view('livewire.priority-settings');
    }

    public function mount()
    {
        $company = Auth::user()->company;
        $this->dueDays = DueDay::pluck('day', 'id');
        $this->defaultDueDate = $company->due_day_id;
        $this->invoicesForAttention = InvoiceForAttention::pluck('period', 'id');
        $this->defaultInvoicesForAttention = $company->invoice_for_attention_id;
    }
}
