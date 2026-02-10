@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination" class="flex flex-wrap items-center justify-between gap-3">
        <div class="text-xs text-gray-500">
            Pagina {{ $paginator->currentPage() }} van {{ $paginator->lastPage() }}
        </div>

        <div class="flex flex-wrap items-center gap-2">
            @if ($paginator->onFirstPage())
                <span class="inline-flex items-center rounded-full border border-gray-200 bg-gray-100 px-3 py-1 text-xs font-semibold text-gray-400">
                    Vorige
                </span>
            @else
                <a
                    href="{{ $paginator->previousPageUrl() }}"
                    rel="prev"
                    class="inline-flex items-center rounded-full border border-gray-200 bg-white px-3 py-1 text-xs font-semibold text-gray-700 transition hover:border-gray-300 hover:bg-gray-50"
                >
                    Vorige
                </a>
            @endif

            @foreach ($elements as $element)
                @if (is_string($element))
                    <span class="px-2 text-xs text-gray-400">{{ $element }}</span>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span
                                aria-current="page"
                                class="inline-flex h-8 w-8 items-center justify-center rounded-full border border-gray-900 bg-gray-900 text-xs font-semibold text-white"
                            >
                                {{ $page }}
                            </span>
                        @else
                            <a
                                href="{{ $url }}"
                                class="inline-flex h-8 w-8 items-center justify-center rounded-full border border-gray-200 bg-white text-xs font-semibold text-gray-700 transition hover:border-gray-300 hover:bg-gray-50"
                            >
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            @if ($paginator->hasMorePages())
                <a
                    href="{{ $paginator->nextPageUrl() }}"
                    rel="next"
                    class="inline-flex items-center rounded-full border border-gray-200 bg-white px-3 py-1 text-xs font-semibold text-gray-700 transition hover:border-gray-300 hover:bg-gray-50"
                >
                    Volgende
                </a>
            @else
                <span class="inline-flex items-center rounded-full border border-gray-200 bg-gray-100 px-3 py-1 text-xs font-semibold text-gray-400">
                    Volgende
                </span>
            @endif
        </div>
    </nav>
@endif
