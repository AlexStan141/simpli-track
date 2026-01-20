<div>
    @if ($entity == 'category')
        <h3 class="ml-[51px] mt-[49px] font-inter text-[20px] h-[15px] mb-[83px]">Categories</h3>
    @elseif($entity == 'currency')
        <h3 class="ml-[51px] mt-[49px] font-inter text-[20px] h-[15px] mb-[83px]">Currencies</h3>
    @elseif($entity == 'status')
        <h3 class="ml-[51px] mt-[49px] font-inter text-[20px] h-[15px] mb-[83px]">Statuses</h3>
    @endif
    @livewire('form', [
        'entity' => $entity,
    ])
    @livewire('list-of-items', [
        'entity' => $entity,
    ])

</div>
