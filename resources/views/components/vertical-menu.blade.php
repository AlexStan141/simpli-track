@php
    $selectedColor = 'white';
    $notSelectedColor = 'loginblue';
@endphp


<div class="w-[127px] bg-loginblue fixed">
    <div class="mt-[125px] pl-2 flex flex-col gap-[25px]">
        <x-menu-link active="{{ $activeLink === '/dashboard' }}" link="/dashboard" text="Dashboard">
            <img src="{{ $activeLink === '/dashboard' ? asset('/images/selected_dashboard.png') : asset('/images/dashboard.png') }}"
                alt="dashboard">
        </x-menu-link>
        <x-menu-link active="{{ $activeLink === '/invoices' }}" link="/invoices">
            <img src="{{ $activeLink === '/invoices' ? asset('/images/selected_invoices.png') : asset('/images/invoices.png') }}"
                alt="invoices">
        </x-menu-link>
        <x-menu-link active="{{ $activeLink === '/alerts' }}" link="/alerts" text="Alerts">
            <img src="{{ $activeLink === '/alerts' ? asset('/images/selected_money.png') : asset('/images/money.png') }}"
                alt="alerts">
        </x-menu-link>
    </div>
    <div class="mt-[50px] px-[27px] h-[609px]">
        <div class=" border-t-white border-t pt-[47px] items-center gap-[25px] h-[100%] flex flex-col">
            <a href="help">
                <x-menu-link active="{{ $activeLink === '/help' }}" link="{{ '/help' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path
                            d="M10.8 16.8H13.2V19.2H10.8V16.8ZM12 0C5.376 0 0 5.376 0 12C0 18.624 5.376 24 12 24C18.624 24 24 18.624 24 12C24 5.376 18.624 0 12 0ZM12 21.6C6.708 21.6 2.4 17.292 2.4 12C2.4 6.708 6.708 2.4 12 2.4C17.292 2.4 21.6 6.708 21.6 12C21.6 17.292 17.292 21.6 12 21.6ZM12 4.8C9.348 4.8 7.2 6.948 7.2 9.6H9.6C9.6 8.28 10.68 7.2 12 7.2C13.32 7.2 14.4 8.28 14.4 9.6C14.4 12 10.8 11.7 10.8 15.6H13.2C13.2 12.9 16.8 12.6 16.8 9.6C16.8 6.948 14.652 4.8 12 4.8Z"
                            fill="{{$activeLink === '/help' ? '#334461' : 'white'}}" />
                    </svg>
                </x-menu-link>
            </a>
            @if (Auth::user()->role_id == '1')
                <x-menu-link active="{{ $activeLink === '/settings' }}" link="{{ '/settings/company' }}">
                    <img src="{{ $activeLink === '/settings' ? asset('images/selected_settings.png') : asset('images/settings.png') }}"
                        alt="settings">
                </x-menu-link>
            @endif
        </div>
    </div>
</div>
