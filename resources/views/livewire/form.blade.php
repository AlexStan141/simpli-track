<div class="ml-[51px] mb-4">
    @if ($entity == 'country')
        @livewire('select-input', [
            'entity' => 'region',
        ])
    @elseif($entity == 'city')
        @livewire('select-input', [
            'entity' => 'region',
        ])
        @livewire('select-input', [
            'entity' => 'country',
        ])
    @endif
</div>
