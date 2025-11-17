<div class="flex flex-col justify-end gap-[16px]">
    @if($type === 'hidden')
        <label for="{{ $id }}" class="leading-[14px] h-[12px] font-inter text-editprofilelabel hidden">{{ $label }}</label>
    @else
        <label for="{{ $id }}" class="leading-[14px] h-[12px] font-inter text-editprofilelabel">{{ $label }}</label>
    @endif
    <input id="{{ $id }}" name="{{ $id }}" type="{{ $type }}"
        {{ $attributes->class([
            "border-inputbordercolor border pl-2 py-4 text-[14px] leading-[14px] h-[44px]"
        ]) }} style="width: {{ $width }};">
</div>
