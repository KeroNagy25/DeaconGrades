@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex flex-wrap justify-center gap-2 mt-6">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="px-3 py-1 sm:px-4 sm:py-2 bg-gray-200 text-gray-500 rounded-md cursor-not-allowed text-sm sm:text-base">
                &laquo;
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" 
               class="px-3 py-1 sm:px-4 sm:py-2 bg-white border border-gray-300 rounded-md transition hover:bg-[#420707] hover:text-white text-sm sm:text-base">
                &laquo;
            </a>
        @endif

        {{-- Pagination Elements with ellipsis --}}
        @php
            $start = max($paginator->currentPage() - 1, 1);
            $end = min($paginator->currentPage() + 1, $paginator->lastPage());
        @endphp

        {{-- First Page --}}
        @if($start > 1)
            <a href="{{ $paginator->url(1) }}" 
               class="px-3 py-1 sm:px-4 sm:py-2 bg-white border border-gray-300 rounded-md transition hover:bg-[#420707] hover:text-white text-sm sm:text-base">
                1
            </a>
            @if($start > 2)
                <span class="px-3 py-1 sm:px-4 sm:py-2 bg-gray-200 text-gray-500 rounded-md text-sm sm:text-base">...</span>
            @endif
        @endif

        {{-- Middle Pages --}}
        @for ($i = $start; $i <= $end; $i++)
            @if ($i == $paginator->currentPage())
                <span class="px-3 py-1 sm:px-4 sm:py-2 bg-[#420707] text-white rounded-md text-sm sm:text-base">{{ $i }}</span>
            @else
                <a href="{{ $paginator->url($i) }}" 
                   class="px-3 py-1 sm:px-4 sm:py-2 bg-white border border-gray-300 rounded-md transition hover:bg-[#420707] hover:text-white text-sm sm:text-base">
                    {{ $i }}
                </a>
            @endif
        @endfor

        {{-- Last Page --}}
        @if($end < $paginator->lastPage())
            @if($end < $paginator->lastPage() - 1)
                <span class="px-3 py-1 sm:px-4 sm:py-2 bg-gray-200 text-gray-500 rounded-md text-sm sm:text-base">...</span>
            @endif
            <a href="{{ $paginator->url($paginator->lastPage()) }}" 
               class="px-3 py-1 sm:px-4 sm:py-2 bg-white border border-gray-300 rounded-md transition hover:bg-[#420707] hover:text-white text-sm sm:text-base">
                {{ $paginator->lastPage() }}
            </a>
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" 
               class="px-3 py-1 sm:px-4 sm:py-2 bg-white border border-gray-300 rounded-md transition hover:bg-[#420707] hover:text-white text-sm sm:text-base">
                &raquo;
            </a>
        @else
            <span class="px-3 py-1 sm:px-4 sm:py-2 bg-gray-200 text-gray-500 rounded-md cursor-not-allowed text-sm sm:text-base">
                &raquo;
            </span>
        @endif
    </nav>
@endif
