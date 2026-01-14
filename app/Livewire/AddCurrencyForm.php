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
        $nr_existing_currencies = Currency::where('name', $currency)->count();
        if($nr_existing_currencies > 0){
            dd("Existing currency");
        }

        Currency::create([
            'name' => $currency
        ]);
        $this->dispatch('currency_list_updated');
    }

    public function delete_from_add_currency_form($payload){
        $this->currencies = array_filter($this->currencies, function($currency) use($payload){
            return $currency !== $payload['name'];
        });
    }

    public function render()
    {
        return view('livewire.add-currency-form');
    }

    public function mount()
    {
        $this->selected_currency = array_keys($this->currencies)[0];
    }
}
