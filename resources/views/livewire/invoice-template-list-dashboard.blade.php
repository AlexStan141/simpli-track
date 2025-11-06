@php
    use App\Helpers\DateHelpers;
@endphp

<div>
    @if (count($user_invoices) == 0)
        <p>No user invoices for this moment.</p>
    @else
        <table class="w-full invoice-templates mb-[44px]">
            <thead>
                <tr class="bg-formgray w-full h-[56px] border">
                    <th class="w-[62px]"></th>
                    <th class="w-[196px]">
                        <div class="flex justify-between">
                            Location
                            <a href="#" wire:click.prevent="sort('location.name')">
                                <img src="{{ asset('/images/sort.svg') }}" alt="sort">
                            </a>
                        </div>
                    </th>
                    <th class="w-[200px]">
                        <div class="flex justify-between">
                            Status
                            <a href="#" wire:click.prevent="sort('status.name')">
                                <img src="{{ asset('/images/sort.svg') }}" alt="sort">
                            </a>
                        </div>
                    </th>
                    <th class="w-[225px]">
                        <div class="flex justify-between">
                            Due Date
                            <a href="#" wire:click.prevent="sort('due_day.day')">
                                <img src="{{ asset('/images/sort.svg') }}" alt="sort">
                            </a>
                        </div>
                    </th>
                    <th class="w-[171px]">
                        <div class="flex justify-between">
                            Notes
                        </div>
                    </th>
                    <th class="w-[205px]">
                        <div class="flex justify-between">
                            Assignee
                            <a href="#" wire:click.prevent="sort('user.name')">
                                <img src="{{ asset('/images/sort.svg') }}" alt="sort">
                            </a>
                        </div>
                    </th>
                    <th class="w-[200px]">
                        <div class="flex justify-between">
                            Last Updated
                            <a href="#" wire:click.prevent="sort('updated_at')">
                                <img src="{{ asset('/images/sort.svg') }}" alt="sort">
                            </a>
                        </div>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($user_invoices as $user_invoice)
                    <tr class= "h-[56px] border">
                        <td class="w-[62px]">
                            <div class="flex justify-center items-center">
                                <img src="{{ asset('/images/removeInvoice.png') }}" alt="remove invoice">
                            </div>
                        </td>
                        <td class="w-[196px]">{{ $user_invoice->city->name }}</td>
                        <td class="w-[200px]">{{ $user_invoice->status->name }}</td>
                        <td class="w-[225px]">
                            {{ DateHelpers::getDueDayFieldValue($user_invoice->last_time_paid, $user_invoice->due_day->day, $user_invoice->invoice_for_attention_id) }}
                        </td>
                        <td class="w-[171px]">
                            <div class="flex gap-2">
                                <img src="{{ asset('/images/social.png') }}" alt="notes">
                                <span>call</span>
                            </div>
                        </td>
                        <td class="w-[205px]">
                            {{ $user_invoice->user->first_name . ' ' . $user_invoice->user->last_name }}</td>
                        <td class="w-[200px]">{{ $user_invoice->updated_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <nav class="pagination">
            {{ $user_invoices->onEachSide(1)->links('vendor.pagination.bootstrap-4') }}
        </nav>
    @endif
</div>
