<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Company;
use App\Models\Currency;
use App\Models\Status;
use Livewire\Component;

class ListOfItems extends Component
{
    protected $listeners = [
        'add_value_to_list_event' => 'add_value',
        'close_other_values' => 'close_other_values',
        'list_item_delete_event' => 'delete_value',
        'list_item_restore_event' => 'restore_value'
    ];
    public $values;
    public $entity;

    public function add_value($payload)
    {
        if ($this->entity === 'category') {
            Category::create([
                'name' => $payload['value'],
                'company_id' => Company::first()->id
            ]);
            $this->values = Category::withTrashed()->get();
        } else if ($this->entity === 'currency'){
            Currency::create([
                'name' => $payload['value']
            ]);
            $this->values = Currency::withTrashed()->get();
        } else if ($this->entity === 'status'){
            Status::create([
                'name' => $payload['value'],
                'color' => $payload['color'],
                'company_id' => Company::first()->id
            ]);
            $this->values = Status::withTrashed()->get();
        }
    }

    public function delete_value($payload)
    {
        if($this->entity === 'category' && $payload['entity'] == 'category'){
            $category = Category::where('name', $payload['value'])->first();
            if($category){
                $category->delete();
            }
            $this->values = Category::withTrashed()->get();
        }
        else if($this->entity === 'currency' && $payload['entity'] === 'currency'){
            $currency = Currency::where('name', $payload['value'])->first();
            if($currency){
                $currency->delete();
            }
            $this->values = Currency::withTrashed()->get();
        }
        else if($this->entity === 'status' && $payload['entity'] === 'status'){
            $status = Status::where('name', $payload['value'])->first();
            if($status){
                $status->delete();
            }
            $this->values = Status::withTrashed()->get();
        }
    }

    public function restore_value($payload)
    {
        if($this->entity === 'category' && $payload['entity'] === 'category'){
            $category = Category::withTrashed()->where('name', $payload['value'])->first();
            if($category){
                $category->restore();
            }
            $this->values = Category::withTrashed()->get();
        }
        else if($this->entity === 'currency' && $payload['entity'] === 'currency'){
            $currency = Currency::withTrashed()->where('name', $payload['value'])->first();
            if($currency){
                $currency->restore();
            }
            $this->values = Currency::withTrashed()->get();
        }
        else if($this->entity === 'status' && $payload['entity'] === 'status'){
            $status = Status::withTrashed()->where('name', $payload['value'])->first();
            if($status){
                $status->restore();
            }
            $this->values = Status::withTrashed()->get();
        }
    }

    public function close_other_values($payload)
    {
        foreach ($this->values as $current_value) {
            if ($current_value->name !== $payload['value']) {
                if ($this->entity === 'category') {
                    $this->dispatch('close_editable_input', [
                        'old_value' => $current_value->name,
                        'role' => 'category_settings'
                    ]);
                }
                else if ($this->entity === 'status') {
                    $this->dispatch('close_editable_input_for_status', [
                        'old_value' => $current_value->name,
                    ]);
                }
            }
        }
    }

    public function mount()
    {
        if($this->entity === 'category'){
            $this->values = Category::withTrashed()->get();
        } else if ($this->entity === 'currency'){
            $this->values = Currency::withTrashed()->get();
        } else if ($this->entity === 'status'){
            $this->values = Status::withTrashed()->get();
        }
    }

    public function render()
    {
        return view('livewire.list-of-items');
    }
}
