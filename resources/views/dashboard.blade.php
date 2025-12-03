<div>
    @livewire('update-bill-modal')
    @livewire('note-modal')
    <x-app-layout>
        <x-vertical-menu active-link="/dashboard"></x-vertical-menu>
        <div class="flex flex-col mt-[44px] ml-[25px] w-full">
            <div class="flex justify-between mb-[42px]">
                <div class="flex">
                    @livewire('region-filter-list')
                </div>
                <div class="flex mr-8">
                    @livewire('filter', ['type' => 'Status', 'values' => $status_names, 'selected_value' => $status_names[1]])
                    @livewire('filter', ['type' => 'Location', 'values' => $city_names, 'selected_value' => $city_names[1]])
                    @livewire('filter', ['type' => 'Category', 'values' => $category_names, 'selected_value' => $category_names[1]])
                </div>
            </div>
            @livewire('bill-list')
        </div>
    </x-app-layout>
</div>
