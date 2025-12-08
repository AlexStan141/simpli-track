<x-app-layout>
    <x-vertical-menu active-link="/dashboard"></x-vertical-menu>
    @if ($generated)
        <p class="mt-4 ml-4 p-2 bg-green-300 relative top-[125px] left-[150px]">{{ $message }}</p>
    @else
        <p class="mt-4 ml-4 p-2 bg-red-300 relative top-[125px] left-[150px]">{{ $message }}</p>
    @endif
</x-app-layout>
