<div class="mt-[60px] ml-[50px] flex flex-col">
    @foreach ($regions as $region)
        @livewire(
            'editable-input',
            [
                'old_value' => $region->name,
                'role' => 'region_settings',
                'editMode' => false,
                'deleted' => $region->deleted_at ? true : false
            ],
            key($region->id)
        )
    @endforeach
</div>
