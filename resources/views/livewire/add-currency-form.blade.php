<form class="ml-9 flex gap-2" method="POST" wire:submit="add_currency">
    <x-select-input class="w-[200px] rounded-[32px]" id="currency" label="" :values="$currencies"
        wire:model="selected_currency"></x-select-input>
    <button class="mt-[25px] px-[93px] py-[12px] mb-[19px] bg-loginblue rounded-[80px]">
        <p class="font-nunito text-white text-[18px] h-[25px]">Save</p>
    </button>
</form>
