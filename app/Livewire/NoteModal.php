<?php

namespace App\Livewire;

use Livewire\Component;

class NoteModal extends Component
{
    protected $listeners = ['edit_note' => 'edit_note'];
    public $bill_id;
    public $bill_message;
    public $state;
    public function edit_note(){
        $this->state = 'PUT';
    }
    public function render()
    {
        return view('livewire.note-modal');
    }
}
