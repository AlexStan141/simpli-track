<div class="mt-[72px] ml-[97px] flex flex-col gap-[23px] mb-[107px] items-start">
    @foreach ($statuses as $status)
        @if(!$status->deleted_at)
            @livewire('editable-input-for-status', [
                'old_value' => $status->name,
                'old_color_value' => $status->color,
                'editMode' => false,
                'deleted' => false
            ], key($status->id))
        @else
            @livewire('editable-input-for-status', [
                'old_value' => $status->name,
                'old_color_value' => $status->color,
                'editMode' => false,
                'deleted' => true
            ], key($status->id))
        @endif
    @endforeach
</div>
