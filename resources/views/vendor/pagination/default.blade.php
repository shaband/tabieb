{{--
@if ($paginator->hasPages())
    <nav>
        <ul class="pagination">
            --}}
{{-- Previous Page Link --}}{{--

            @if ($paginator->onFirstPage())
                <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span aria-hidden="true">&lsaquo;</span>
                </li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
                </li>
            @endif

            --}}
{{-- Pagination Elements --}}{{--

            @foreach ($elements as $element)
                --}}
{{-- "Three Dots" Separator --}}{{--

                @if (is_string($element))
                    <li class="disabled" aria-disabled="true"><span>{{ $element }}</span></li>
                @endif

                --}}
{{-- Array Of Links --}}{{--

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="active" aria-current="page"><span>{{ $page }}</span></li>
                        @else
                            <li><a href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            --}}
{{-- Next Page Link --}}{{--

            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next"
                       aria-label="@lang('pagination.next')">&rsaquo;</a>
                </li>
            @else
                <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span aria-hidden="true">&rsaquo;</span>
                </li>
            @endif
        </ul>
    </nav>
@endif
--}}

@if ($paginator->hasPages())

    <!-- START Doctors Pages -->
    <div class="paging">
        <nav class="pt-5" aria-label="Page navigation example">

            @if ($paginator->onFirstPage())

                <ul class="pagination justify-content-center">
                    <li class="page-item active">
                        <a class="page-link" href="#" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Previous</span>
                        </a>
                    </li>
                    @else
                        <li class="page-item active">
                            <a class="page-link" {{ $paginator->previousPageUrl() }} aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                                <span class="sr-only">Previous</span>
                            </a>
                        </li>
                    @endif


                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))

                            <li class="page-item"><a class="page-link" href="#">{{$element}}</a></li>

                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <li class="active" aria-current="page"><span>{{ $page }}</span></li>

                                    <li class="page-item active"><a class="page-link">{{$page}}</a></li>

                                @else
                                    <li class="page-item"><a class="page-link" href="{{$url}}">{{$page}}</a></li>

                                @endif
                            @endforeach
                        @endif
                    @endforeach


                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>

                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <li>
                            <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
                        </li>

                        <li class="page-item">
                            <a class="page-link" href="{{ $paginator->nextPageUrl() }}" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                                <span class="sr-only">Next</span>
                            </a>
                        </li>

                    @else

                        <li class="page-item">
                            <a href="#" class="page-link" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                                <span class="sr-only">Next</span>
                            </a>
                        </li>
                    @endif

                </ul>
        </nav>
    </div>
    <!-- END Doctors Pages -->

@endif
