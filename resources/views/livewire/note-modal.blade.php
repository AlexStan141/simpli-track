<div>
    @if ($displayed)
        <div class="w-full h-full fixed bg-black/50 z-10 flex justify-center items-center">
            <div class="w-[50%] h-[50%] bg-white z-20 relative">
                <a href="{{ route('dashboard') }}">
                    <img src="{{ asset('/images/close.png') }}" class="absolute right-2 top-2" alt="close note" />
                </a>
                @if ($bill_message && $state === 'SHOW')
                    @livewire('note-display', ['bill_id' => $bill_id, 'bill_message' => $bill_message])
                @elseif($bill_message && $state === 'PUT')
                    @livewire('edit-note-form', ['bill_id' => $bill_id, 'bill_message' => $bill_message])
                @elseif($state === 'POST')
                    @livewire('add-note-form', ['bill_id' => $bill_id])
                @endif
            </div>
        </div>
    @endif
</div>
