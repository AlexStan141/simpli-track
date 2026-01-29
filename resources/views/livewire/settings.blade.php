<div>
    @if ($entity == 'category')
        <h3 class="ml-[51px] mt-[49px] font-inter text-[20px] h-[15px] mb-[83px]">Categories</h3>
    @elseif($entity == 'currency')
        <h3 class="ml-[51px] mt-[49px] font-inter text-[20px] h-[15px] mb-[83px]">Currencies</h3>
    @elseif($entity == 'status')
        <h3 class="ml-[51px] mt-[49px] font-inter text-[20px] h-[15px] mb-[83px]">Statuses</h3>
    @endif

    @if ($entity == 'city')
        <div class="flex gap-4 mt-20 items-center">
            <div>
                @livewire('add-item-form', [
                    'entity' => $entity,
                ])
            </div>
            <div class="ml-[51px]">
                @livewire('list-of-items', [
                    'entity' => $entity,
                ])
            </div>
        </div>
    @elseif($entity == 'region')
        @livewire('add_item_form', [
            'entity' => $entity,
        ])
        <div class="ml-[51px]">
            @livewire('list-of-items', [
                'entity' => $entity,
            ])
        </div>
    @elseif($entity == 'country')
        @livewire('add-item-form', [
            'entity' => $entity,
        ])
        <div class="ml-[51px]">
            @livewire('list-of-items', [
                'entity' => $entity,
            ])
        </div>
    @endif
</div>
