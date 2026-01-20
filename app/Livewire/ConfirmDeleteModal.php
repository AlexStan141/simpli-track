<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\City;
use App\Models\Country;
use App\Models\Currency;
use App\Models\InvoiceTemplate;
use App\Models\Region;
use App\Models\Status as StatusEntity; // App/Livewire/Status also exists, conflict without alias
use Livewire\Component;

class ConfirmDeleteModal extends Component
{
    protected $listeners = ['confirm-delete-modal-display' => 'display'];
    public $entity;
    public $entity_id;
    public $displayed;
    public $action;
    public $opt_message = "";  //For the consequences of delete actions depending on the entity

    public function cancel_modal()
    {
        //Occurs when you cancel the deletion

        $this->displayed = false;
    }

    public function delete_record()
    {
        //Occurs when you confirm the deletion

        if($this->entity == 'invoice template')
        {
            //Cancel an invoice template
            //confirm-delete-modal-display is called in deleteInvoiceTemplate function of EditInvoice

            $record = InvoiceTemplate::find($this->entity_id);
            $record->delete();
            return redirect()->to(route('invoice.index'));
        }
        else if ($this->entity == 'category')
        {
            //Delete a category from settings
            //confirm-delete-modal-display is called in deleteInput function of EditableInput

            $record = Category::find($this->entity_id);
            $record->delete();
            return redirect()->to(route('settings.categories'));
        }
        else if ($this->entity == "status")
        {
            //Delete a status from settings
            //confirm-delete-modal-display is called in deleteInput function of EditableInput

            $record = StatusEntity::find($this->entity_id);
            $record->delete();
            return redirect()->to(route('settings.statuses'));
        }
        else if ($this->entity == "region")
        {
            //Delete a region from settings
            //confirm-delete-modal-display is called in deleteInput function of EditableInput
            $record = Region::find($this->entity_id);
            $record->delete();
            $this->dispatch('update_parent_region_list', [
                'region_id' => $this->entity_id,
                'event' => 'delete'
            ]);
            return redirect()->to(route('settings.locations'));
        }
        else if ($this->entity == "country")
        {
            //Delete a country from settings
            //confirm-delete-modal-display is called in deleteInput function of EditableInput

            $record = Country::find($this->entity_id);
            $record->delete();
            return redirect()->to(route('settings.locations'));
        }
        else if ($this->entity == "city")
        {
            //Delete a city from settings
            //confirm-delete-modal-display is called in deleteInput function of EditableInput

            $record = City::find($this->entity_id);
            $record->delete();
            return redirect()->to(route('settings.locations'));
        }
        else if ($this->entity == "currency")
        {
            //Delete a currency from settings
            //confirm-delete-modal-display is called in deleteInput function of EditableInput

            $currency_name = Currency::find($this->entity_id)->name;
            $this->dispatch('list_item_delete_event', [
                'value' => $currency_name,
                'entity' => 'currency'
            ]);
        }
        $this->displayed = false;
    }

    public function display($payload){

        //Occurs when you press the delete icon on an EditableInput
        //Occurs when you press the delete icon on an EditableInputForStatus
        //Occurs when you edit an invoice template and click the cancel button

        $this->entity = $payload['entity'];
        $this->entity_id = $payload['entity_id'];
        $this->displayed = true;
        $this->action = $payload['action'];

        if($this->entity == 'region'){
            $this->opt_message = "Deleting this region will also delete all countries and cities associated with it.";
        }
        else if($this->entity == 'country'){
            $this->opt_message = "Deleting this country will also delete all cities associated with it.";
        }
        else{
            $this->opt_message = "";
        }

        //entity, entity_id and action are used to generate the modal message in view
        //and they are also used to delete the record in case of delete confirmation.

    }
    public function render()
    {
        return view('livewire.confirm-delete-modal');
    }
}
