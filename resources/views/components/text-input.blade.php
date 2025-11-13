@props([
    'type' => 'text',
    'name' => '',
    'id' => '',
    'disabled' => false,
    'value' => '',
    'wireModel' => null,
])

<input
    type="{{ $type }}"
    name="{{ $name }}"
    id="{{ $id }}"
    value="{{ old($name, $value) }}"
    @disabled($disabled)
    @if($wireModel) wire:model="{{ $wireModel }}" @endif
    {{ $attributes->merge(['class' => 'focus:border-indigo-500 focus:ring-indigo-500 text-input']) }}
>


