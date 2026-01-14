<div>
    <h3 class="ml-[51px] mt-[49px] font-inter text-[20px] h-[15px] mb-[83px]">Currencies</h3>
    @livewire('add-currency-form', [
        'currencies' => $rest_of_currencies
    ])
    @livewire('currency-list', [
        'currencies' => $currencies
    ])
</div>
