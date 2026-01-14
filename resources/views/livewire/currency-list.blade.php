<div class="mt-[60px] ml-[50px] grid grid-cols-3 gap-4">
    @foreach ($currencies as $currency)
        @livewire(
            'editable-input',
            [
                'old_value' => $currency->name,
                'role' => 'currency_settings',
                'editMode' => false,
                'deleted' => $currency->deleted_at ? true : false,
                'editable' => false
            ],
            key($currency->id)
        )
    @endforeach
</div>
