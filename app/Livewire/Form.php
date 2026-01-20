<?php

namespace App\Livewire;

use App\Models\Currency;
use Livewire\Component;

class Form extends Component
{
    protected $listeners = [
        'currency_delete_event' => 'update_currency_select',
        'currency_restore_event' => 'update_currency_select'
    ];
    public $values;
    public $entity;
    public $value_to_add;
    public $color_to_add;
    public function render()
    {
        return view('livewire.form');
    }
    public function remove_value()
    {
        $this->values = array_filter($this->values, function ($current_value) {
            return $current_value !== $this->value_to_add;
        });
        $this->dispatch('add_value_to_list_event', [
            'value' => $this->value_to_add
        ]);
        $first_value_key = array_keys($this->values)[0];
        $this->value_to_add = $this->values[$first_value_key];
    }

    public function update_value_to_add($value)
    {
        if ($this->entity == 'currency') {
            $this->value_to_add = config('constants.CURRENCIES')[$value];
        }
    }

    public function add_value()
    {
        if ($this->entity === 'status') {
            $this->dispatch('add_value_to_list_event', [
                'value' => $this->value_to_add,
                'color' => $this->color_to_add
            ]);
        } else {
            $this->dispatch('add_value_to_list_event', [
                'value' => $this->value_to_add
            ]);
        }
    }
    public function update_currency_select()
    {
        $all_currencies = config('constants.CURRENCIES');
        $currency_names = Currency::withTrashed()->pluck('name')->toArray();
        $this->values = array_diff($all_currencies, $currency_names);
    }

    public function mount()
    {
        if ($this->entity === 'currency') {
            $all_currencies = config('constants.CURRENCIES');
            $currency_names = Currency::withTrashed()->pluck('name')->toArray();
            $this->values = array_diff($all_currencies, $currency_names);
            $first_value_key = array_keys($this->values)[0];
            $this->value_to_add = $this->values[$first_value_key];
        }
        else if ($this->entity === 'status') {
            $this->color_to_add = sprintf('#%06X', 0);
        }
    }
}
