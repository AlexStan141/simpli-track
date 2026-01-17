<div>
    @if ($entity == 'category')
        <h3 class="ml-[51px] mt-[49px] font-inter text-[20px] h-[15px] mb-[83px]">Categories</h3>
        @livewire('form', [
            'entity' => $entity,
        ])
        @livewire('list-of-items', [
            'entity' => $entity,
        ])
    @endif
</div>
