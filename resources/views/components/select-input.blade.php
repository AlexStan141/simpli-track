<div class="flex flex-col items-start justify-center">
    @if ($label)
        <label for="{{ $id }}"
            class="leading-[14px] h-[12px] font-inter text-editprofilelabel">{{ $label }}</label>
    @endif

    <div {{ $attributes->class(['relative', $withoutMargin ? '' : 'mt-4']) }}>
        <select id="{{ $id }}" name="{{ $id }}" class="w-full appearance-none bg-none rounded-[32px] border border-inputbordercolor h-[44px]" {{ $attributes }}>
            @forelse ($values as $key => $optionLabel)
                <option value="{{ $key }}"
                    class="text-[15px] leading-[22px] h-[22px]">
                    {{ $optionLabel }}
                </option>
            @empty
                <option value="">Nicio opțiune disponibilă</option>
            @endforelse
        </select>
        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center text-gray-500">
            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="7" viewBox="0 0 12 7" class="mr-[21px]">
                <path d="M0.650024 0.649902L5.65002 5.6499L10.65 0.649902" stroke="#1E1E1E" stroke-width="1.3"
                    stroke-linecap="round" stroke-linejoin="round" fill="none" />
            </svg>
        </div>
    </div>
</div>
