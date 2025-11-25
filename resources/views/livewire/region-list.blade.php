<div>
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
