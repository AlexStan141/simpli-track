<div class="mt-11 flex justify-between">
    <div class="flex gap-[3px] ml-[25px] items-start">
        @foreach ($regions as $region)
            <x-region-filter>{{ $region }}</x-region-filter>
        @endforeach
    </div>
    <div></div>
</div>
