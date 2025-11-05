<?php

namespace App\Livewire;

use Livewire\Component;

class Test extends Component
{
    public function something()
    {
        $this->dispatch('something')->to('another-test');
    }

    public function render()
    {
        return view('livewire.test');
    }
}


