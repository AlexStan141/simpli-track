<x-app-layout>
    <div class="w-[127px] bg-loginblue">
        <div class="mt-[91px] pl-[26px] pr-[21px] flex flex-col gap-[113px]">
            <div class="flex flex-col items-center gap-[5px]">
                <img src="{{ asset("images/dashboard.png") }}" alt="dashboard" width="24" height="24">
                <span class="text-[14px] leading-[14px] text-white">Dashboard</span>
            </div>
            <div class="flex flex-col items-center gap-[5px]">
                <img src="{{ asset("images/invoices.png") }}" alt="invoices" width="32" height="32">
            </div>
            <div class="flex flex-col items-center gap-[5px]">
                <img src="{{ asset("images/money.png") }}" alt="dashboard" width="24" height="24">
                <span class="text-[14px] leading-[14px] text-white">Alerts</span>
            </div>
        </div>
        <div class="mt-[208px] px-[27px] h-[609px]">
            <div class=" border-t-white border-t pt-[25px] items-center gap-[47px] h-[100%] flex flex-col">
                <img src="{{ asset("images/question.png") }}" alt="invoices" width="24" height="24">
                <img src="{{ asset("images/settings.png") }}" alt="invoices" width="24" height="24">
            </div>
        </div>
    </div>
    <div></div>
</x-app-layout>
