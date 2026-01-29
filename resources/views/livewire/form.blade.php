<div class="ml-[51px] mb-4">
    @if ($entity == 'country')
        @livewire('select-input', [
            'entity' => 'region',
        ])
    @elseif($entity == 'city')
        <div class="flex gap-2">
            @livewire('select-input', [
                'entity' => 'region',
            ])
            @livewire('select-input', [
                'entity' => 'country',
            ])
        </div>
    @endif
</div>
