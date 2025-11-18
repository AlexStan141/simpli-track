<div class="pl-[52px] pr-[28px] pt-[64px] grow">
    <p class="text-xl leading-none h-[15px] font-semibold">Invoice Templates</p>
    <hr class="mt-[16px] w-[100%]">
    </hr>
    @if(session()->has('success'))
        <p class="bg-green-300 py-2 pl-2">{{ session("success") }}</p>
    @endif
    <a href="{{ route('invoice.create') }}">
        <img src="{{ asset('images/add_invoice.png') }}" alt="add_invoice" class="float-right mt-[10px] mr-[13px]" />
    </a>
    <div class="after:content-[''] after:block after:clear-both"></div>
    @if (session()->has('success'))
        <div>{{ session('success') }}</div>
    @endif
    @if (count($user_invoices) == 0)
        <p>No user invoices for this moment.</p>
    @else
        <table class="w-full invoice-templates mb-[44px]">
            <thead>
                <tr class="bg-formgray w-full h-[56px] border">
                    <th class="w-[62px]"></th>
                    <th class="w-[178px]">
                        <div class="flex justify-between">
                            Category
                            <a href="#" wire:click.prevent="sort('categories.name')">
                                <img src="{{ asset('/images/sort.svg') }}" alt="sort">
                            </a>
                        </div>
                    </th>
                    <th class="w-[200px]">
                        <div class="flex justify-between">
                            Location
                            <a href="#" wire:click.prevent="sort('cities.name')">
                                <img src="{{ asset('/images/sort.svg') }}" alt="sort">
                            </a>
                        </div>
                    </th>
                    <th class="w-[184px]">
                        <div class="flex justify-between">
                            Frequency
                            <a href="#" wire:click.prevent="sort('frequency')">
                                <img src="{{ asset('/images/sort.svg') }}" alt="sort">
                            </a>
                        </div>
                    </th>
                    <th class="w-[225px]">
                        <div class="flex justify-between">
                            Due Date
                            <a href="#" wire:click.prevent="sort('due_days.day')">
                                <img src="{{ asset('/images/sort.svg') }}" alt="sort">
                            </a>
                        </div>
                    </th>
                    @if ($showInvoiceAmount)
                        <th class="w-[152px]">
                            <div class="flex justify-between">
                                Amount
                                <a href="#" wire:click.prevent="sort('amount')">
                                    <img src="{{ asset('/images/sort.svg') }}" alt="sort">
                                </a>
                            </div>
                        </th>
                    @endif
                    <th class="w-[200px]">
                        <div class="flex justify-between">
                            LeaseNo#
                            <a href="#" wire:click.prevent="sort('lease_no')">
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
                                <a href="{{ route('invoice.edit', ['initialInvoice' => $user_invoice]) }}">
                                     <img src="{{ asset('/images/removeInvoice.png') }}" alt="remove invoice">
                                </a>
                            </div>
                        </td>
                        <td class="w-[178px]">{{ $user_invoice->category->name }}</td>
                        <td class="w-[200px]">{{ $user_invoice->city->name }}</td>
                        <td class="w-[184px]">{{ $user_invoice->frequency }}</td>
                        <td class="w-[225px]">{{ $user_invoice->due_day->day }} of each month </td>
                        @if ($showInvoiceAmount)
                            <td class="w-[152px]">{{ $user_invoice->amount }}</td>
                        @endif
                        <td class="w-[200px]">{{ $user_invoice->lease_no }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <nav class="pagination">
            {{ $user_invoices->onEachSide(1)->links('vendor.pagination.bootstrap-4') }}
        </nav>
    @endif
</div>
