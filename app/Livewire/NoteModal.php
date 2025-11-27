<?php

namespace App\Livewire;

use App\Models\Note;
use Livewire\Component;

class NoteModal extends Component
{
    protected $listeners = ['edit_note' => 'edit_note', 'display_note_modal' => 'display'];
    public $bill_id;
    public $bill_message;
    public $state;
    public $displayed;
    public function edit_note(){
        $this->state = 'PUT';
    }
    public function render()
    {
        return view('livewire.note-modal');
    }

    public function display($payload)
    {
        $this->bill_id = $payload['bill_id'];
        $note = Note::where('bill_id', $this->bill_id)->first();
        if($note){
            $this->bill_message = $note->message;
            $this->state = 'SHOW';
        }
        $this->displayed = true;
    }

    public function mount()
    {
        $this->displayed = false;
        $this->state = 'POST';
    }
}
