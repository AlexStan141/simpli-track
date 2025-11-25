<?php

namespace App\Livewire;

use App\Models\Company;
use App\Models\Status;
use Livewire\Component;

class AddStatusForm extends Component
{
    public $statusToAdd;
    public $statusColorToAdd;
    public function addStatus()
    {
        Status::create([
            'name' => $this->statusToAdd,
            'company_id' => Company::all()->first()->id,
            'color' => $this->statusColorToAdd,
        ]);
        $this->statusToAdd = '';
        $this->dispatch('status_list_updated');
    }
    public function render()
    {
        return view('livewire.add-status-form');
    }
}
