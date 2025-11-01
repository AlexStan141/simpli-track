<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MenuLink extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public int $width,
        public int $height,
        public int $viewBoxX,
        public int $viewBoxY,
        public bool $active,
        public string $text,
        public string $link
    )
    {

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.menu-link');
    }
}
