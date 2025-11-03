<div class="flex flex-col justify-end gap-[16px]">
    <label for="{{ $id }}" class="leading-[14px] h-[12px] font-inter text-editprofilelabel">{{ $label }}</label>
    <input id="{{ $id }}" name="{{ $id }}" type="{{ $type }}"
        {{ $attributes->class([
            "border-inputbordercolor border mt-4 pl-2 py-4 text-[14px] leading-[14px] h-[44px]"
        ]) }} style="width: {{ $width }};">
</div>
