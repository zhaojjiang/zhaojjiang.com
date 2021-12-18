<div class="pagination">
    @if($models->isNotEmpty())
        <nav aria-label="Pagination">
            <ul class="pagination">
                <li class="page-item @if($models->currentPage() === 1) disabled @endif">
                    <a class="page-link" href="{{ $models->url(1) }}" aria-label="First">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>


                <li class="page-item @if($models->currentPage() === 1) disabled @endif">
                    <a class="page-link" href="{{ $models->previousPageUrl() }}" aria-label="Previous">
                        <span aria-hidden="true">&lsaquo;</span>
                    </a>
                </li>


                @foreach($models->getUrlRange(1, $models->lastPage()) as $page_url)
                    <li class="page-item"><a class="page-link" href="{{ $page_url }}">{{ $loop->iteration }}</a></li>
                @endforeach

                <li class="page-item @if(!$models->hasMorePages()) disabled @endif">
                    <a class="page-link" href="{{ $models->nextPageUrl() }}" aria-label="Next">
                        <span aria-hidden="true">&rsaquo;</span>
                    </a>
                </li>

                <li class="page-item @if(!$models->hasMorePages()) disabled @endif">
                    <a class="page-link" href="{{ $models->url($models->lastPage()) }}" aria-label="Last">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    @endif
</div>
