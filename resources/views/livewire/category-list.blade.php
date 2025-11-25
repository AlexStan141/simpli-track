<div class="mt-[72px] ml-[97px] flex flex-col gap-[23px] mb-[107px] items-start">
    @foreach ($categories as $category)
        @livewire(
            'editable-input',
            [
                'old_value' => $category->name,
                'role' => 'category_settings',
            ],
            key($category->id)
        )
    @endforeach
</div>
