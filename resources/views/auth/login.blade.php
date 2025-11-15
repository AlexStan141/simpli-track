<x-guest-layout class="pt-[67px] pb-[88px]">
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <img src="{{ asset('images/Logo.png') }}" alt="logo" width="420" height="82"/>

    <form method="POST" action="{{ route('login') }}" class="w-[300px] mt-[29px] gap-[20px] flex flex-col">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="text-white leading-[1rem]"/>
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" class="text-white leading-[1rem]"/>

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500 w-[20px] h-[20px]" name="remember">
                <span class="ml-[14px] text-white text-base leading-[20px]">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex flex-col items-start gap-1 mt-4">
            {{-- @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif --}}

            <x-primary-button class="mt-[52px] bg-transparent ring-1 ring-white w-[226px] h-[49px] justify-center font-nunito text-[18px]">
                {{ __('Log in') }}
            </x-primary-button>
            <a class="underline text-sm text-white hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                href="{{ route('register') }}">
                {{ __('Not registered yet?') }}
            </a>
        </div>
    </form>
</x-guest-layout>
