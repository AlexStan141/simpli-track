<?php

namespace App\Livewire;

use App\Models\Status;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class StatusesSettings extends Component
{
    protected $listeners = ['statusDeleted' => 'loadStatuses'];
    public $statuses;
    public $status_to_add;
    public $status_to_add_color;
    public function render()
    {
        return view('livewire.statuses-settings');
    }

    public function addStatus()
    {
        $user = Auth::user();
        $company = $user->company;

        Status::create([
            'name' => $this->status_to_add,
            'color' => $this->status_to_add_color,
            'company_id' => $company->id
        ]);

        $this->status_to_add = '';
        $this->loadStatuses();
    }

    public function loadStatuses()
    {
        $user = Auth::user();
        $company = $user->company;

        $this->statuses = Status::where('company_id', $company->id)->get();
    }

    public function mount()
    {
        $this->loadStatuses();
    }
}
