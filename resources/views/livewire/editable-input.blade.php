<div>
    @if (!$deleted)
        @if (!$edit_mode)
            <div class="flex items-center w-[300px]">
                <p class="font-nunito text-[22px] h-[30px] grow">{{ $old_value }}</p>
                <img src="{{ asset('/images/edit_icon.png') }}" alt="edit" width="18.6" height="18.6"
                    wire:click="edit" class="cursor-pointer">
                <img src="{{ asset('/images/delete_icon.png') }}" alt="delete" width="16" height="18"
                    wire:click="deleteInput" class="ml-[53px] cursor-pointer">
            </div>
        @else
            <div class="flex flex-col">
                <input type="text" value="{{ $old_value }}" wire:model="new_value" name="simpli-track-input"
                    class="simpli-track-input">
                <button class="bg-loginblue px-10 py-2 text-white rounded-[20px] mt-2" wire:click="save">Save</button>
            </div>
        @endif
    @else
        <div class="flex gap-4 items-center">
            <p class="font-nunito text-[22px] h-[30px] grow">{{ $old_value }}</p>
            <button class="text-loginblue" wire:click="restore">Restore</button>
        </div>
    @endif
</div>
