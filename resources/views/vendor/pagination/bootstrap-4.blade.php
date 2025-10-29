@if ($paginator->hasPages())
    <nav class="flex justify-center">
        <ul class="pagination flex gap-[6px]">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled bg-slate-500 w-[40px] h-[40px] flex justify-center items-center rounded-full border-formtitle border" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span class="page-link " aria-hidden="true">&lsaquo;</span>
                </li>
            @else
                <li class="page-item w-[40px] h-[40px] flex justify-center items-center rounded-full border-formtitle border">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="page-item disabled w-[40px] h-[40px] flex justify-center items-center rounded-full border-formtitle border" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="text-white bg-pagelink page-item active w-[40px] h-[40px] flex justify-center items-center rounded-full border-formtitle border" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                        @elseif ($page == $paginator->currentPage() - 1 || $page == $paginator->currentPage() + 1)
                            <li class="page-item w-[40px] h-[40px] flex justify-center items-center rounded-full border-formtitle border"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item w-[40px] h-[40px] flex justify-center items-center rounded-full border-formtitle border">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
                </li>
            @else
                <li class="page-item disabled bg-slate-500 w-[40px] h-[40px] flex justify-center items-center rounded-full border-formtitle border" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span class="page-link" aria-hidden="true">&rsaquo;</span>
                </li>
            @endif
        </ul>
    </nav>
@endif
