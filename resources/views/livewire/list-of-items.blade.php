@php
    $region_display_condition = $entity === 'region';
    $country_display_condition = $entity === 'country' && $selected_region && $selected_currency;
    $city_display_condition = $entity === 'city' && $selected_region && $selected_country;
    $display_condition = $region_display_condition || $country_display_condition || $city_display_condition;
@endphp



<div>
    @if (!$display_condition)
        <div></div>
    @else
        <div class="mt-4">
            @if ($entity === 'city')
                @if ($city_display_condition)
                    <div class="flex gap-2">
                        @livewire('select-input', [
                            'entity' => 'region',
                        ])
                        @livewire('select-input', [
                            'entity' => 'country',
                        ])
                    </div>
                @endif
            @endif
            @foreach ($values as $value)
                <div class="flex gap-2">
                    <li>{{ $value->name }}</li>
                    @if (!$value->deleted_at)
                        <button wire:click="deleteItem({{ $value->id }})" class="text-red-500">Delete</button>
                    @else
                        <button wire:click="restoreItem({{ $value->id }})" class="text-green-500">Restore</button>
                    @endif
                </div>
            @endforeach
        </div>
    @endif
</div>
