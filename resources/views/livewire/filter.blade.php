<div class="relative">
    <select name="{{ $type }}" id="{{ $type }}"
        class="pt-2 pl-7 pr-[21px] w-[250px] rounded-[32px] border-inputbordercolor appearance-none bg-none">
        @foreach ($values as $value)
            <option value="{{ $value }}" class="text-manrope text-[15px] leading-[22px] h-[22px]">
                {{ $type . '(' . $value . ')' }}</option>
        @endforeach
    </select>
    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-500">
        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="7" viewBox="0 0 12 7" class="mr-[21px]">
            <path d="M0.650024 0.649902L5.65002 5.6499L10.65 0.649902" stroke="#1E1E1E" stroke-width="1.3"
                stroke-linecap="round" stroke-linejoin="round" fill="none" />
        </svg>
    </div>
</div>
