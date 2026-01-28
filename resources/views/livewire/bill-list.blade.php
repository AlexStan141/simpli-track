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
                            <a href="#" wire:click.prevent="sort('cities.name')">
                                <img src="{{ asset('/images/sort.svg') }}" alt="sort">
                            </a>
                        </div>
                    </th>
                    <th class="w-[200px]">
                        <div class="flex justify-between">
                            Status
                            <a href="#" wire:click.prevent="sort('statuses.name')">
                                <img src="{{ asset('/images/sort.svg') }}" alt="sort">
                            </a>
                        </div>
                    </th>
                    <th class="w-[225px]">
                        <div class="flex justify-between">
                            Due Date
                            <a href="#" wire:click.prevent="sort('due_days.id')">
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
                            <a href="#" wire:click.prevent="sort('users.first_name')">
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
                @foreach ($bills as $bill)
                    <tr class= "h-[56px] border">
                        <td class="w-[62px]">
                            <div class="flex justify-center items-center">
                                <a href="{{ route('bill.edit', ['bill_id' => $bill->id]) }}"
                                    wire:click.prevent="displayModal({{ $bill->id }})">
                                    <img src="{{ asset('/images/removeInvoice.png') }}" alt="remove invoice">
                                </a>
                            </div>
                        </td>
                        <td class="w-[196px]">
                            {{ ($bill->invoice_template && $bill->invoice_template->city) ? $bill->invoice_template->city->name : 'No location' }}</td>
                        <td class="w-[200px]">{{ $bill->status->name }}</td>
                        <td class="w-[225px]">
                            {{ $bill->invoice_template ? DateHelpers::get_due_day_field($bill->due_date, (int) $bill->invoice_template->invoice_for_attention->period) : 'No due day' }}
                        </td>
                        <td class="w-[171px] flex gap-2">
                            <img src="{{ $bill->note ? asset('images/selected_social.png') : asset('images/social.png') }}"
                                alt="call" wire:click="displayNoteModal({{ $bill->id }})">
                            <span>call</span>
                        </td>
                        <td class="w-[205px]">
                            {{ $bill->invoice_template ? $bill->invoice_template->user->first_name . ' ' . $bill->invoice_template->user->last_name : 'No user' }}
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
