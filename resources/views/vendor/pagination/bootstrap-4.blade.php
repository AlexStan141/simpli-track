@if ($paginator->hasPages())
    <nav class="flex justify-center">
        <ul class="pagination flex gap-[6px]">
            {{-- First Page Link --}}

            @if (!$paginator->onFirstPage())
                <x-page-link wire:click="gotoPage(1)" label-type="@lang('pagination.first')"
                    img-place="images/first.png"></x-page-link>
            @else
                <x-page-link label-type="@lang('pagination.first')" img-place="images/first.png"></x-page-link>
            @endif


            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <x-page-link label-type="@lang('pagination.previous')" img-place="images/prev.png"></x-page-link>
            @else
                <x-page-link wire:click="previousPage" label-type="@lang('pagination.previous')"
                    img-place="images/prev.png"></x-page-link>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="page-item disabled w-[40px] h-[40px] flex justify-center items-center rounded-full border-formtitle border"
                        aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <x-page-link wire:click="gotoPage({{ $page }})" current-page>{{ $page }}</x-page-link>
                        @elseif ($page == $paginator->currentPage() - 1 || $page == $paginator->currentPage() + 1)
                            <x-page-link wire:click="gotoPage({{ $page }})" >{{ $page }}</x-page-link>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if (!$paginator->hasMorePages())
                <x-page-link label-type="@lang('pagination.next')" img-place="images/next.png"></x-page-link>
            @else
                <x-page-link wire:click="nextPage" label-type="@lang('pagination.next')"
                    img-place="images/next.png"></x-page-link>
            @endif

            {{-- Last Page Link --}}
            @if (!$paginator->onLastPage())
                <x-page-link wire:click="gotoPage({{ $paginator->lastPage() }})" label-type="@lang('pagination.last')"
                    img-place="images/last.png"></x-page-link>
            @else
                <x-page-link label-type="@lang('pagination.last')" img-place="images/last.png"></x-page-link>
            @endif

        </ul>
    </nav>
@endif
