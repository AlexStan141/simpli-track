<div>
    <div class="h-[25px]"></div>
    @if ($countries->count() > 0)
        <div class="flex gap-2">
            <x-select-input class="w-[200px] rounded-[32px]" id="region_id" label="" :values="$regions->pluck('name', 'id')"
                wire:model="selected_region_id" wire:change="change_region"
                defaultValue="{{ $selected_region_id }}"></x-select-input>
            <x-select-input class="w-[200px] rounded-[32px]" id="country_id" label="" :values="$countries->pluck('name', 'id')"
                wire:model="selected_country_id" wire:change="change_country" defaultValue="{{ $selected_country_id }}"
            ></x-select-input>
        </div>
        <div class="grid grid-cols-2 gap-x-[38px] gap-y-[18px] mt-[25px]">
            @if ($cities->count() > 0)
                @foreach ($cities as $city)
                    @livewire(
                        'editable-input',
                        [
                            'old_value' => $city->name,
                            'role' => 'city_settings',
                            'editMode' => false,
                            'deleted' => $city->deleted_at ? true : false
                        ],
                        key($city->id)
                    )
                @endforeach
            @else
                <div class="text-red-500">No cities for this country!</div>
            @endif
        </div>
    @else
        <div class="text-red-500">Countries needed for city operations!</div>
    @endif
</div>
