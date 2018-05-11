@if($paginator->hasPages())
    <ul class="pagination">
        @if ($paginator->onFirstPage())
            <li class="page-item disabled"><span class="page-link"><i class="fas fa-long-arrow-alt-left"></i></span></li>
        @elseif ($paginator->currentPage() == 2)
            <li class="page-item"><a class="page-link" href="{{ $prefix }}/" rel="prev"><i class="fas fa-long-arrow-alt-left"></i></a></li>
        @else
            <li class="page-item"><a class="page-link" href="{{ url("$prefix/page".($paginator->currentPage() - 1)) }}" rel="prev"><i class="fas fa-long-arrow-alt-left"></i></a></li>
        @endif
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="page-item disabled"><span class="page-link">{{ $element }}</span></li>
            @endif
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                    @elseif ($page == 1)
                        <li class="page-item"><a class="page-link" href="{{ $prefix }}/">{{ $page }}</a></li>
                    @else
                        <li class="page-item"><a class="page-link" href="{{ url("$prefix/page$page") }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach
        @if ($paginator->hasMorePages())
            <li class="page-item"><a class="page-link" href="{{ url("$prefix/page".($paginator->currentPage() + 1)) }}" rel="next"><i class="fas fa-long-arrow-alt-right"></i></a></li>
        @else
            <li class="page-item disabled"><span class="page-link"><i class="fas fa-long-arrow-alt-right"></i></span></li>
        @endif
    </ul>
@endif



