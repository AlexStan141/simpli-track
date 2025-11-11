<?php

namespace App\View\Components;

use App\Models\Company;
use App\Models\Region;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CompanySettings extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public $regions,
        public $deletedRegions,
        public $companyName,
        public $companyAddress
    )
    {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {

        return view('components.company-settings');
    }
}
