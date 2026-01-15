<?php

namespace App\Livewire;

use App\Models\Currency;
use Livewire\Component;

class AddCurrencyForm extends Component
{
    protected $listeners = ['delete_from_add_currency_form' => 'delete_from_add_currency_form'];
    public $currencies;
    public $selected_currency;

    public function add_currency(){
        $currency = $this->currencies[$this->selected_currency];
        $this->dispatch("editable_input_add_event", [
            'role' => 'currency',
            'value' => $currency
        ]);
    }

    public function delete_from_add_currency_form($payload){
        $this->currencies = array_filter($this->currencies, function($currency) use($payload){
            return $currency !== $payload['name'];
        });
        $this->selected_currency = array_keys($this->currencies)[0];
    }

    public function render()
    {
        return view('livewire.add-currency-form');
    }

    public function mount()
    {
        $all_currencies = [
        'AUD', 'BGN', 'BRL',
        'CAD', 'CHF', 'CNY',
        'CZK', 'DKK', 'EUR',
        'GBP', 'HKD', 'HRK',
        'HUF', 'IDR', 'ILS',
        'INR', 'ISK', 'JPY',
        'KRW', 'MXN', 'MYR',
        'NOK', 'NZD', 'PHP',
        'PLN', 'RON', 'RUB',
        'SEK', 'SGD', 'THB',
        'TRY', 'USD', 'ZAR'
        ];
        $currency_names = Currency::withTrashed()->pluck('name')->toArray();
        $this->currencies = array_diff($all_currencies, $currency_names);
        $this->selected_currency = array_keys($this->currencies)[0];
    }
}
