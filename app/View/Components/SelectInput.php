<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class SelectInput extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public Collection $values,
        public string $defaultValue,
        public string $id,
        public string $label,
        public string $roundness = '32px'
    ) {
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.select-input');
    }
}
