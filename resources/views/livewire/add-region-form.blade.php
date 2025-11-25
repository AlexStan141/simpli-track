<div class="ml-[52px]">
    <x-input-label for="region" :value="__('Region')" class="leading-[14px] h-[12px] !text-editprofilelabel" />
    <x-text-input id="region" class="setting-text-input w-[450px] mt-2" type="text" name="region"
        wire:model="regionToAdd" required />
    <button wire:click="addRegion" class="py-3 px-[93px] bg-loginblue text-white mt-[18px] rounded-[80px]">Save</button>
</div>
