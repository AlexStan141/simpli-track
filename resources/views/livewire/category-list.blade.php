<div class="mt-[72px] ml-[97px] flex flex-col gap-[23px] mb-[107px] items-start">
    @foreach ($categories as $category)
        @if (!$category->deleted_at)
            @livewire(
                'editable-input',
                [
                    'old_value' => $category->name,
                    'role' => 'category_settings',
                    'editMode' => false,
                    'deleted' => false
                ],
                key($category->id)
            )
        @else
            @livewire(
                'editable-input',
                [
                    'old_value' => $category->name,
                    'role' => 'category_settings',
                    'editMode' => false,
                    'deleted' => true
                ],
                key($category->id)
            )
        @endif
    @endforeach
</div>
