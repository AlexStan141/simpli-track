<button
    wire:click.prevent="toggle"
    class="border py-[9px] px-[30px] rounded-[15px]
        {{ !$selected ? 'border-inputbordercolor text-buttontext' : 'bg-loginblue text-white' }}">
    {{ $value }}
</button>

