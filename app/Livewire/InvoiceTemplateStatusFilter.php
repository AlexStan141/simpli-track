<?php

namespace App\Livewire;

use Livewire\Component;

class InvoiceTemplateStatusFilter extends Component
{
    public $values = ['All', 'Active', 'Cancelled'];
    public $selected_value;
    public function update_selected_value()
    {
        $this->dispatch('invoice-template-status-filter-value-updated', [
            'value' => $this->selected_value
        ]);
    }
    public function render()
    {
        return view('livewire.invoice-template-status-filter');
    }
}
