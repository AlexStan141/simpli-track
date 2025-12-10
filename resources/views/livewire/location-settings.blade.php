<div>
    <h3 class="ml-[67px] mt-[49px] font-inter text-[20px] h-[15px]">Regions & Locations</h3>
    @if (session()->has('error'))
        <p class="mt-4 ml-4 p-2 bg-red-300">{{ session('error') }}</p>
    @endif
    <div class="flex mt-[50px]">
        <div>
            <div class="ml-[52px]">
                <x-input-label for="region" :value="__('Region')" class="leading-[14px] h-[12px] !text-editprofilelabel" />
                <x-text-input id="region" class="setting-text-input w-[450px] mt-2" type="text" name="region"
                    wire:model="regionToAdd" required />
                <button wire:click="addRegion"
                    class="py-3 px-[93px] bg-loginblue text-white mt-[18px] rounded-[80px]">Save</button>
            </div>
            <div class="mt-[72px] ml-[97px] flex flex-col gap-[23px]">
                @foreach ($regions as $region)
                    @livewire(
                        'editable-input',
                        [
                            'old_value' => $region->name,
                            'role' => 'region_settings',
                        ],
                        key($region->id)
                    )
                @endforeach
            </div>
        </div>
        <div class="bg-setting w-[1px] h-[443px] ml-[110px] mb-[151px]"></div>
        <div class="ml-[43px]">
            <div>
                <x-input-label for="country" :value="__('Country')"
                    class="leading-[14px] h-[12px] !text-editprofilelabel" />
                <div class="flex gap-2 items-end">
                    <x-text-input id="country" class="setting-text-input w-[450px] mt-2" type="text" name="country"
                        wire:model="countryToAdd" required />
                    <x-select-input :values="$currencies" width="200px" id="selected_currency_id" label=""
                        wire:model="selected_currency_id" defaultValue="{{ $selected_currency_id }}"></x-select-input>
                </div>
                <div class="flex gap-7 items-center">
                    <x-select-input class="w-[200px] rounded-[32px]" id="region" label="" :values="$regions->pluck('name', 'id')"
                        wire:model="selected_region_id" wire:change="update_region" defaultValue="{{ $selected_region_id }}"></x-select-input>
                    <button wire:click="addCountry"
                        class="py-3 px-[93px] bg-loginblue text-white mt-[18px] rounded-[80px]">Save</button>
                </div>
            </div>
            <div class="mt-[69px]">
                @if ($regions->count() > 0)
                    <x-select-input class="w-[200px] rounded-[32px]" id="region_id" label="" :values="$regions->pluck('name', 'id')"
                        wire:model="selected_region_id" wire:change="update_region"
                        defaultValue="{{ $selected_region_id }}"></x-select-input>
                    <div class="grid grid-cols-2 gap-x-[38px] gap-y-[18px] mt-[25px]">
                        @foreach ($countries as $country)
                            @livewire(
                                'editable-input',
                                [
                                    'old_value' => $country->name,
                                    'role' => 'country_settings',
                                ],
                                key($country->id)
                            )
                        @endforeach
                    </div>
                @else
                    <div class="text-red-500">No regions with countries found!</div>
                @endif
            </div>
        </div>
    </div>
    <hr>
    <div class="flex pt-[50px] pb-[10px] pl-[52px]">
        <div class="mr-[100px]">
            <div>
                <div class="h-[25px]"></div>
                @if ($countries->count() > 0)
                    <div>
                        <x-input-label for="city" :value="__('City')"
                            class="leading-[14px] h-[12px] !text-editprofilelabel" />
                        <x-text-input id="city" class="setting-text-input w-[450px] mt-2" type="text"
                            name="city" wire:model="cityToAdd" required />
                    </div>
                    <div class="flex gap-7 items-center">
                        <x-select-input class="w-[200px] rounded-[32px]" id="region" label="" :values="$regions->pluck('name','id')"
                            wire:model="selected_region_id" defaultValue="{{ $selected_region_id }}"
                            wire:change="update_region"></x-select-input>
                        <x-select-input class="w-[200px] rounded-[32px]" id="country" label="" :values="$countries->pluck('name','id')"
                            wire:model="selected_country_id" wire:change="update_country" defaultValue="{{ $selected_country_id }}"></x-select-input>
                    </div>
                    <button wire:click="addCity"
                        class="py-3 px-[93px] bg-loginblue text-white mt-[18px] rounded-[80px]">Save</button>
                @else
                    <div class="text-red-500">Countries needed for city operations!</div>
                @endif
            </div>
        </div>
        <div class="bg-setting w-[1px] h-[443px]"></div>
        <div class="ml-[43px]">
            <div>
                @if ($countries->count() > 0)
                    <div class="flex gap-2">
                        <x-select-input class="w-[200px] rounded-[32px]" id="region_id" label="" :values="$regions->pluck('name','id')"
                            wire:model="selected_region_id" wire:change="update_region"
                            defaultValue="{{ $selected_region_id }}"></x-select-input>
                        <x-select-input class="w-[200px] rounded-[32px]" id="country_id" label=""
                            :values="$countries->pluck('name','id')" wire:model="selected_country_id" wire:change="update_country"
                            defaultValue="{{ $selected_country_id }}"></x-select-input>
                    </div>
                    <div class="grid grid-cols-2 gap-x-[38px] gap-y-[18px] mt-[25px]">
                        @if ($cities->count() > 0)
                            @foreach ($cities as $city)
                                @livewire(
                                    'editable-input',
                                    [
                                        'old_value' => $city->name,
                                        'role' => 'city_settings',
                                    ],
                                    key($city->id)
                                )
                            @endforeach
                        @else
                            <div class="text-red-500">No cities for this country!</div>
                        @endif
                    </div>
                @else
                    <div class="text-red-500">Countries needed for city operations!</div>
                @endif
            </div>
        </div>
    </div>
</div>
