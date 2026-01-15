<form class="ml-[51px]" wire:submit.prevent="add_currency">
    <x-input-label for="currency" :value="__('Currency')" class="leading-[14px] h-[12px] !text-editprofilelabel" />
    <x-select-input class="w-[200px] rounded-[32px]" id="currency" label="" :values="$currencies"
        wire:model="selected_currency"></x-select-input>
    <button class="mt-[25px] px-[93px] py-[12px] mb-[19px] bg-loginblue rounded-[80px]">
        <p class="font-nunito text-white text-[18px] h-[25px]">Save</p>
    </button>
</form>
