<div class="ml-[51px] mb-4">
    @if ($entity === 'category')
        <x-input-label for="category" :value="__('Category Name')" class="leading-[14px] h-[12px] !text-editprofilelabel" />
        <div class="flex gap-[19px] mt-2 items-center">
            <x-text-input id="category" class="setting-text-input w-[450px]" type="text" name="category"
                wire:model="value_to_add" wire:change="update_value_to_add($event.target.value)" required />
            <button wire:click="add_value" class="py-3 px-[93px] bg-loginblue text-white rounded-[80px]">Save</button>
        </div>
    @elseif($entity === 'currency')
        <x-input-label for="currency" :value="__('Currency Name')" class="leading-[14px] h-[12px] !text-editprofilelabel" />
        <x-select-input class="w-[200px] rounded-[32px]" id="currency" label="" :values="$values"
            wire:model="value_to_add" wire:change="update_value_to_add($event.target.value)"></x-select-input>
        <button wire:click="add_value"
            class="mt-[25px] px-[93px] py-[12px] mb-[19px] text-white bg-loginblue rounded-[80px]">Save</button>
    @elseif($entity === 'status')
        <x-input-label for="status" :value="__('Status Name')" class="leading-[14px] h-[12px] !text-editprofilelabel" />
        <div class="flex gap-[19px] items-center mt-2">
            <x-text-input id="status" class="setting-text-input w-[450px]" type="text" name="status"
                wire:model="value_to_add" wire:change="update_value_to_add($event.target.value)" required />
            <input type="color" name="color" wire:model="color_to_add"
                wire:change="update_color_to_add($event.target.value)" class="w-[30px] h-[30px]">
            <button wire:click="add_value" class="py-3 px-[93px] bg-loginblue text-white rounded-[80px]">Save</button>
        </div>
    @elseif($entity === 'region')
        <x-input-label for="region" :value="__('Region')" class="leading-[14px] h-[12px] !text-editprofilelabel" />
        <x-text-input id="region" class="setting-text-input w-[450px] mt-2" type="text" name="region"
            wire:model="value_to_add" wire:change="update_value_to_add($event.target.value)" required />
        <button wire:click="add_value"
            class="py-3 px-[93px] bg-loginblue text-white mt-[18px] rounded-[80px]">Save</button>
    @elseif($entity === 'country')
        @if ($regions->count() > 0 && $currencies->count() > 0)
            <x-input-label for="country" :value="__('Country')" class="leading-[14px] h-[12px] !text-editprofilelabel" />
            <div class="flex gap-2">
                <x-text-input id="country" class="setting-text-input w-[450px]" type="text" name="country"
                    wire:model="value_to_add" wire:change="update_value_to_add($event.target.value)" required />
                <x-select-input :values="$currencies->pluck('name', 'id')" width="200px" id="selected_currency_id" label=""
                    defaultValue="{{ $currency_id }}" wire:change="update_currency($event.target.value)"
                    :withoutMargin="true">
                </x-select-input>
            </div>
            <div class="flex gap-7 items-center">
                @livewire('select-input', [
                    'entity' => 'region',
                ])
                <button wire:click="add_value"
                    class="py-3 px-[93px] bg-loginblue text-white mt-[18px] rounded-[80px]">Save</button>
            </div>
        @else
            <div class="text-red-500">You need both regions and currencies to add a country!</div>
        @endif
    @elseif($entity === 'city')
        @if ($countries->count() > 0)
            <div>
                <x-input-label for="city" :value="__('City')"
                    class="leading-[14px] h-[12px] !text-editprofilelabel" />
                <x-text-input id="city" class="setting-text-input w-[450px] mt-2" type="text" name="city"
                    wire:model="value_to_add" wire:change="update_value_to_add($event.target.value)" required />
            </div>
            <div class="flex gap-7 items-center">
                @livewire('select-input', [
                    'entity' => 'region',
                ])
                @livewire('select-input', [
                    'entity' => 'country',
                ])
            </div>
            <button wire:click="add_value"
                class="py-3 px-[93px] bg-loginblue text-white mt-[18px] rounded-[80px]">Save</button>
        @else
            <div class="text-red-500">Countries needed for city operations!</div>
        @endif
    @endif
</div>
