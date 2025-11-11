<div>
    <h3 class="ml-[51px] mt-[49px] font-inter text-[20px] h-[15px]">Company</h3>

    <div class="ml-9 mt-[43px] flex flex-col gap-2">
        <x-input-label for="company_name" :value="__('Company Name')"
            class="text-[16px] leading-[14px] h-[12px] !text-editprofilelabel" />
        <x-text-input id="address" class="setting-text-input" type="text" name="address"
            value="{{ $companyName ?? '' }}" required />
    </div>

    <div class="ml-9 mt-[50px] flex flex-col gap-2">
        <x-input-label for="address" :value="__('Address')"
            class="text-[16px] leading-[14px] h-[12px] !text-editprofilelabel" />
        <x-text-input id="address" class="setting-text-input" type="text" name="address"
            value="{{ $companyAddress ?? '' }}" required />
    </div>

    <div class="ml-9 mt-[50px] flex flex-col gap-2">
        <x-input-label for="regions" :value="__('Where are your regions?')"
            class="text-[16px] leading-[14px] h-[12px] !text-editprofilelabel" />
        <div class="flex mt-5 gap-5">
            @foreach ($regions as $region)
                @livewire('region-setting', ['selected' => true, 'value' => $region])
            @endforeach
            @foreach ($deletedRegions as $region)
                @livewire('region-setting', ['selected' => false, 'value' => $region])
            @endforeach
        </div>
    </div>

    <div class="flex justify-center">
        <button type="submit" class="mt-[134px] px-[93px] py-[12px] mb-[19px] bg-loginblue rounded-[80px]">
            <p class="font-nunito text-white text-[18px] h-[25px]">Save</p>
        </button>
    </div>

</div>
