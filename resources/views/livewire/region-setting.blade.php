<button wire:click.prevent="toggleBeforeSave"
    class="border py-[9px] px-[30px] rounded-[15px]
        {{ !$selectedBeforeSave ? 'border-inputbordercolor text-buttontext' : 'bg-loginblue text-white' }}">
    <p>{{ $value }}</p>
</button>
