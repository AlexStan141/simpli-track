<div>
    @if (!$deleted)
        @if (!$edit_mode)
            <div class="flex items-center w-[200px]">
                <p class="font-nunito text-[22px] h-[30px] grow">{{ $old_value }}</p>
                <img src="{{ asset('/images/edit_icon.png') }}" alt="edit" width="18.6" height="18.6"
                    wire:click="edit" class="cursor-pointer">
                <img src="{{ asset('/images/delete_icon.png') }}" alt="delete" width="16" height="18"
                    wire:click="deleteInput" class="ml-[53px] cursor-pointer">
            </div>
        @else
            <div class="flex flex-col">
                <div class="flex gap-2 items-center">
                    <input type="text" value="{{ $old_value }}" wire:model="new_value" name="country" class="simpli-track-input">
                    <input type="color" value="{{ $old_color_value }}" name="color" wire:model="new_color_value" class="w-[30px] h-[30px]">
                </div>
                <button class="bg-loginblue px-10 py-2 text-white rounded-[20px] mt-2" wire:click="save">Save</button>
            </div>
        @endif
    @endif
</div>
