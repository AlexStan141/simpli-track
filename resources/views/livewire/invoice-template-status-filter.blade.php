<select name="status" id="status" class="border border-inputbordercolor rounded-[20px]" wire:change="update_selected_value" wire:model="selected_value">
    @foreach($values as $value)
        @if($value == $selected_value)
            <option value="{{ $value }}" selected>{{ $value }}</option>
        @else
            <option value="{{ $value }}">{{ $value }}</option>
        @endif
    @endforeach
</select>
