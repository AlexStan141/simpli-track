<div class="pt-10 flex flex-col items-start">
    <div class="flex gap-4">
        <div>
            @livewire('settings', [
                'entity' => 'region',
            ])
        </div>
        <div>
            @livewire('settings', [
                'entity' => 'country',
            ])
        </div>
    </div>
    <div class="flex gap-4 mt-20">
        @livewire('settings', [
            'entity' => 'city',
        ])
    </div>
</div>
