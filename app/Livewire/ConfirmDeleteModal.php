<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\InvoiceTemplate;
use Livewire\Component;

class ConfirmDeleteModal extends Component
{
    protected $listeners = ['confirm-delete-modal-display' => 'display'];
    public $entity;
    public $entity_id;
    public $displayed;
    public $action;

    public function cancel_modal()
    {
        $this->displayed = false;
    }

    public function delete_record()
    {
        if($this->entity == 'invoice template')
        {
            $record = InvoiceTemplate::find($this->entity_id);
            $record->delete();
            return redirect()->to(route('invoice.index'));
        }
        else if ($this->entity == 'category')
        {
            $record = Category::find($this->entity_id);
            $record->delete();
            return redirect()->to(route('settings.categories'));
        }
        $this->displayed = false;
    }

    public function display($payload){
        $this->entity = $payload['entity'];
        $this->entity_id = $payload['entity_id'];
        $this->displayed = true;
        $this->action = $payload['action'];
    }
    public function render()
    {
        return view('livewire.confirm-delete-modal');
    }
}
