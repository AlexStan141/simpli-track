@php
    use App\Helpers\DateHelpers;
@endphp

<table class="w-full invoice-templates mb-[44px]">
    <thead>
        <tr class="bg-formgray w-full h-[56px] border">
            <th class="w-[62px]"></th>
            <th class="w-[178px]">
                <div class="flex justify-between">
                    Location
                    <a href="#">
                        <img src="{{ asset('/images/sort.svg') }}" alt="sort">
                    </a>
                </div>
            </th>
            <th>
                <div class="flex justify-between">
                    Status
                    <a href="#">
                        <img src="{{ asset('/images/sort.svg') }}" alt="sort">
                    </a>
                </div>
            </th>
            <th>
                <div class="flex justify-between">
                    Due Date
                    <a href="#">
                        <img src="{{ asset('/images/sort.svg') }}" alt="sort">
                    </a>
                </div>
            </th>
            <th>
                <div class="flex justify-between">
                    Notes
                    <a href="#">
                        <img src="{{ asset('/images/sort.svg') }}" alt="sort">
                    </a>
                </div>
            </th>
            <th>
                <div class="flex justify-between">
                    Assignee
                    <a href="#">
                        <img src="{{ asset('/images/sort.svg') }}" alt="sort">
                    </a>
                </div>
            </th>
            <th>
                <div class="flex justify-between">
                    Last Updated
                    <a href="#">
                        <img src="{{ asset('/images/sort.svg') }}" alt="sort">
                    </a>
                </div>
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($bills as $bill)
            <tr class= "h-[56px] border">
                <td class="w-[62px]">
                    <div class="flex justify-center items-center">
                        <a href="#">
                            <img src="{{ asset('/images/removeInvoice.png') }}" alt="remove invoice">
                        </a>
                    </div>
                </td>
                <td class="w-[178px]">{{ $bill->invoice_template->city->name }}</td>
                <td class="w-[200px]">{{ $bill->status->name }}</td>
                <td class="w-[200px]">
                    {{ DateHelpers::get_due_day_field_value($bill->invoice_template->due_day->day, (int) $bill->invoice_template->invoice_for_attention->period) }}
                </td>
                <td class="w-[184px]"></td>
                <td class="w-[200px]">
                    {{ $bill->invoice_template->user->first_name . ' ' . $bill->invoice_template->user->last_name }}
                </td>
                <td class="w-[184px]">{{ $bill->updated_at }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
