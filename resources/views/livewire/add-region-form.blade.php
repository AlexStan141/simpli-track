<div>
    <x-input-label for="name" :value="__('Category Name')" class="leading-[14px] h-[12px] !text-editprofilelabel" />
    <x-text-input id="name" class="setting-text-input w-[590px]" type="text" name="name"
        wire:model="categoryToAdd" required /> {{-- If your happiness depends on money, you will never be happy with yourself. --}}
</div>
