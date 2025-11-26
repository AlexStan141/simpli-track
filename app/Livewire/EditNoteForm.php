<?php

namespace App\Livewire;

use App\Models\Note;
use Livewire\Component;

class EditNoteForm extends Component
{
    public $bill_id;
    public $bill_message;
    public function render()
    {
        return view('livewire.edit-note-form');
    }
}
