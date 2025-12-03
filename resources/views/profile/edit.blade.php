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

        iti.setCountry("{{ $user->country }}");

        input.form.addEventListener("submit", function() {

            let countryClass = document.getElementsByClassName('iti__selected-flag')[0].getAttribute('aria-activedescendant');
            let countryCode = countryClass.replace('iti-0__item-', '').replace('-preferred', '');
            countryInput.value = countryCode;
            input.value = iti.getNumber();
        });
    });

</script>
<x-app-layout>
    <x-vertical-menu active-link="/profile"></x-vertical-menu>
    <div class="p-[54px] flex flex-col">
        <div
            class="ring-1 ring-loginblue w-[1205px] h-[280px] mb-[48px] rounded-[22px] flex flex-col items-center gap-[18px]">
            <div class="mt-[28.5px]">
                <img src="{{ asset('images/avatar.png') }}" alt="Avatar">
            </div>
            <div class="flex flex-col items-center gap-2">
                <div class="font-nunito text-loginblue text-2xl leading-none">
                    {{ auth()->user()->first_name . ' ' . auth()->user()->last_name }}</div>
                <div class="font-nunito text-loginblue text-base leading-none">{{ auth()->user()->role->name }}</div>
            </div>
        </div>
        @if (session()->has('success'))
            <p class="bg-green-300 px-[10px] py-[20px] mb-[5px]">{{ session('success') }}</p>
        @endif
        <form class="border-t-[1px] border-formgray py-12" action="{{ route('profile.update') }}" method="POST">
            @csrf
            @method('PUT')
            <p class="font-semibold text-formtitle text-xl h-[14px]">Basic details</p>
            <div class="grid grid-cols-2 gap-x-[22.5px] gap-y-[39px] mt-[32px]">
                <div class="flex flex-col gap-2">
                    <x-input-label for="first_name" :value="__('First Name')"
                        class="text-editprofilelabel leading-[14px] h-[12px]" />
                    <x-text-input id="first_name"
                        class="block mt-1 w-full bg-editprofileinput border-formgray border p-[16px] h-[42px] text-[14px] leading-none"
                        type="text" name="first_name" value="{{ old('first_name') ?? $user['first_name'] }}" />
                    <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
                </div>
                <div class="flex flex-col gap-2">
                    <x-input-label for="last_name" :value="__('Last Name')"
                        class="text-editprofilelabel leading-[14px] h-[12px]" />
                    <x-text-input id="last_name"
                        class="block mt-1 w-full bg-editprofileinput border-formgray border p-[16px] h-[42px] text-[14px] leading-none"
                        type="text" name="last_name" value="{{ old('last_name') ?? $user['last_name'] }}" />
                    <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
                </div>
                <div class="flex flex-col gap-2">
                    <x-input-label for="email" :value="__('Email')"
                        class="text-editprofilelabel leading-[14px] h-[12px]" />
                    <x-text-input id="email"
                        class="block mt-1 w-full bg-editprofileinput border-formgray border p-[16px] h-[42px] text-[14px] leading-none"
                        type="email" name="email" value="{{ old('email') ?? $user['email'] }}" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
                <div class="flex flex-col gap-2">
                    <x-input-label for="phone" :value="__('Phone')"
                        class="text-editprofilelabel leading-[14px] h-[12px]" />
                    <x-text-input id="phone"
                        class="block mt-1 w-full bg-editprofileinput border-formgray border p-[16px] h-[42px] text-[14px] leading-none"
                        type="text" name="phone" value="{{ old('phone') ?? $user['phone'] }}" />
                    <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                </div>
                <input id="country" type="hidden" name="country" value="{{ old('country') ?? $user['country'] }}">
                <div class="flex flex-col gap-2">
                    <x-input-label for="password" :value="__('Current Password')"
                        class="text-editprofilelabel leading-[14px] h-[12px]" />
                    <x-text-input id="password"
                        class="block mt-1 w-full bg-editprofileinput border-formgray border p-[16px] h-[42px] text-[14px] leading-none"
                        type="password" name="password" value=""></x-text-input>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
                <div class="flex flex-col gap-2">
                    <x-input-label for="new_password" :value="__('New Password')"
                        class="text-editprofilelabel leading-[14px] h-[12px]" />
                    <x-text-input id="new_password"
                        class="block mt-1 w-full bg-editprofileinput border-formgray border p-[16px] h-[42px] text-[14px] leading-none"
                        type="password" name="new_password" value=""></x-text-input>
                    <x-input-error :messages="$errors->get('new_password')" class="mt-2" />
                </div>
                <div class="flex flex-col gap-2">
                    <x-input-label for="confirm_new_password" :value="__('Confirm New Password')"
                        class="text-editprofilelabel leading-[14px] h-[12px]" />
                    <x-text-input id="confirm_new_password"
                        class="block mt-1 w-full bg-editprofileinput border-formgray border p-[16px] h-[42px] text-[14px] leading-none"
                        type="password" name="confirm_new_password" value=""></x-text-input>
                    <x-input-error :messages="$errors->get('confirm_new_password')" class="mt-2" />
                </div>
            </div>
            <div class="text-center mt-[76px]">
                <button type="submit"
                    class="bg-loginblue py-[12px] px-[93px] mx-auto rounded-[80px] text-white font-nunito">Save</button>
            </div>
        </form>
    </div>
</x-app-layout>
