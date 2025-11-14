<div>
    <h3 class="ml-[51px] mt-[49px] font-inter text-[20px] h-[15px]">Company</h3>
    <form method="POST" enctype="multipart/form-data" wire:submit.prevent="save('test')" class="flex flex-col">
        @csrf
        <div class="flex gap-[165px]">
            <div>
                <div class="ml-9 mt-[43px] flex flex-col gap-2">
                    <x-input-label for="name" :value="__('Company Name')"
                        class="text-[16px] leading-[14px] h-[12px] !text-editprofilelabel" />
                    <x-text-input id="name" class="setting-text-input w-[590px]" type="text" name="name"
                        wire:model="companyName" :value="$companyName" required />
                    @error('companyName')
                        <p>{{ $message }}</p>
                    @enderror
                </div>

                <div class="ml-9 mt-[50px] flex flex-col gap-2">
                    <x-input-label for="address" :value="__('Address')"
                        class="text-[16px] leading-[14px] h-[12px] !text-editprofilelabel" />
                    <x-text-input id="address" class="setting-text-input w-[590px]" type="text" name="address"
                        wire:model="companyAddress" :value="$companyAddress" required />
                    @error('companyAddress')
                        <p>{{ $message }}</p>
                    @enderror
                </div>
                <div class="ml-9 mt-[50px] flex flex-col gap-2">
                    <x-input-label for="regions" :value="__('Where are your regions?')"
                        class="text-[16px] leading-[14px] h-[12px] !text-editprofilelabel" />
                    <div class="flex mt-5 gap-5">
                        @foreach ($allRegions as $region)
                            @if (in_array($region, $existingRegions))
                                <button wire:click.prevent="toggleRegion('{{ $region }}')"
                                    class="bg-loginblue text-white py-[9px] px-[30px] rounded-[15px]">
                                    {{ $region }}
                                </button>
                            @else
                                <button wire:click.prevent="toggleRegion('{{ $region }}')"
                                    class="border-inputbordercolor border text-buttontext py-[9px] px-[30px] rounded-[15px]">
                                    {{ $region }}
                                </button>
                            @endif
                        @endforeach
                    </div>
                </div>
                <div class="mt-[41px] ml-[43px] flex gap-[15px] items-end">
                    <x-select-input width="96px" class="rounded-[5px]" id="currency" label="Default currency"
                        :values="$currencies" wire:model="defaultCurrency"
                        defaultValue="{{ $defaultCurrency }}"></x-select-input>
                    @error('defaultCurrency')
                        <p>{{ $message }}</p>
                    @enderror
                    <div class="flex items-center gap-[22px]">
                        <input type="checkbox" id="display_invoice_amount" name="display_invoice_amount"
                            wire:model="displayInvoiceAmount" :checked="{{ $displayInvoiceAmount }}"></input>
                        <x-input-label for="display_invoice_amount">Display Invoice Amount</x-input-label>
                        @error('displayInvoiceAmount')
                            <p>{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
            <div>
                <label for="logo" class="leading-[14px] h-[12px] text-editprofilelabel font-inter">Company
                    Logo</label>
                <div class="mt-[23px] w-[364px] bg-editprofileinput flex flex-col gap-[17px] justify-center items-center border border-dashed rounded-[15px] py-[44px] px-[24px]">
                    <img src="{{ asset('/images/upload.png') }}" alt="company logo">
                    <p class="leading-[28px] font-inter text-formtitle font-semibold">Drag & drop your files here</p>
                    <p class="text-[14px] leading-[22px] h-[32px] text-editprofilelabel">You can upload up to 1 file,
                        with a maximum<br /> size of 200 MB</p>
                    <p class="text-[18px] leading-[28px] h-[13px] text-formtitle">Or</p>
                    <label for="logo"
                        class="border border-uploadbuttonborder px-[32px] rounded-[130px] cursor-pointe transition">
                        <p class="text-[17px] leading-[40px] text-uploadbuttontext">Upload file</p>
                    </label>
                    <input id="logo" type="file" style="display: none;" wire:model="logo" />
                    <img id="logo-preview" src="#" alt="Preview"
                        style="display:none; max-width:200px; margin-top:10px;" />
                    @if ($logo)
                        <div class="mb-4">
                            Previzualizare:
                            @if (is_object($logo) && method_exists($logo, 'temporaryUrl'))
                                <img src="{{ $logo->temporaryUrl() }}" class="w-48 h-48 object-cover rounded">
                            @elseif (is_string($logo))
                                <img src="{{ Storage::url($logo) . '?' . time() }}"
                                    class="w-48 h-48 object-cover rounded">
                            @endif
                        </div>
                    @endif
                    @error('logo')
                        <p>{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>
        <div class="flex justify-center">
            <button type="submit" class="mt-[25px] px-[93px] py-[12px] mb-[19px] bg-loginblue rounded-[80px]">
                <p class="font-nunito text-white text-[18px] h-[25px]">Save</p>
            </button>
        </div>
    </form>
</div>
