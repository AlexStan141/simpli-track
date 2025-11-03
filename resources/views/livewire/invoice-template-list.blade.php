<div class="pl-[52px] pr-[28px] pt-[64px] grow">
    <p class="text-xl leading-none h-[15px] font-semibold">Invoice Templates</p>
    <hr class="mt-[16px] w-[100%]">
    </hr>
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
                <tr class="bg-formgray w-full block h-[56px] border">
                    <th class="w-[62px]"></th>
                    <th class="w-[178px]">Category</th>
                    <th class="w-[200px]">Location</th>
                    <th class="w-[184px]">Frequency</th>
                    <th class="w-[225px]">Due Date</th>
                    <th class="w-[152px]">Amount</th>
                    <th class="w-[200px]">LeaseNo#</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($user_invoices as $user_invoice)
                    <tr class= "w-full block h-[56px] border">
                        <td class="w-[62px]"></td>
                        <td class="w-[178px]">{{ $user_invoice->category->name }}</td>
                        <td class="w-[200px]">{{ $user_invoice->landlord->name }}</td>
                        <td class="w-[184px]">{{ $user_invoice->frequency }}</td>
                        <td class="w-[225px]">{{ $user_invoice->due_day->day }} of each month </td>
                        <td class="w-[152px]">{{ $user_invoice->amount }}</td>
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
