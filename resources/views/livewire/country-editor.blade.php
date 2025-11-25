<div>
    @if ($editMode)
        <div class="flex gap-2 w-[223px]">
            <input type="text" wire:model="new_country"
                class="grow bg-editprofileinput border border-formgray font-nunito" />
            <button wire:click="saveCountry"
                class="bg-loginblue px-10 py-2 text-white rounded-[20px]">Save</button>
        </div>
    @else
        <div class="flex items-center w-[223px]">
            <p class="font-nunito text-[22px] h-[30px] grow">{{ $old_country }}</p>
            <img src="{{ asset('/images/edit_icon.png') }}" alt="edit country" width="18.6" height="18.6"
                wire:click="editCountry" class="cursor-pointer">
            <img src="{{ asset('/images/delete_icon.png') }}" alt="delete country" width="16" height="18"
                wire:click="deleteCountry" class="ml-[53px] cursor-pointer">
        </div>
    @endif
</div>
