<?php

namespace App\Livewire;

use App\Models\Country;
use Livewire\Component;

class EditableInput extends Component
{
    public $old_value;
    public $role;
    public $new_value;
    public $edit_mode = false;
    public $deleted;

    public function mount($old_value)
    {
        $this->old_value = $old_value;
        $this->new_value = $old_value;
        $this->deleted = false;
    }

    public function edit()
    {
        $this->edit_mode = true;
    }

    public function save()
    {
        if($this->role == 'country_settings'){
            $country = Country::where('name', $this->old_value)->first();
            $country->name = $this->new_value;
            $country->save();
        }
        $this->old_value = $this->new_value;
        $this->edit_mode = false;
    }

    public function deleteInput()
    {
        $this->deleted = true;
        $country = Country::where('name', $this->old_value)->first();
        $country->delete();
    }

    public function render()
    {
        return view('livewire.editable-input');
    }
}
