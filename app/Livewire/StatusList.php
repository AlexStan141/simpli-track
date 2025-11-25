<?php

namespace App\Livewire;

use App\Models\Status;
use Livewire\Component;

class StatusList extends Component
{
    protected $listeners = ['status_list_updated' => 'render'];
    public $statuses;
    public function render()
    {
        $this->statuses = Status::all();
        return view('livewire.status-list');
    }

    public function mount()
    {
        $this->statuses = Status::all();
    }
}
