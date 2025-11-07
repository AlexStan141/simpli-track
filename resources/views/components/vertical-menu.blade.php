@php
    $selectedColor = 'white';
    $notSelectedColor = 'loginblue';
@endphp


<div class="w-[127px] bg-loginblue">
    <div class="mt-[91px] pl-2 flex flex-col gap-[113px]">
        <x-menu-link active="{{ $activeLink === '/dashboard' }}" link="/dashboard" text="Dashboard">
            <img src="{{ $activeLink === '/dashboard' ? asset('/images/selected_dashboard.png') : asset('/images/dashboard.png') }}"
                alt="dashboard">
        </x-menu-link>
        <x-menu-link active="{{ $activeLink === '/invoice' }}" link="/invoice">
            <img src="{{ $activeLink === '/invoice' ? asset('/images/selected_invoices.png') : asset('/images/invoices.png') }}"
                alt="invoices">
        </x-menu-link>
        <x-menu-link active="{{ $activeLink === '/alerts' }}" link="/alerts" text="Alerts">
            <img src="{{ asset('/images/money.png') }}" alt="alerts">
        </x-menu-link>
    </div>
    <div class="mt-[208px] px-[27px] h-[609px]">
        <div class=" border-t-white border-t pt-[47px] items-center gap-[47px] h-[100%] flex flex-col">
            <img src="{{ asset('images/question.png') }}" alt="invoices" width="24" height="24">
            <x-menu-link active="{{ $activeLink === '/settings' }}" link="/settings">
                @if (Auth::user()->role === 'Admin')
                    <img src="{{ $activeLink === '/settings' ? asset('images/settings.png') : asset('images/settings.png') }}" alt="invoices">
                @endif
            </x-menu-link>
        </div>
    </div>
</div>
