<div>
    @if ($entity == 'category')
        <h3 class="ml-[51px] mt-[49px] font-inter text-[20px] h-[15px] mb-[83px]">Categories</h3>
    @elseif($entity == 'currency')
        <h3 class="ml-[51px] mt-[49px] font-inter text-[20px] h-[15px] mb-[83px]">Currencies</h3>
    @elseif($entity == 'status')
        <h3 class="ml-[51px] mt-[49px] font-inter text-[20px] h-[15px] mb-[83px]">Statuses</h3>
    @endif

    @if ($entity == 'city')
        <div class="flex gap-4 mt-20">
            @livewire('form', [
                'entity' => $entity,
            ])
            @livewire('list-of-items', [
                'entity' => $entity,
            ])
        </div>
    @else
        @livewire('form', [
            'entity' => $entity,
        ])
        @livewire('list-of-items', [
            'entity' => $entity,
        ])
    @endif
</div>
