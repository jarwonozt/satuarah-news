@if ($paginator->hasPages())
    <div class="row">
            <div class="col-6">
                @if ($paginator->onFirstPage())
                        <a class="btn btn-sm btn-outline-secondary">Sebelumnya</a>
                @else
                        <a class="btn btn-sm btn-secondary" href="{{ $paginator->previousPageUrl() }}" rel="prev">Sebelumnya</a>
                @endif
            </div>
            <div class="col-6">
                @if ($paginator->hasMorePages())
                        <a class="btn btn-sm btn-primary" href="{{ $paginator->nextPageUrl() }}" rel="next">Lainnya</a>
                @else
                        <a class="btn btn-sm btn-outline-primary">Lainnya</a>
                @endif
            </div>
    </div>
@endif
