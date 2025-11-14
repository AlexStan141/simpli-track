<?php

namespace App\Livewire;

use App\Models\DueDay;
use App\Models\InvoiceForAttention;
use Livewire\Component;

class PrioritySettings extends Component
{
    public $dueDays;
    public $defaultDueDate;
    public $invoicesForAttention;
    public $defaultInvoicesForAttention;
    public function updatedDefaultDueDate()
    {
        $this->dispatch('updateDefaultDueDate', [
            'defaultDueDate' => $this->defaultDueDate
        ]);
    }
    public function updatedDefaultInvoicesForAttention()
    {
        $this->dispatch('updateDefaulInvoicesForAttention', [
            'defaultInvoicesForAttention' => $this->defaultInvoicesForAttention
        ]);
    }
    public function render()
    {
        return view('livewire.priority-settings');
    }

    public function mount()
    {
        $this->dueDays = DueDay::pluck('day', 'id');
        $this->defaultDueDate = $this->dueDays->keys()->first();
        $this->invoicesForAttention = InvoiceForAttention::pluck('period', 'id');
        $this->defaultInvoicesForAttention = $this->dueDays->keys()->first();
    }
}
