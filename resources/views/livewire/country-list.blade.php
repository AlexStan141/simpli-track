<div class="flex flex-col items-start">
    @if ($regions->count() > 0)
        <x-select-input class="w-[200px] rounded-[32px]" id="region_id" label="" :values="$regions->pluck('name', 'id')"
            wire:model="selected_region_id" wire:change="update_parent_selected_region($event.target.value)"
            defaultValue="{{ $selected_region_id }}"></x-select-input>
        <div class="grid grid-cols-2 gap-x-[38px] gap-y-[18px] mt-[25px]">
            @foreach ($countries as $country)
                @livewire(
                    'editable-input',
                    [
                        'old_value' => $country->name,
                        'role' => 'country_settings',
                        'editMode' => false,
                        'deleted' => $country->deleted_at ? true : false
                    ],
                    key($country->id)
                )
            @endforeach
        </div>
    @else
        <div class="text-red-500">Regions needed for country operations!</div>
    @endif
</div>
