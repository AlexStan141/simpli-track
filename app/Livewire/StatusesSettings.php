<?php

namespace App\Livewire;

use App\Models\Status;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class StatusesSettings extends Component
{
    public function render()
    {
        return view('livewire.statuses-settings');
    }
}
