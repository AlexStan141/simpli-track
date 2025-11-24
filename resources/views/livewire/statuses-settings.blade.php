<div>
    <h3 class="ml-[51px] mt-[49px] font-inter text-[20px] h-[15px]">Statuses</h3>
    <form class="flex gap-[86px] items-center" wire:submit.prevent="addStatus">
        <div class="ml-9 mt-[52px] flex flex-col gap-2">
            <x-input-label for="name" :value="__('Status Name')" class="leading-[14px] h-[12px] !text-editprofilelabel" />
            <div class = 'flex gap-[19px] items-center'>
                <x-text-input id="name" class="setting-text-input w-[590px]" type="text" name="name"
                    wire:model="status_to_add" required />
                <input type="color" id="color" name="color" wire:model="status_to_add_color" class="h-[30px] w-[30px]">
                <button class="bg-loginblue text-white py-3 px-[93px] rounded-[80px] ml-[18px]" type="submit">Save</button>
            </div>
            <p class="text-[10px] leading-[14px] h-[7px] italic font-nunito mt-[18px]">Rent, CAM, Parking, CAM
                Reconciliation, Taxes, Insurance</p>
        </div>
    </form>
    <div class="mt-[55px] ml-[46px] flex flex-col gap-[23px]">
        @forelse($statuses as $status)
            @livewire(
                'status-editor',
                [
                    'old_status_color' => $status->color,
                    'old_status' => $status->name,
                    'status_id' => $status->id,
                ],
                key($status->id)
            )

        @empty
        @endforelse
    </div>
</div>
