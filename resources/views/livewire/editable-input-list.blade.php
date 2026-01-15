<div class="ml-[51px]">
    @if ($nr_columns == 1)
        <div>
            @foreach ($values as $value)
                <livewire:editable_input :old_value="$value->name" :new_value="$value->name" :role="$role" :edit_mode="false"
                    :editable="$role !== 'currency_settings'" :deletable="true" :deleted="isset($value->deleted_at)" wire:key="currency-{{ $value->id }}" />
            @endforeach
        </div>
    @else
        <div class="{{ 'grid grid-cols-' . $nr_columns }}">
            @foreach ($values as $value)
                <livewire:editable_input :old_value="$value->name" :new_value="$value->name" :role="$role" :edit_mode="false"
                    :editable="$role !== 'currency_settings'" :deletable="true" :deleted="isset($value->deleted_at)" wire:key="currency-{{ $value->id }}" />
            @endforeach
        </div>
    @endif
</div>
