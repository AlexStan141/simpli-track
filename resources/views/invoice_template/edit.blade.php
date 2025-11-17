<x-app-layout>
    <x-vertical-menu active-link="/invoices"></x-vertical-menu>
    @livewire('edit-invoice', ['initialInvoice' => $initialInvoice])
</x-app-layout>
