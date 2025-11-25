<div>
    <x-input-label for="region" :value="__('Region')" class="leading-[14px] h-[12px] !text-editprofilelabel" />
    <x-text-input id="region" class="setting-text-input w-[590px]" type="text" name="region"
        wire:model="regionToAdd" required />
    <button wire:click="addRegion">Save</button>
</div>
