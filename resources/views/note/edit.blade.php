<x-app-layout>
    <x-vertical-menu active-link="/dashboard"></x-vertical-menu>
    <div>
        @livewire('note-modal', ['bill_id' => $bill_id, 'bill_message' => $bill_message, 'state' => $state])
        @livewire('bill-list')
    </div>
</x-app-layout>
