<div>
    <h3 class="ml-[67px] mt-[49px] font-inter text-[20px] h-[15px]">Regions & Locations</h3>
    @if(session()->has('error'))
        <p class="mt-4 ml-4 p-2 bg-red-300">{{ session('error') }}</p>
    @endif
    <div class="flex mt-[89px]">
        <div>
            @livewire('add-region-form')
            @livewire('region-list')
        </div>
        <div class="bg-setting w-[1px] h-[443px] ml-[110px] mb-[151px]"></div>
        <div class="ml-[43px]">
            @livewire('add-country-form')
            @livewire('country-list')
        </div>
    </div>
</div>
