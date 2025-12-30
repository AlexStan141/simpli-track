<div>
    <x-input-label for="country" :value="__('Country')" class="leading-[14px] h-[12px] !text-editprofilelabel" />
    <div class="flex gap-2">
        <x-text-input id="country" class="setting-text-input w-[450px]" type="text" name="country"
            wire:model="countryToAdd" required />
        <x-select-input :values="$currencies" width="200px" id="selected_currency_id" label=""
            wire:model="selected_currency_id" defaultValue="{{ $selected_currency_id }}" :withoutMargin="true"></x-select-input>
    </div>
    <div class="flex gap-7 items-center">
        <x-select-input class="w-[200px] rounded-[32px]" id="region" label="" :values="$regions->pluck('name', 'id')"
            wire:model="selected_region_id" defaultValue="{{ $selected_region_id }}"></x-select-input>
        <button wire:click="addCountry"
            class="py-3 px-[93px] bg-loginblue text-white mt-[18px] rounded-[80px]">Save</button>
    </div>
</div>
