<x-app-layout>
    <x-vertical-menu active-link="/settings"></x-vertical-menu>
    <div class="mt-[63px] ml-[54px]">
        <p class="text-xl leading-[20px] h-[15px] font-semibold">Settings</p>
        <hr class="mt-[16px] w-[100%]">
        <div class="flex flex-col border border-setting mt-[65px]">
            <ul class="flex">
                <x-setting-link link="/settings/company" :active="$page === 'Company'">Company</x-setting-link>
                <x-setting-link link="/settings/users" :active="$page === 'Users & Roles'">Users & Roles</x-setting-link>
                <x-setting-link link="/settings/priority" :active="$page === 'Priority'">Priority</x-setting-link>
                <x-setting-link link="/settings/categories" :active="$page === 'Categories'">Categories</x-setting-link>
                <x-setting-link link="/settings/statuses" :active="$page === 'Statuses'">Statuses</x-setting-link>
                <x-setting-link link="/settings/locations" :active="$page === 'Regions & Locations'">Regions & Locations</x-setting-link>
            </ul>
            <div class="h-[643px]">
                @if ($page === 'Company')
                    @livewire('company-settings', [
                        'companyName' => Auth::user()->company->name,
                        'companyAddress' => Auth::user()->company->address,
                        'currencies' => collect([1 => 'USD', 2 => 'RON', 3 => 'ARS'])
                    ])
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
