<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\City;
use App\Models\Country;
use App\Models\Currency;
use App\Models\Region;
use App\Models\Status;
use Livewire\Component;

class EditableInput extends Component
{
    
    public function render()
    {
        return view('livewire.editable-input');
    }
}
