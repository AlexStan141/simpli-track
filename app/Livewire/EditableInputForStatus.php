<?php

namespace App\Livewire;

use App\Models\Status;
use Livewire\Component;

class EditableInputForStatus extends Component
{
    protected $listeners = ['close_editable_input_for_status' => 'close_editable_input_for_status'];
    public $old_value;
    public $new_value;
    public $old_color_value;
    public $new_color_value;
    public $edit_mode = false;
    public $deleted;
    public function mount($old_value, $old_color_value)
    {
        $this->old_value = $old_value;
        $this->new_value = $old_value;
        $this->old_color_value = $old_color_value;
        $this->new_color_value = $old_color_value;
    }
    public function edit()
    {
        $this->edit_mode = true;
        $this->dispatch('close_other_statuses', [
            'value' => $this->old_value
        ]);
    }
    public function save()
    {
        $status = Status::where('name', $this->old_value)
            ->where('color', $this->old_color_value)->first();
        $status->name = $this->new_value;
        $status->color = $this->new_color_value;
        $status->save();
        $this->dispatch('status_list_updated');
        $this->old_value = $this->new_value;
        $this->old_color_value = $this->new_color_value;
        $this->edit_mode = false;
    }
    public function deleteInput()
    {
        $this->deleted = true;
        $status = Status::where('name', $this->old_value)
            ->where('color', $this->old_color_value)->first();
        $status->delete();
        $this->dispatch('status_list_updated');
    }

    public function close_editable_input_for_status($payload)
    {
        if ($payload['old_value'] == $this->old_value) {
            $this->edit_mode = false;
        }
    }

    public function restore(){
        $status = Status::withTrashed()->where('name', $this->old_value)->first();
        $status->restore();
        $this->deleted = false;
    }

    public function render()
    {
        return view('livewire.editable-input-for-status');
    }
}
