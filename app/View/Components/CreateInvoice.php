<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CreateInvoice extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public $amount,
        public $currencies,
        public $currency_id,
        public $categories,
        public $category_id,
    )
    {
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.create-invoice');
    }
}
