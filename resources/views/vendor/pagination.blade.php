@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination" class="flex items-center justify-between">
        <div class="flex justify-between flex-1 sm:hidden">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <span class="disabled" aria-disabled="true">
                    &lsaquo;
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev">
                    &lsaquo;
                </a>
            @endif

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" rel="next">
                    &rsaquo;
                </a>
            @else
                <span class="disabled" aria-disabled="true">
                    &rsaquo;
                </span>
            @endif
        </div>

        <div class="hidden sm:flex-1 sm:flex sm:justify-center">
            {{-- Pagination Elements --}}
            <ul class="inline-flex space-x-1">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <li>
                        <span class="disabled" aria-disabled="true">
                            &lsaquo;
                        </span>
                    </li>
                @else
                    <li>
                        <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="px-2 py-1 text-sm">
                            &lsaquo;
                        </a>
                    </li>
                @endif

                {{-- Pagination Numbers --}}
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <li>
                            <span class="disabled" aria-disabled="true">{{ $element }}</span>
                        </li>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li>
                                    <span class="px-2 py-1 text-sm font-bold">{{ $page }}</span>
                                </li>
                            @else
                                <li>
                                    <a href="{{ $url }}" class="px-2 py-1 text-sm">{{ $page }}</a>
                                </li>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <li>
                        <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="px-2 py-1 text-sm">
                            &rsaquo;
                        </a>
                    </li>
                @else
                    <li>
                        <span class="disabled" aria-disabled="true">
                            &rsaquo;
                        </span>
                    </li>
                @endif
            </ul>
        </div>
    </nav>
@endif
