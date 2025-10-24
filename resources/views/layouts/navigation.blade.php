<nav x-data="{ open: false }" class="border-b border-white py-[5px] bg-loginblue">
    <div class="max-w-auto">
        <div class="flex justify-between items-center">
            <div class="flex">
                <img src="{{ asset('images/Logo.png') }}" alt="logo" width="462" height="90">
            </div>
            <div class="flex gap-[12px] items-center">
                <div class="bg-yellow p-[8px] flex gap-[16px] text-white items-center">
                    <div class="w-[32px] h-[32px] flex justify-end">
                        <div class="w-[8px] h-[8px] bg-green-500 rounded-full"></div>
                    </div>
                    <div class="flex flex-col gap-[4px]">
                        <span>{{ Auth::user()->first_name . ' ' . substr(Auth::user()->last_name, 0, 1) }}</span>
                        <span>{{ Auth::user()->phone }}</span>
                    </div>
                </div>
                <div class="bg-red-500 w-[60px] h-[60px] rounded-full mr-[26px]"></div>
            </div>
        </div>
    </div>
</nav>
