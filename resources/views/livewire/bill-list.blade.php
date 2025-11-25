@php
    use App\Helpers\DateHelpers;
@endphp


<div>
    @if (count($bills) == 0)
        <p>No bills for this moment</p>
    @else
        <table class="w-full invoice-templates mb-[44px]">
            <thead>
                <tr class="bg-formgray w-full h-[56px] border">
                    <th class="w-[62px]"></th>
                    <th class="w-[196px]">
                        <div class="flex justify-between">
                            Location
                            <a href="#">
                                <img src="{{ asset('/images/sort.svg') }}" alt="sort">
                            </a>
                        </div>
                    </th>
                    <th class="w-[200px]">
                        <div class="flex justify-between">
                            Status
                            <a href="#">
                                <img src="{{ asset('/images/sort.svg') }}" alt="sort">
                            </a>
                        </div>
                    </th>
                    <th class="w-[225px]">
                        <div class="flex justify-between">
                            Due Date
                            <a href="#">
                                <img src="{{ asset('/images/sort.svg') }}" alt="sort">
                            </a>
                        </div>
                    </th>
                    <th class="w-[171px]">
                        <div class="flex justify-between">
                            Notes
                            <a href="#">
                                <img src="{{ asset('/images/sort.svg') }}" alt="sort">
                            </a>
                        </div>
                    </th>
                    <th class="w-[205px]">
                        <div class="flex justify-between">
                            Assignee
                            <a href="#">
                                <img src="{{ asset('/images/sort.svg') }}" alt="sort">
                            </a>
                        </div>
                    </th>
                    <th class="w-[200px]">
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
                        <td class="w-[196px]">{{ $bill->invoice_template->city->name }}</td>
                        <td class="w-[200px]">{{ $bill->status->name }}</td>
                        <td class="w-[225px]">
                            {{ DateHelpers::get_due_day_field_value($bill->invoice_template->due_day->day, (int) $bill->invoice_template->invoice_for_attention->period) }}
                        </td>
                        <td class="w-[171px] flex gap-2" >
                            <a href="{{ route('note.create') }}">
                                <img src="{{ asset('images/social.png') }}" alt="call">
                            </a>
                            <span>call</span>
                        </td>
                        <td class="w-[205px]">
                            {{ $bill->invoice_template->user->first_name . ' ' . $bill->invoice_template->user->last_name }}
                        </td>
                        <td class="w-[200px]">{{ $bill->updated_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <nav class="pagination">
            {{ $bills->onEachSide(1)->links('vendor.pagination.bootstrap-4') }}
        </nav>
    @endif
</div>
