<div class="mt-[72px] ml-[97px] flex flex-col gap-[23px] mb-[107px] items-start">
    @foreach ($categories as $category)
        @if ($category == $category_to_edit)
            @livewire(
                'editable-input',
                [
                    'old_value' => $category->name,
                    'role' => 'category_settings',
                    'editMode' => true
                ],
                key($category->id)
            )
        @else
            @livewire(
                'editable-input',
                [
                    'old_value' => $category->name,
                    'role' => 'category_settings',
                    'editMode' => false
                ],
                key($category->id)
            )
        @endif
    @endforeach
</div>
