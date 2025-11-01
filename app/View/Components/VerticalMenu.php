<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\View\View;

class VerticalMenu extends Component
{
    public function __construct(
        public string $activeLink
    ){
        //
    }
    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.vertical-menu');
    }
}
