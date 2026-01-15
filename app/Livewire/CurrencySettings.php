<?php

namespace App\Livewire;

use App\Models\Currency;
use Livewire\Component;

class CurrencySettings extends Component
{
    public $all_currencies;
    public $currencies;
    public $rest_of_currencies;
    public $selected_currency;
    public function render()
    {
        return view('livewire.currency-settings');
    }

    public function mount(){
        $this->all_currencies = [
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
        $this->currencies = Currency::withTrashed()->get();
        $this->rest_of_currencies = array_diff($this->all_currencies, $currency_names);
    }
}
