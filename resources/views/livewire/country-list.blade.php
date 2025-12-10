<div class="mt-[69px]">
    @if ($regions->count() > 0)
        <x-select-input class="w-[200px] rounded-[32px]" id="region_id" label="" :values="$regions"
            wire:model="selected_region_id" wire:change="trigger_region_update"
            defaultValue="{{ $selected_region_id }}"></x-select-input>
        <div class="grid grid-cols-2 gap-x-[38px] gap-y-[18px] mt-[25px]">
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
    @else
        <div class="text-red-500">No regions with countries found!</div>
    @endif
</div>
