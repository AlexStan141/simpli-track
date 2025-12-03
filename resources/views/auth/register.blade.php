<script>
    document.addEventListener('DOMContentLoaded', function() {
        const input = document.querySelector("#phone");
        const countryInput = document.querySelector("#country");

        const iti = window.intlTelInput(input, {
            initialCountry: "ro",
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
<x-guest-layout class="pt-[67px] pb-[88px]">

    <img src="{{ asset('images/Logo.png') }}" alt="logo register" width="420" height="82"/>

    <form method="POST" action="{{ route('register') }}" class="w-[300px] mt-[29px] gap-[20px] flex flex-col">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="first_name" :value="__('First Name')" class="text-white leading-[1rem]"/>
            <x-text-input id="first_name" class="block mt-1 w-full" type="text" name="first_name" :value="old('first_name')" required
                autofocus />
            <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="last_name" :value="__('Last Name')" class="text-white leading-[1rem]"/>
            <x-text-input id="last_name" class="block mt-1 w-full" type="text" name="last_name" :value="old('last_name')" required
                autofocus />
            <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" class="text-white leading-[1rem]"/>
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                required />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" class="text-white leading-[1rem]"/>

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-white leading-[1rem]"/>

            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="role_id" :value="__('Role')" class="text-white leading-[1rem]"/>
            <x-select-input id="role_id" label="" :values="$roles" defaultValue="{{ $roles[1] }}"
                class="w-[300px]"></x-select-input>
            <x-input-error :messages="$errors->get('role_id')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="phone" :value="__('Phone')" class="text-white leading-[1rem]" />
            <x-text-input id="phone"
                class="block mt-1 w-full p-[16px] h-[42px] text-[14px] leading-none"
                type="text" name="phone" value="{{ old('phone') }}"></x-text-input>
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>

        <div class="mt-4 hidden">
            <x-input-label for="company_id" :value="__('Company')" class="text-white leading-[1rem]"/>
            <x-select-input id="company_id" label="" :values="$companies" defaultValue="{{ $companies[1] }}"
                class="w-[300px]"></x-select-input>
            <x-input-error :messages="$errors->get('company_id')" class="mt-2" />
        </div>

        <input id="country" type="hidden" name="country" value="">

        <div class="flex flex-col items-start gap-1 mt-4">
            <x-primary-button class="mt-[52px] bg-transparent ring-1 ring-white w-[226px] h-[49px] justify-center font-nunito text-[18px]">
                {{ __('Register') }}
            </x-primary-button>
            <a class="underline text-sm text-white hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>
        </div>
    </form>
</x-guest-layout>
