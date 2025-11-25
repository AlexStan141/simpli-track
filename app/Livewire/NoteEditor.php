<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;

class NoteEditor extends Component
{
    protected $listeners = ["displayNote" => "displayNote"];
    public $displayed;
    public $note_id;
    public function render()
    {
        return view('livewire.note-editor');
    }
    public function displayNote($payload)
    {
        $this->displayed = true;
        $this->note_id = $payload['note_id'];
    }

    public function mount()
    {
        $this->displayed = false;
        $this->note_id = null;
    }
}
