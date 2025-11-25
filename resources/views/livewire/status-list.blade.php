<div class="mt-[72px] ml-[97px] flex flex-col gap-[23px] mb-[107px] items-start">
    @foreach ($statuses as $status)
        @livewire(
            'editable-input-for-status',
            [
                'old_value' => $status->name,
                'old_color_value' => $status->color,
                'role' => 'status_settings',
            ],
            key($status->id)
        )
    @endforeach
</div>
