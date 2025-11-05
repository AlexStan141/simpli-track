<?php

namespace App\Livewire;

use Livewire\Component;

class AnotherTest extends Component
{
    protected $listeners = ['something' => 'handleSomething'];

    public function handleSomething()
    {
        // Poți pune aici orice logică vrei
        logger('Evenimentul a fost primit!');
    }

    public function render()
    {
        return view('livewire.another-test');
    }
}

