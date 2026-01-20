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
        <button wire:click="remove_value"
            class="mt-[25px] px-[93px] py-[12px] mb-[19px] text-white bg-loginblue rounded-[80px]">Save</button>
    @elseif($entity === 'status')
        <x-input-label for="status" :value="__('Status Name')" class="leading-[14px] h-[12px] !text-editprofilelabel" />
        <div class="flex gap-[19px] items-center mt-2">
            <x-text-input id="status" class="setting-text-input w-[450px]" type="text" name="status"
                wire:model="value_to_add" required />
            <input type="color" name="color" wire:model="color_to_add" class="w-[30px] h-[30px]">
            <button wire:click="add_value" class="py-3 px-[93px] bg-loginblue text-white rounded-[80px]">Save</button>
        </div>
    @elseif($entity === 'region')
        <x-input-label for="region" :value="__('Region')" class="leading-[14px] h-[12px] !text-editprofilelabel" />
        <x-text-input id="region" class="setting-text-input w-[450px] mt-2" type="text" name="region"
            wire:model="value_to_add" required />
        <button wire:click="add_value"
            class="py-3 px-[93px] bg-loginblue text-white mt-[18px] rounded-[80px]">Save</button>
    @endif
</div>
