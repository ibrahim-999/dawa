@if ($paginator->hasPages())
    <ul class="pagination pagination-rounded justify-content-end mb-0">

        @if ($paginator->onFirstPage())
            <li class="page-item">
                <a class="page-link disabled" href="javascript: void(0);" aria-disabled="true"
                   aria-label="@lang('pagination.previous')">
                    <span aria-hidden="true">«</span>
                    <span class="sr-only">Previous</span>
                </a>
            </li>
        @else
            <li class="page-item ">
                <a class="page-link" href="{{ $paginator->previousPageUrl() }}"
                   aria-label="@lang('pagination.previous')">
                    <span aria-hidden="true">«</span>
                    <span class="sr-only">Previous</span>
                </a>
            </li>
        @endif
        @foreach ($elements as $element)
            @if (is_string($element))
                <li class="page-item disabled" aria-disabled="true">
                    <a class="page-link" href="{{ $url }}"><span>{{ $element }}</span></a>
                </li>
            @endif
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-item active" aria-current="page">
                            <a class="page-link" href="javascript: void(0);">{{ $page }}</a>
                        </li>

                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endif
                @endforeach
            @endif
        @endforeach
        @if ($paginator->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->nextPageUrl() }}" aria-label="@lang('pagination.next')">
                    <span aria-hidden="true">»</span>
                    <span class="sr-only">Next</span>
                </a>
            </li>
        @else
            <li class="page-item">
                <a class="page-link disabled" aria-disabled="true" href="javascript: void(0);"
                   aria-label="@lang('pagination.next')">
                    <span aria-hidden="true">»</span>
                    <span class="sr-only">Next</span>
                </a>
            </li>
        @endif
    </ul>
@endif
