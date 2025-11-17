@php
    function suffix($i)
    {
        if ($i == 1 || $i == 21 || $i == 31) {
            return 'st';
        } elseif ($i == 2 || $i == 22) {
            return 'nd';
        } elseif ($i == 3 || $i == 23) {
            return 'rd';
        } else {
            return 'th';
        }
    }

@endphp

<div class="pl-[43px] pr-[28px] pt-[64px] grow">
    <p class="leading-[1.25rem] h-[15px] font-semibold font-inter ml-[11px]">Edit Invoice Templates</p>
    <hr class="mt-[16px] w-[100%]">
    </hr>
    <div class="flex justify-between mt-[79px]">
        <a href="{{ route('invoice.index') }}" class="leading-[14px] h-[12px] ml-[24px]">Back</a>
        <span class="leading-[14px] h-[12px]">Import from CSV</span>
    </div>
    <div class="bg-white ml-[17px] mt-[14px] pt-[55px] pl-[72px] pr-[39px]">
        <form action="" class="pt-7 flex flex-col gap-10">
            <div class="flex justify-between">
                <div>
                    <x-select-input :values="$categories" width="200px" id="category_id" label="Category"
                        wire:model="selected_category" defaultValue="{{ $selected_category }}"></x-select-input>
                    @error('selected_category')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <x-custom-input id="lease_no" label="Lease No. (optional)" width="270px" type="text"
                        wire:model="lease_no"></x-custom-input>
                    @error('lease_no')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="flex gap-2">
                    <x-custom-input id="amount" label="Amount" width="150px" type="number" wire:model="amount" />
                    @error('amount')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                    <x-select-input :values="$currencies" width="200px" id="user_id" label=""
                        wire:model="selected_currency" defaultValue="{{ $currency }}"></x-select-input>
                    @error('selected_currency')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <x-select-input :values="$users" width="200px" id="user_id" label="Assignee"
                        wire:model="selected_user" defaultValue="{{ $selected_user }}"></x-select-input>
                    @error('selected_user')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="flex justify-between">
                <div>
                    <x-select-input :values="$regions" id="region_id" label="Region" width="200px"
                        wire:model="selected_region" wire:change="updateCountryList"
                        defaultValue="{{ $selected_region }}" />
                    @error('selected_region')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <x-select-input :values="$countries" id="country_id" label="Country" width="200px"
                        wire:model="selected_country" wire:change="updateCityList"
                        defaultValue="{{ $selected_country }}" />
                    @error('selected_country')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <x-select-input :values="$cities" id="city_id" label="City" width="200px"
                        wire:model="selected_city" defaultValue="{{ $selected_city }}" />
                    @error('selected_city')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <x-select-input :values="$landlords" id="landlord_id" label="Landlord" width="200px"
                        wire:model="selected_landlord" defaultValue="{{ $selected_landlord }}" />
                    @error('selected_landlord')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="flex justify-between">
                <div class="flex items-center gap-[43px]">
                    Due date
                    <x-select-input :values="$due_days" id="due_day_id" label="" width="200px"
                        wire:model="selected_due_day" wire:change="updateLastTimePaid"
                        defaultValue="{{ $selected_due_day }}" />
                    of each month
                    @error('selected_due_day')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="flex items-center gap-[43px]">
                    Flag invoices for attention
                    <x-select-input :values="$invoices_for_attention" id="invoice_for_attention_id" label="" width="200px"
                        wire:model="selected_invoice_for_attention"
                        defaultValue="{{ $selected_invoice_for_attention }}" />
                    before due date
                    @error('selected_invoice')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <x-custom-input id="last_time_paid" label="Last Time Paid" width="150px" type="hidden" wire:model="last_time_paid"/>
                    @error('last_time_paid')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>
             <div class="flex flex-col gap-4">
                Frequency
                <div class="flex gap-[6px]">
                    @if ($selected_frequency === 'monthly')
                        <div class="border-loginblue border bg-loginblue text-white px-[17px] py-[13px] rounded-[20px] cursor-pointer"
                            wire:click="updateFrequency(0)">monthly</div>
                        <div class="border-loginblue border px-[17px] py-[13px] rounded-[20px] cursor-pointer"
                            wire:click="updateFrequency(1)">quarterly</div>
                    @else
                        <div class="border-loginblue border px-[17px] py-[13px] rounded-[20px] cursor-pointer"
                            wire:click="updateFrequency(0)">monthly</div>
                        <div class="border-loginblue border bg-loginblue text-white px-[17px] py-[13px] rounded-[20px] cursor-pointer"
                            wire:click="updateFrequency(1)">quarterly</div>
                    @endif
                </div>
            </div>
            <input type="hidden" name="frequency" value="{{ $selected_frequency }}">
            <button type="submit"
                class="bg-loginblue text-white py-3 px-[48.5px] self-center rounded-[80px] mb-[35px]">Save Template</button>
        </form>
    </div>
</div>
