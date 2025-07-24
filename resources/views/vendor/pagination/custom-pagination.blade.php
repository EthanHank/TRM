@if ($paginator->hasPages())
    <nav class="d-flex justify-content-between align-items-center" role="navigation" aria-label="Pagination">
        <div class="text-muted small">
            {!! __('Showing') !!}
            <span class="fw-semibold">{{ $paginator->firstItem() }}</span>
            {!! __('to') !!}
            <span class="fw-semibold">{{ $paginator->lastItem() }}</span>
            {!! __('of') !!}
            <span class="fw-semibold">{{ $paginator->total() }}</span>
            {!! __('results') !!}
        </div>

        <div class="btn-group" role="group">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <button class="btn btn-outline-secondary" disabled>&laquo;</button>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="btn btn-outline-secondary" rel="prev">&laquo;</a>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <button class="btn btn-outline-secondary" disabled>{{ $element }}</button>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <button class="btn btn-primary" aria-current="page">{{ $page }}</button>
                        @else
                            <a href="{{ $url }}" class="btn btn-outline-primary">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="btn btn-outline-secondary" rel="next">&raquo;</a>
            @else
                <button class="btn btn-outline-secondary" disabled>&raquo;</button>
            @endif
        </div>
    </nav>
@endif 