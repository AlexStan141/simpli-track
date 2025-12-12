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

    function valid_amount_format($txt)
    {
        $pattern = '/[0-9,]/';
        return preg_match_all($pattern, $txt) == strlen($txt);
    }

@endphp

<div class="pl-[150px] pr-[28px] pt-[64px] pb-[64px] grow">
    <p class="leading-[1.25rem] h-[15px] font-semibold font-inter ml-[11px]">Add Invoice Templates</p>
    <hr class="mt-[16px] w-[100%]">
    </hr>
    @if (session()->has('success'))
        <p class="bg-green-300 py-2 pl-2">{{ session('success') }}</p>
    @endif
    <div class="flex justify-between mt-[79px]">
        <a href="{{ route('invoice.index') }}" class="leading-[14px] h-[12px] ml-[24px]">Back</a>
        <span class="leading-[14px] h-[12px]">Import from CSV</span>
    </div>
    <div class="bg-white ml-[17px] mt-[14px] pt-[55px] pl-[72px] pr-[39px]">
        @if ($cities->count() > 0)
            <form action="{{ route('invoice.store') }}" wire:submit.prevent="createInvoiceTemplate"
                class="pt-7 flex flex-col gap-10">
                <div class="flex justify-between items-start">
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
                            wire:model="selected_city" defaultValue="{{ $cities->first() }}" />
                        @error('selected_city')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <x-select-input :values="$landlords" id="landlord_id" label="Landlord" width="200px"
                            wire:model="selected_landlord" defaultValue="{{ $landlords->first() }}" />
                        @error('selected_landlord')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="flex justify-between items-start">
                    <div>
                        <x-select-input :values="$categories" width="200px" id="category_id" label="Category"
                            wire:model="selected_category" defaultValue="{{ $categories->first() }}"></x-select-input>
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
                    <div class="flex flex-col gap-2">
                        <div class="flex gap-2 items-end">
                            <x-custom-input id="amount" label="Amount" width="150px" type="text"
                                wire:change="format_amount" wire:model="amount" />
                            <p>{{ ' ' . $selected_currency->name }}</p>
                        </div>
                        @error('amount')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                        @error('selected_currency')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <x-select-input :values="$users" width="200px" id="user_id" label="Assignee"
                            wire:model="selected_user" defaultValue="{{ $users->first() }}"></x-select-input>
                        @error('selected_user')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="flex justify-between items-start">
                    <div class="flex flex-col items-start">
                        <div class="flex items-center gap-[43px]">
                            <p class="mt-4">Due date</p>
                            <x-select-input :values="$due_days" id="due_day_id" label="" width="200px"
                                wire:model="selected_due_day" defaultValue="{{ Auth::user()->company->due_day_id }}" />
                            <p class="mt-4">of each month</p>
                        </div>
                        @error('selected_due_day')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="flex flex-col items-start">
                        <div class="flex items-center gap-[43px]">
                            <p class="mt-4">Flag invoices for attention</p>
                            <x-select-input :values="$invoices_for_attention" id="invoice_for_attention_id" label=""
                                width="200px" wire:model="selected_invoice_for_attention"
                                defaultValue="{{ Auth::user()->company->invoices_for_attention_id }}" />
                            <p class="mt-4">before due date</p>
                        </div>
                        @error('selected_invoice')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="flex gap-4 items-center">
                    Frequency
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
                <input type="hidden" name="frequency" wire:model="selected_frequency"
                    value="{{ $selected_frequency }}">
                <input type="hidden" name="selected_currency" wire:model="selected_currency"
                    value="{{ $selected_currency }}">
                @error('frequency')
                    <p>{{ $message }}</p>
                @enderror
                <button type="submit"
                    class="bg-loginblue text-white py-3 px-[48.5px] self-center rounded-[80px] mb-[35px]">Save
                    Template</button>
            </form>
        @else
            <div class="text-red-500">Location services are required. Please go to Settings to add locations.</div>
        @endif
    </div>
</div>
