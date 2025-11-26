<?php

namespace App\Livewire;

use Livewire\Component;

class NoteDisplay extends Component
{
    public $bill_id;
    public $bill_message;
    public function edit_note(){
        $this->dispatch('edit_note');
    }
    public function render()
    {
        return view('livewire.note-display');
    }
}
