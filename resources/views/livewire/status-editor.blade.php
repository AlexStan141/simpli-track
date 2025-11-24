<div>
    @if ($editMode)
        <div class="flex gap-2 w-[400px]">
            <input type="color" id="color" name="color" wire:model="new_status_color">
            <input type="text" wire:model="new_status"
                class="grow bg-editprofileinput border border-formgray font-nunito" />
            <button wire:click="saveStatus"
                class="bg-loginblue px-10 py-2 text-white rounded-[20px]">Save</button>
        </div>
    @else
        <div class="flex items-center w-[400px]">
            <p class="font-nunito text-[22px] h-[30px] grow">{{ $old_status }}</p>
            <img src="{{ asset('/images/edit_icon.png') }}" alt="edit status" width="18.6" height="18.6"
                wire:click="editStatus" class="cursor-pointer">
            <img src="{{ asset('/images/delete_icon.png') }}" alt="delete status" width="16" height="18"
                wire:click="deleteStatus" class="ml-[53px] cursor-pointer">
        </div>
    @endif
</div>
