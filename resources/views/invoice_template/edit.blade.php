<x-app-layout>
    <x-vertical-menu active-link="/invoice"></x-vertical-menu>
    @livewire('edit-invoice', ['initialInvoice' => $initialInvoice])
</x-app-layout>
