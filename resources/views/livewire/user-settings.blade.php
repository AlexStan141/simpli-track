<div>
    <p class="mt-[49px] ml-[52px] text-[20px] height-[15px] text-formtitle font-inter">Users & Roles</p>
    @if (session()->has('success'))
        <p class="p-2 bg-green-300 border-l-green-700 border-[2px]">{{ session('success') }}</p>
    @endif
    <form wire:submit.prevent="save">
        <div class="grid grid-cols-2 gap-x-[143px] gap-y-[32px] mt-[55px] ml-[36px]">
            <div>
                <x-input-label>First Name</x-input-label>
                <x-text-input id="firstName" class="setting-text-input w-[450px]" type="text" name="firstName"
                    wire:model="firstName" required />
                @error('firstName')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <x-input-label>Last Name</x-input-label>
                <x-text-input id="lastName" class="setting-text-input w-[450px]" type="text" name="lastName"
                    wire:model="lastName" required />
                @error('lastName')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <x-input-label>Password</x-input-label>
                <x-text-input id="password" class="setting-text-input w-[450px]" type="password" name="password"
                    wire:model="password" required />
                @error('password')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <x-input-label>Confirm Password</x-input-label>
                <x-text-input id="confirmPassword" class="setting-text-input w-[450px]" type="password"
                    name="confirmPassword" wire:model="confirmPassword" required />
                @error('confirmPassword')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <x-input-label>Email</x-input-label>
                <x-text-input id="email" class="setting-text-input w-[450px]" type="email" name="email"
                    wire:model="email" required />
                @error('email')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div class="relative">
                <x-input-label for="role" :value="__('Role')" class="text-white leading-[1rem]" />
                <x-select-input id="role" label="" :values="$roles" defaultValue="{{ $roles[1] }}"
                    class="w-[300px]" wire:model="role"></x-select-input>
                <p class="absolute right-[63px] top-0">hierarchy</p>
                <p class="text-[10px] mt-[11px] italic">Admin (all), Portfolio Manager (regional), Lease Admin (input),
                    Director (summary)</p>
                <x-input-error :messages="$errors->get('role')" class="mt-2" />
            </div>
        </div>
        <div class="flex justify-center">
            <button type="submit" class="mt-[75px] px-[93px] py-[12px] mb-[19px] bg-loginblue rounded-[80px]">
                <p class="font-nunito text-white text-[18px] h-[25px]">Save</p>
            </button>
        </div>
    </form>
</div>
