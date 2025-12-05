<div>
    <p class="mt-[49px] ml-[52px] text-[20px] height-[15px] text-formtitle font-inter">Users & Roles</p>
    @if (session()->has('success'))
        <p class="p-2 bg-green-300 border-l-green-700 border-[2px]">{{ session('success') }}</p>
    @endif
    <form wire:submit.prevent="save" x-data="{ iti: null }" x-init="iti = intlTelInput($refs.phone, {
        initialCountry: 'ro',
        separateDialCode: true,
        utilsScript: 'https://cdn.jsdelivr.net/npm/intl-tel-input/build/js/utils.js'
    });

    // re-initializează după fiecare update Livewire
    Livewire.hook('message.processed', () => {
        if (!$refs.phone.classList.contains('iti')) {
            iti = intlTelInput($refs.phone, {
                initialCountry: 'ro',
                separateDialCode: true,
                utilsScript: 'https://cdn.jsdelivr.net/npm/intl-tel-input/build/js/utils.js'
            });
        }
    });">
        <div class="grid grid-cols-2 gap-x-[143px] gap-y-[32px] mt-[55px] ml-[36px]">
            <div>
                <x-input-label>First Name</x-input-label>
                <x-text-input id="firstName" class="setting-text-input w-[450px]" type="text" name="firstName"
                    wire:model="firstName" />
                @error('firstName')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <x-input-label>Last Name</x-input-label>
                <x-text-input id="lastName" class="setting-text-input w-[450px]" type="text" name="lastName"
                    wire:model="lastName" />
                @error('lastName')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <x-input-label>Password</x-input-label>
                <x-text-input id="password" class="setting-text-input w-[450px]" type="password" name="password"
                    wire:model="password" />
                @error('password')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <x-input-label>Confirm Password</x-input-label>
                <x-text-input id="confirmPassword" class="setting-text-input w-[450px]" type="password"
                    name="confirmPassword" wire:model="confirmPassword" />
                @error('confirmPassword')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <x-input-label>Email</x-input-label>
                <x-text-input id="email" class="setting-text-input w-[450px]" type="email" name="email"
                    wire:model="email" />
                @error('email')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div class="w-[450px]">
                <div class="flex justify-between">
                    <x-input-label for="role_id" :value="__('Role')" />
                    <p class="right-[63px]">hierarchy</p>
                </div>
                <x-select-input id="role_id" label="" :values="$roles" defaultValue="{{ $roles[1] }}"
                    class="w-full" wire:model="role_id"></x-select-input>
                <p class="text-[10px] mt-[11px] italic">Admin (all), Portfolio Manager (regional), Lease Admin (input),
                    Director (summary)</p>
                <x-input-error :messages="$errors->get('role_id')" class="mt-2" />
            </div>
            <div class="mt-4 hidden">
                <x-input-label for="company_id" :value="__('Company')" />
                <x-select-input id="company_id" label="" :values="$companies" defaultValue="{{ $companies[1] }}"
                    class="w-[300px]"></x-select-input>
                <x-input-error :messages="$errors->get('company_id')" class="mt-2" />
            </div>

            <input id="phone" x-ref="phone" type="tel" wire:model.defer="phone"
                @blur="$refs.phone.value = iti.getNumber(); $refs.country.value = iti.getSelectedCountryData().iso2">

            <!-- Input hidden pentru country -->
            <input type="hidden" x-ref="country" wire:model.defer="country">
        </div>
        <div class="flex justify-center">
            <button type="submit" class="mt-[75px] px-[93px] py-[12px] mb-[19px] bg-loginblue rounded-[80px]">
                <p class="font-nunito text-white text-[18px] h-[25px]">Save</p>
            </button>
        </div>
    </form>
    @livewire('user-list')
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const input = document.querySelector("#phone");
        const countryInput = document.querySelector("#country");


        const iti = window.intlTelInput(input, {
            initialCountry: "us",
            preferredCountries: ["ro", "us", "gb", "ca"],
            separateDialCode: true,
            nationalMode: false,
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"
        });

        input.form.addEventListener("submit", function() {
            input.value = iti.getNumber();
            countryInput.value = iti.getSelectedCountryData().iso2;
        });
    });
</script>
