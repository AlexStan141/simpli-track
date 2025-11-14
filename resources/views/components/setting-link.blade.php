<div>
    @if ($active)
        <li class="flex justify-center w-[200px] pt-[11px] pb-[15px] font-nunito text-selectedsetting font-bold">
            <a href="{{ $link }}" class="inline-block">{{$slot}}</a>
        </li>
    @else
        <li class="flex justify-center w-[200px] border border-setting bg-bgsetting pt-[11px] pb-[15px] font-nunito">
            <a href="{{ $link }}" class="inline-block">{{$slot}}</a>
        </li>
    @endif
</div>
