<div>
    <div class="flex gap-2">
        <x-select-input class="w-[200px] rounded-[32px]" id="region_id" label="" :values="$regions"
            wire:model="selected_region_id" wire:change="trigger_region_update"
            defaultValue="{{ $selected_region_id }}"></x-select-input>
        <x-select-input class="w-[200px] rounded-[32px]" id="country_id" label="" :values="$countries"
            wire:model="selected_country_id" wire:change="trigger_country_update"
            defaultValue="{{ $selected_country_id }}"></x-select-input>
    </div>
    <div class="grid grid-cols-2 gap-x-[38px] gap-y-[18px] mt-[25px]">
        @foreach ($cities as $city)
            @livewire(
                'editable-input',
                [
                    'old_value' => $city->name,
                    'role' => 'city_settings',
                ],
                key($city->id)
            )
        @endforeach
    </div>
</div>
