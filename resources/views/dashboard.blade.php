<x-app-layout>
    <x-vertical-menu active-link="/dashboard"></x-vertical-menu>
    <div class="flex flex-col mt-[44px] ml-[25px] w-full">
        <div class="flex justify-between mb-[42px]">
            <div class="flex">
                @foreach ($region_names as $region)
                    @livewire('region-filter', ['selected' => true, 'value' => $region])
                @endforeach
            </div>
            <div class="flex">
                @livewire('filter', ['type' => 'status', 'values' => $status_names, 'selected_value' => $status_names[1]])
                @livewire('filter', ['type' => 'country', 'values' => $all_country_names, 'selected_value' => $all_country_names[1]])
                @livewire('filter', ['type' => 'category', 'values' => $category_names, 'selected_value' => $category_names[1]])
            </div>
        </div>
            @livewire('invoice-template-list-dashboard')
    </div>
</x-app-layout>
