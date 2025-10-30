<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PageLink extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public ?string $pageLink = null,
        public ?string $imgPlace = null,
        public ?string $labelType = null,
        public ?bool $currentPage = null,
    )
    {

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.page-link');
    }
}
