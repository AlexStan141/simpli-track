<x-app-layout>
    <x-vertical-menu active-link="/dashboard"></x-vertical-menu>
    @if ($generated)
        <p class="mt-4 ml-4 p-2 bg-green-300">{{ $message }}</p>
    @else
        <p class="mt-4 ml-4 p-2 bg-red-300">{{ $message }}</p>
    @endif
</x-app-layout>
