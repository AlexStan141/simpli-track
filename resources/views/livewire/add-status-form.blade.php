<div class="ml-[52px]">
    <x-input-label for="status" :value="__('Status Name')" class="leading-[14px] h-[12px] !text-editprofilelabel" />
    <div class="flex gap-[19px] items-center mt-2">
        <x-text-input id="status" class="setting-text-input w-[450px]" type="text" name="status"
            wire:model="statusToAdd" required />
        <input type="color" name="color" wire:model="statusColorToAdd" class="w-[30px] h-[30px]">
        <button wire:click="addStatus"
            class="py-3 px-[93px] bg-loginblue text-white rounded-[80px]">Save</button>
    </div>
</div>
