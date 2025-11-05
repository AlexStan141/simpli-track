<?php

namespace App\Livewire;

use App\Models\InvoiceTemplate;
use App\Models\Region;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class InvoiceTemplateListDashboard extends Component
{
    public array $selectedRegions = [];
    protected $listeners = ['toggleRegion' => 'handleToggle'];
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
        $invoice_templates = InvoiceTemplate::select('invoice_templates.*', 'landlords.name')
            ->join('landlords', 'invoice_templates.landlord_id', '=', 'landlords.id')
            ->join('statuses', 'invoice_templates.status_id', '=', 'statuses.id')
            ->join('due_days', 'invoice_templates.due_day_id', '=', 'due_days.id')
            ->join('users', 'invoice_templates.user_id', '=', 'users.id')
            ->where('invoice_templates.user_id', '=', Auth::id())
            ->whereHas('region', function ($query) {
                $query->whereIn('name', $this->selectedRegions);
            })
            ->paginate(5);
        return view('livewire.invoice-template-list-dashboard', [
            'user_invoices' => $invoice_templates,
        ]);
    }
    public function render()
    {
        $invoice_templates = InvoiceTemplate::select('invoice_templates.*', 'landlords.name')
            ->join('landlords', 'invoice_templates.landlord_id', '=', 'landlords.id')
            ->join('statuses', 'invoice_templates.status_id', '=', 'statuses.id')
            ->join('due_days', 'invoice_templates.due_day_id', '=', 'due_days.id')
            ->join('users', 'invoice_templates.user_id', '=', 'users.id')
            ->where('invoice_templates.user_id', '=', Auth::id())
            ->whereHas('region', function ($query) {
                $query->whereIn('name', $this->selectedRegions);
            })
            ->paginate(5);
        return view('livewire.invoice-template-list-dashboard', [
            'user_invoices' => $invoice_templates,
        ]);
    }

    public function mount()
    {
        $this->selectedRegions = Region::pluck('name')->toArray();
    }
}
