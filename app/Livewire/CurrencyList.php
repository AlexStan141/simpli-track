<?php

namespace App\Livewire;

use App\Models\Currency;
use Livewire\Component;

class CurrencyList extends Component
{
    protected $listeners = [
        'close_other_currencies' => 'close_other_currencies'
    ];
    public $currencies;
    public function render()
    {
        return view('livewire.currency-list');
    }

    public function close_other_currencies($payload)
    {
        foreach ($this->currencies as $currency) {
            if ($currency->name !== $payload['value']) {
                $this->dispatch('close_editable_input', [
                    'old_value' => $currency->name,
                    'role' => 'currency_settings'
                ]);
            }
        }
    }
}
