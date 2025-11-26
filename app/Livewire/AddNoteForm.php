<?php

namespace App\Livewire;

use Livewire\Component;

class AddNoteForm extends Component
{
    public $bill_id;
    public function render()
    {
        return view('livewire.add-note-form');
    }
}
