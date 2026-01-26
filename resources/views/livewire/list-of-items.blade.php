<div class="ml-[51px]">
    @if ($entity === 'category')
        <div>
            @foreach ($values as $value)
                <livewire:editable-input :old_value="$value->name" :new_value="$value->name" role="category_settings" :edit_mode="false"
                    :editable="true" :deletable="true" :deleted="isset($value->deleted_at)"
                    wire:key="category-{{ $value->id }}-{{ $value->deleted_at ?? 'active' }}" />
            @endforeach
        </div>
    @elseif($entity === 'currency')
        <div class="grid grid-cols-3">
            @foreach ($values as $value)
                <livewire:editable-input :old_value="$value->name" :new_value="$value->name" role="currency_settings" :edit_mode="false"
                    :editable="false" :deletable="true" :deleted="isset($value->deleted_at)"
                    wire:key="currency-{{ $value->id }}-{{ $value->deleted_at ?? 'active' }}" />
            @endforeach
        </div>
    @elseif($entity === 'status')
        <div>
            @foreach ($values as $value)
                <livewire:editable-input-for-status :old_value="$value->name" :new_value="$value->name" :old_color_value="$value->color"
                    :new_color_value="$value->color" :edit_mode="false" :deleted="isset($value->deleted_at)"
                    wire:key="status-{{ $value->id }}-{{ $value->deleted_at ?? 'active' }}" />
            @endforeach
        </div>
    @elseif($entity === 'region')
        @foreach ($values as $value)
            <livewire:editable-input :old_value="$value->name" :new_value="$value->name" role="region_settings" :edit_mode="false"
                :editable="true" :deletable="true" :deleted="isset($value->deleted_at)"
                wire:key="region-{{ $value->id }}-{{ $value->deleted_at ?? 'active' }}" />
        @endforeach
    @elseif($entity === 'country')
        @foreach ($values as $value)
            <livewire:editable-input :old_value="$value->name" :new_value="$value->name" role="country_settings" :edit_mode="false"
                :editable="true" :deletable="true" :deleted="isset($value->deleted_at)"
                wire:key="country-{{ $value->id }}-{{ $value->deleted_at ?? 'active' }}" />
        @endforeach
    @elseif($entity === 'city')
        @if ($region_id && $country_id)
            <div class="flex gap-2">
                @livewire('select-input', [
                    'entity' => 'region',
                ])
                @livewire('select-input', [
                    'entity' => 'country',
                ])
            </div>
            <div class="grid grid-cols-2 gap-x-[38px] gap-y-[18px] mt-[25px]">
                @foreach ($values as $value)
                    <livewire:editable-input :old_value="$value->name" :new_value="$value->name" role="city_settings"
                        :edit_mode="false" :editable="true" :deletable="true" :deleted="isset($value->deleted_at)"
                        wire:key="city-{{ $value->id }}-{{ $value->deleted_at ?? 'active' }}" />
                @endforeach
            </div>
        @endif
    @endif
</div>
