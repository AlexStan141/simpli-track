<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Component;

class Settings extends Component
{
    public $entity;
    public function render()
    {
        return view('livewire.settings');
    }
}
