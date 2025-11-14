@php
    function suffix($i)
    {
        if ($i == 1 || $i == 21 || $i == 31) {
            return 'st';
        } elseif ($i == 2 || $i == 22) {
            return 'nd';
        } elseif ($i == 3 || $i == 23) {
            return 'rd';
        } else {
            return 'th';
        }
    }
@endphp


<div>
    <p class="mt-[49px] ml-[51px] text-[20px] height-[15px] text-formtitle font-inter">Priority Settings</p>
    <p class="mt-[78px] ml-[100px] text-[20px] height-[15px] text-formtitle font-inter">Default Due Date</p>
    <div class="mt-[47px] ml-[134px] text-[20px] height-[15px] text-formtitle font-inter flex gap-[35px] items-center">
        Due on the
        <x-select-input :values="$dueDays" defaultValue="{{ $dueDays->first() }}" id="defaultDueDate" label="" width="200px"></x-select-input>
        of each month
    </div>
    <p class="mt-[78px] ml-[100px] text-[20px] height-[15px] text-formtitle font-inter">Attention Window</p>
    <div class="mt-[47px] ml-[134px] text-[20px] height-[15px] text-formtitle font-inter flex gap-[35px] items-center">
        Flag invoices for attention
        <x-select-input :values="$invoicesForAttention" defaultValue="{{ $invoicesForAttention->first() }}" id="defaultInvoicesForAttention" label="" width="200px"></x-select-input>
        before due date
    </div>
    <div></div>
</div>
