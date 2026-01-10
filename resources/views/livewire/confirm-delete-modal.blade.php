<div>
    @if ($displayed)
        <div class="w-full h-full fixed bg-black/50 z-20 flex justify-center items-center">
            <div class="w-[30%] h-[30%] bg-white z-20 relative flex flex-col gap-2 justify-center items-center">
                <p class="font-bold">Are you sure you want to {{ $action }} this {{ $entity }}</p>
                <p class="p-5">{{ $opt_message }}</p>
                <div class="flex gap-2">
                    <button class="py-3 px-[73px] bg-blue-500 text-white rounded-[80px] mt-5 ml-2"
                        wire:click.prevent='cancel_modal'>No</button>
                    <button class="py-3 px-[73px] bg-red-500 text-white rounded-[80px] mt-5 ml-2"
                        wire:click.prevent = 'delete_record'>Yes</button>
                </div>
            </div>
        </div>
    @endif
</div>
