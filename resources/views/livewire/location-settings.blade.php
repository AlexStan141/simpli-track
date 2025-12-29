<div class="pt-10 flex flex-col items-center">
    <div class="flex gap-4 items-center">
        <div>
            @livewire('add-region-form')
            @livewire('region-list')
        </div>
        <div>
            @livewire('add-country-form')
            @livewire('country-list')
        </div>
    </div>
    <div class="flex gap-4 items-center mt-20">
        @livewire('add-city-form')
        @livewire('city-list')
    </div>
</div>
