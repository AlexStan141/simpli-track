<div>
    <x-input-label for="country" :value="__('Country')" class="leading-[14px] h-[12px] !text-editprofilelabel" />
    <x-text-input id="country" class="setting-text-input w-[590px]" type="text" name="country" wire:model="countryToAdd"
        required />
    <x-select-input width="96px" class="rounded-[5px]" id="region" label="" :values="$regions"
        wire:model="selected_region_id" defaultValue="{{ $selected_region_id }}"></x-select-input>
    <button wire:click="addCountry">Save</button>
</div>
