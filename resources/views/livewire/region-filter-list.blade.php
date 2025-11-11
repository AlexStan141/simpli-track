<div>
    @foreach ($allRegions as $region)
        @livewire('region-filter', [
            'selected' => in_array($region, $selectedRegions),
            'value' => $region
        ])
    @endforeach
</div>
