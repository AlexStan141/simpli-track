<div>
    @if ($entity === 'region')
        <div class="ml-[51px]">
            <p>Region</p>
            <div class="flex gap-2 items-center">
                <input type="text" class="mt-4" wire:model="value_to_add"
                    wire:change="updateValueToAdd($event.target.value)">
                <button class="bg-loginblue text-white mt-4 p-2">Add</button>
            </div>
        </div>
    @elseif($entity === 'country')
        <div class="ml-[51px]">
            <p>Country</p>
            <div class="flex gap-2 items-center">
                <input type="text" class="mt-4" wire:model="value_to_add"
                    wire:change="updateValueToAdd($event.target.value)">
                @livewire('select-input', [
                    'entity' => 'currency',
                ])
            </div>
            <div class="flex gap-2 items-center">
                @livewire('select-input', [
                    'entity' => 'region',
                ])
                <button class="bg-loginblue text-white mt-4 p-2">Add</button>
            </div>
        </div>
    @elseif($entity === 'city')
        <div class="ml-[51px]">
            <p>City</p>
            <div class="flex gap-2">
                <input type="text" class="mt-4" wire:model="value_to_add"
                    wire:change="updateValueToAdd($event.target.value)">
                <button class="bg-loginblue text-white mt-4 p-2">Add</button>
            </div>
            <div class="flex gap-2 items-center">
                @livewire('select_input', [
                    'entity' => 'region',
                ])
                @livewire('select_input', [
                    'entity' => 'country',
                ])
            </div>
        </div>
    @endif
</div>
