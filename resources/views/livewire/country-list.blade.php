<div class="ml-[46px] mt-2">
    <x-select-input width="96px" class="rounded-[5px]" id="region_id" label="Region" :values="$regions"
    wire:model="selected_region_id" wire:change="triggerRegionFilterUpdate" defaultValue="{{ $selected_region_id }}"></x-select-input>
    @foreach ($countries as $country)
        @livewire(
            'editable-input',
            [
                'old_value' => $country->name,
                'role' => 'country_settings',
            ],
            key($country->id)
        )
    @endforeach
</div>
