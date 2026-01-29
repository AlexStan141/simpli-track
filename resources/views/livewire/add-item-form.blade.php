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
        @if ($selected_region && $selected_currency)
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
        @else
            <p class="ml-[51px] text-red-500">You need both regions and currencies to add a country.</p>
        @endif
    @elseif($entity === 'city')
        @if ($selected_region && $selected_country)
            <div class="ml-[51px] mt-4">
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
        @else
            <p class="ml-[51px] text-red-500">You need countries to add a city.</p>
        @endif
    @endif
</div>
