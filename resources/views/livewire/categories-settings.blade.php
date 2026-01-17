<div>
    {{-- <h3 class="ml-[51px] mt-[49px] font-inter text-[20px] h-[15px] mb-[83px]">Categories</h3>
    @livewire('add-category-form')
    @livewire('category-list') --}}
    @livewire('settings', [
        'entity' => 'category'
    ])
</div>
