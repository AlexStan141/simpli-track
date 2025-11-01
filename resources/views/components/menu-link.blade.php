
@if ($active)
    <div class="w-[120px] h-[80px] flex justify-center items-center bg-white rounded-l-[40px]">
        <div class="w-[120px] h-[48px] border-r-[4px] border-r-loginblue">
            <a href="{{ $link }}" class="flex flex-col items-center gap-[5px] ">
                <svg xmlns="http://www.w3.org/2000/svg" width="{{ $width }}" height="{{ $height }}" viewBox="0 0 {{ $viewBoxX }} {{ $viewBoxY }}" fill="none">
                    {{ $slot }}
                </svg>
                <span class="text-[14px] leading-[19px] text-loginblue">{{ $text }}</span>
            </a>
        </div>
    </div>
@else
    <div class="w-[120px] h-[80px] flex justify-center items-center bg-loginblue rounded-l-[40px] translate-x-[-1px]">
        <div class="w-[120px] h-[48px]">
            <a href="{{ $link }}" class="flex flex-col items-center gap-[5px] ">
                <svg xmlns="http://www.w3.org/2000/svg" width="{{ $width }}" height="{{ $height }}" viewBox="0 0 {{ $viewBoxX }} {{ $viewBoxY }}" fill="none">
                    {{ $slot }}
                </svg>
                <span class="text-[14px] leading-[19px] text-white">{{ $text }}</span>
            </a>
        </div>
    </div>
@endif
