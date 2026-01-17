<div class="ml-[51px] mb-4">
    @if ($entity === 'category')
        <x-input-label for="category" :value="__('Category Name')" class="leading-[14px] h-[12px] !text-editprofilelabel" />
        <div class="flex gap-[19px] mt-2 items-center">
            <x-text-input id="category" class="setting-text-input w-[450px]" type="text" name="category"
                wire:model="value_to_add" wire:change="update_value_to_add($event.target.value)" required />
            <button wire:click="add_value({{ $value_to_add }})" class="py-3 px-[93px] bg-loginblue text-white rounded-[80px]">Save</button>
        </div>
    @endif
</div>
