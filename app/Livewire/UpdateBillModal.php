<?php

namespace App\Livewire;

use Livewire\Component;

class UpdateBillModal extends Component
{
    protected $listeners = ['display_modal' => 'display'];
    public $displayed;
    public $bill_id;
    public function render()
    {
        return view('livewire.update-bill-modal');
    }

    public function display($payload)
    {
        $this->bill_id = $payload['bill_id'];
        $this->displayed = true;
    }

    public function mount()
    {
        $this->displayed = false;
    }
}
