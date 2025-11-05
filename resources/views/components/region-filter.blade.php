@if ($selected)
    <div {{ $attributes->merge(['class' => 'rounded-[15px] border px-[30px] py-[9px] cursor-pointer bg-loginblue']) }}>
        <p class="text-[15px] h-5 text-white text-manrope">{{ $slot }}</p>
    </div>
@else
    <div {{ $attributes->merge(['class' => 'rounded-[15px] border px-[30px] py-[9px] cursor-pointer']) }}>
        <p class="text-[15px] h-5 text-buttontext text-manrope text-shadow-outline">{{ $slot }}</p>
    </div>
@endif
