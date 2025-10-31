@props(['id', 'label' => '', 'type' => 'text', 'width' => '100%'])

@php
    $containerClass = "w-[{$width}] flex flex-col justify-end gap-[16px]";
@endphp


<div class="{{ $containerClass }}">
    <label for="{{ $id }}" class="leading-[14px] h-[12px] font-inter text-editprofilelabel">{{ $label }}</label>
    <input id="{{ $id }}" name="{{ $id }}" type="{{ $type }}"
        {{ $attributes->merge(['class' => 'w-full border-inputbordercolor border mt-4 pl-2 py-4 text-[14px] leading-[14px] h-[44px]']) }}>
</div>

