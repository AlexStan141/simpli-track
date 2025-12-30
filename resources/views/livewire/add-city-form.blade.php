<div>
    <div class="h-[25px]"></div>
    @if ($countries->count() > 0)
        <div>
            <x-input-label for="city" :value="__('City')" class="leading-[14px] h-[12px] !text-editprofilelabel" />
            <x-text-input id="city" class="setting-text-input w-[450px] mt-2" type="text" name="city"
                wire:model="cityToAdd" required />
        </div>
        <div class="flex gap-7 items-center">
            <x-select-input class="w-[200px] rounded-[32px]" id="region" label="" :values="$regions->pluck('name', 'id')"
                wire:model="selected_region_id" defaultValue="{{ $selected_region_id }}"
                wire:change="update_countries"></x-select-input>
            <x-select-input class="w-[200px] rounded-[32px]" id="country" label="" :values="$countries->pluck('name', 'id')"
                wire:model="selected_country_id" defaultValue="{{ $selected_country_id }}"></x-select-input>
        </div>
        <button wire:click="addCity"
            class="py-3 px-[93px] bg-loginblue text-white mt-[18px] rounded-[80px]">Save</button>
    @else
        <div class="text-red-500">Countries needed for city operations!</div>
    @endif
</div>
