<div>
    @if ($displayed)
        <div class="w-full h-full fixed bg-black/50 z-10 flex justify-center items-center">
            <div class="w-[50%] h-[50%] bg-white z-20 relative flex flex-col gap-2 justify-center items-center">
                <a href="{{ route('dashboard') }}">
                    <img src="{{ asset('/images/close.png') }}" class="absolute right-2 top-2" alt="close bill" />
                </a>
                <p class="mt-3 ml-2 font-bold">Choose Status</p>
                <div class="mt-2">
                    <x-input-label for="status_id" value="" class="text-white leading-[1rem]" />
                    <div class="flex gap-2 justify-center items-center">
                        <x-select-input id="status_id" label="" :values="$statuses" wire:model="current_status"
                            defaultValue="{{ $default_status }}" class="w-[300px]"></x-select-input>
                        <button class="py-3 px-[20px] bg-loginblue text-white rounded-[80px] mt-5 ml-2"
                            wire:click.prevent="update_bill_status">Apply</button>
                    </div>
                    <x-input-error :messages="$errors->get('status_id')" class="mt-2" />
                </div>
                <div class="flex gap-2 items-center mt-2">
                    <hr class="border-gray-500 w-[100px]">
                    <span>OR</span>
                    <hr class="border-gray-500 w-[100px]">
                </div>
                <button class="py-3 px-[93px] bg-red-500 text-white rounded-[80px] mt-5 ml-2" type="submit"
                    wire:click.prevent = 'delete_bill'>Delete</button>
            </div>
        </div>
    @endif
</div>
