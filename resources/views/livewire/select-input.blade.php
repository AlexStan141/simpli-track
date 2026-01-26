<div class="mt-4">
    <select wire:model="selectedValue"
            wire:change="updateSelectedValue($event.target.value)"
            wire:key="select-{{ $entity }}-{{ implode('-', array_keys($values)) }}"
            class="border rounded p-2">
        <option value="" disabled>Select an option</option>
        @foreach($values as $id => $value)
            <option value="{{ $id }}">{{ $value }}</option>
        @endforeach
    </select>
</div>
