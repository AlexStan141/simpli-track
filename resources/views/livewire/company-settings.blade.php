<div>
    <h3 class="ml-[51px] mt-[49px] font-inter text-[20px] h-[15px]">Company</h3>

    <form method="POST" wire:submit.prevent="save()">
        <div class="ml-9 mt-[43px] flex flex-col gap-2">
            <x-input-label for="name" :value="__('Company Name')"
                class="text-[16px] leading-[14px] h-[12px] !text-editprofilelabel" />
            <x-text-input id="name" class="setting-text-input" type="text" name="name"
                value="{{ $companyName ?? '' }}" required wire:model="companyName" />
            @error('name')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <div class="ml-9 mt-[50px] flex flex-col gap-2">
            <x-input-label for="address" :value="__('Address')"
                class="text-[16px] leading-[14px] h-[12px] !text-editprofilelabel" />
            <x-text-input id="address" class="setting-text-input" type="text" name="address"
                value="{{ $companyAddress ?? '' }}" required wire:model="companyAddress" />
            @error('address')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <div class="ml-9 mt-[50px] flex flex-col gap-2">
            <x-input-label for="regions" :value="__('Where are your regions?')"
                class="text-[16px] leading-[14px] h-[12px] !text-editprofilelabel" />
            <div class="flex mt-5 gap-5">
                @foreach ($allRegions as $region)
                    @if (in_array($region, $existingRegions))
                        <button class="bg-loginblue text-white py-[9px] px-[30px] rounded-[15px]" wire:click.prevent="toggleRegion('{{ $region }}')">{{ $region }}</button>
                    @else
                        <button class="border-inputbordercolor text-buttontext py-[9px] px-[30px] rounded-[15px]" wire:click.prevent="toggleRegion('{{ $region }}')">{{ $region }}</button>
                    @endif
                @endforeach
            </div>
        </div>

        <div class="mt-[41px] ml-[43px] flex">
            <x-select-input width="96px" class="rounded-[5px]" id="currency" label="Default currency"
                :values="$currencies" wire:model="defaultCurrency" defaultValue="{{ $defaultCurrency }}"></x-select-input>
        </div>
        @error('defaultCurrency')
            <p>{{ $message }}</p>
        @enderror

        <div class="flex justify-center">
            <button type="submit" class="mt-[134px] px-[93px] py-[12px] mb-[19px] bg-loginblue rounded-[80px]">
                <p class="font-nunito text-white text-[18px] h-[25px]">Save</p>
            </button>
        </div>
    </form>
</div>
