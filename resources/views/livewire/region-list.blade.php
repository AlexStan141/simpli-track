<div class="mt-[72px] ml-[97px] flex flex-col gap-[23px]">
    @foreach ($regions as $region)
        @livewire(
            'editable-input',
            [
                'old_value' => $region->name,
                'role' => 'region_settings',
            ],
            key($region->id)
        )
    @endforeach
</div>
