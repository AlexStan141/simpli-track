<div class="mt-4">
    @if (count($values) > 0)
        <select wire:model="selectedValue" wire:change="updateSelectedValue($event.target.value)"
            wire:key="select-{{ $entity }}-{{ implode('-', array_keys($values)) }}" class="border rounded p-2">
            @foreach ($values as $id => $value)
                <option value="{{ $id }}">{{ $value }}</option>
            @endforeach
        </select>
    @elseif($entity === 'region')
        <div></div>
    @elseif($entity === 'country')
        <div></div>
    @endif
</div>
