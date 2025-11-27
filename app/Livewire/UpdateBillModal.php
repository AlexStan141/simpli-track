<?php

namespace App\Livewire;

use App\Models\Bill;
use App\Models\Status;
use Livewire\Component;

class UpdateBillModal extends Component
{
    protected $listeners = ['display_modal' => 'display'];
    public $displayed;
    public $bill_id;
    public $statuses;
    public $default_status;
    public $current_status;
    public function render()
    {
        return view('livewire.update-bill-modal');
    }

    public function display($payload)
    {
        $this->bill_id = $payload['bill_id'];
        $this->displayed = true;
        $this->statuses = Status::all()->pluck('name', 'id');
        $this->default_status = Bill::where('id', $this->bill_id)->first()->status->name;
        $this->current_status = $this->default_status;
    }

    public function update_bill_status()
    {
        $this->dispatch('bill_status_updated', [
            'status' => $this->current_status,
            'bill_id' => $this->bill_id
        ]);
        $this->displayed = false;
    }

    public function delete_bill()
    {
        $this->dispatch('bill_deleted', [
            'bill_id' => $this->bill_id
        ]);
        $this->displayed = false;
    }

    public function mount()
    {
        $this->displayed = false;
    }
}
