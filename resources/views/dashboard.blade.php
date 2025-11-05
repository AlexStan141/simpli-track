<x-app-layout>
    <x-vertical-menu active-link="/dashboard"></x-vertical-menu>
    <div class="flex flex-col mt-[44px] ml-[25px]">
        <div class="flex justify-between mb-[42px]">
            <div class="flex">
                @foreach ($region_names as $region)
                    @livewire('region-filter', ['selected' => true, 'value' => $region])
                @endforeach
            </div>
            <div class="flex"></div>
        </div>
            @livewire('invoice-template-list-dashboard')
    </div>
</x-app-layout>
