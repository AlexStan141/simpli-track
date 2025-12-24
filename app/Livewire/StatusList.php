<?php

namespace App\Livewire;

use App\Models\Status;
use Livewire\Component;

class StatusList extends Component
{
    protected $listeners = ['status_list_updated' => 'render', 'close_other_statuses' => 'close_other_statuses'];
    public $statuses;
    public function render()
    {
        return view('livewire.status-list');
    }

    public function close_other_statuses($payload){
        foreach($this->statuses as $status){
            if($status->name !== $payload['value']){
                $this->dispatch('close_editable_input_for_status', [
                    'old_value' => $status->name,
                ]);
            }
        }
    }

    public function mount()
    {
        $this->statuses = Status::withTrashed()->get();
    }
}
