@if ($attributes->has('wire:click'))
    <li @class([
        'page-item w-[40px] h-[40px] flex justify-center items-center rounded-full border-formtitle border',
        'bg-pagelink text-white' => $currentPage,
    ]) aria-label="@lang('pagination.first')">
        <a class="page-link w-full h-full flex justify-center items-center cursor-pointer" {{ $attributes->only('wire:click') }} aria-label="{{ $labelType }}">
            @if($imgPlace)
                <img src="{{ asset($imgPlace) }}" alt="first page">
            @else
                {{ $slot }}
            @endif
        </a>
    </li>
@else
    <li class="page-item disabled bg-slate-500 w-[40px] h-[40px] flex justify-center items-center rounded-full border-formtitle border"
        aria-disabled="true" aria-label="@lang('pagination.first')">
        <span class="page-link " aria-hidden="true">
            <img src="{{ asset($imgPlace) }}" alt="first page">
        </span>
    </li>
@endif
