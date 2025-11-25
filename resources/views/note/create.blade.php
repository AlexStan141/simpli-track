<livewire:bill-list>
    <x-slot name="modal">
        <div class="w-[90%] h-full absolute bg-black/50 flex justify-center items-center">
            <div class="w-[50%] h-[50%] bg-white z-10 relative">
                <img src="{{ asset('/images/close.png') }}" class="absolute right-2 top-2" alt="close note"></i>
                <form action="" method="POST" class="flex flex-col gap-2 mt-5 ml-2 items-start">
                    @method('PUT')
                    <label for="message">Add a note here</label>
                    <textarea name="message" id="message" class="w-[75%] h-[100px] mt-2"></textarea>
                    <button class="py-3 px-[93px] bg-loginblue text-white rounded-[80px]" type="submit">Save</button>
                </form>
            </div>
        </div>
    </x-slot>
</livewire:bill-list>
