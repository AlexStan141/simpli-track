<?php

namespace App\Livewire;

use App\Models\Status;
use Livewire\Component;

class StatusEditor extends Component
{
    public $old_status;
    public $status_id;
    public $editMode = false;
    public $new_status;
    public $old_status_color;
    public $new_status_color;
    public function mount($old_status, $status_id, $old_status_color)
    {
        $this->old_status = $old_status;
        $this->new_status = $old_status;
        $this->old_status_color = $old_status_color;
        $this->new_status_color = $old_status_color;
        $this->status_id = $status_id;
    }

    public function editStatus()
    {
        $this->editMode = true;
    }

    public function saveStatus()
    {
        $status = Status::find($this->status_id);
        $status->name = $this->new_status;
        $status->color = $this->new_status_color;
        $status->save();

        $this->old_status = $this->new_status;
        $this->old_status_color = $this->new_status_color;
        $this->editMode = false;
    }

    public function deleteStatus()
    {
        $status = Status::find($this->status_id);
        $status->company_id = null;
        $status->save();
        $this->dispatch('statusDeleted');
    }

    public function render()
    {
        return view('livewire.status-editor');
    }
}
