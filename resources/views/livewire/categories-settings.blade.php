<div>
    <h3 class="ml-[51px] mt-[49px] font-inter text-[20px] h-[15px]">Categories</h3>
    <form class="flex gap-[86px] items-center" wire:submit.prevent="addCategory">
        <div class="ml-9 mt-[52px] flex flex-col gap-2">
            <x-input-label for="name" :value="__('Category Name')" class="leading-[14px] h-[12px] !text-editprofilelabel" />
            <x-text-input id="name" class="setting-text-input w-[590px]" type="text" name="name"
                wire:model="categoryToAdd" required />
            <p class="text-[10px] leading-[14px] h-[7px] italic font-nunito mt-[18px]">Rent, CAM, Parking, CAM
                Reconciliation, Taxes, Insurance</p>
        </div>
        <button class="bg-loginblue text-white py-3 px-[93px] rounded-[80px] mt-[26px]" type="submit">Save</button>
    </form>
    <div class="mt-[55px] ml-[46px] flex flex-col gap-[23px]">
        @forelse($categories as $category)
            @livewire(
                'category-editor',
                [
                    'oldCategory' => $category->name,
                    'categoryId' => $category->id,
                ],
                key($category->id)
            )

        @empty
        @endforelse
    </div>
</div>
