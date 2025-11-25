<div class="ml-[52px]">
    <x-input-label for="category" :value="__('Category Name')" class="leading-[14px] h-[12px] !text-editprofilelabel" />
    <div class="flex gap-[19px] mt-2 items-center">
        <x-text-input id="category" class="setting-text-input w-[450px]" type="text" name="category"
            wire:model="categoryToAdd" required />
        <button wire:click="addCategory"
            class="py-3 px-[93px] bg-loginblue text-white rounded-[80px]">Save</button>
    </div>
</div>

