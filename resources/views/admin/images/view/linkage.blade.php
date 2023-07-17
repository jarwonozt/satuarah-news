<div class="avatar avatar-sm me-2">
    {{-- <a href="{{ route('postlinkages.show', $row->id) }}"> --}}
    <a href="{{ route('postlinkages.show', $row->id) }}">
        <div class="avatar-initial rounded bg-label-secondary text-primary fw-bold">
            <div class="avatar-content">
                {{ $row->countLinkage() }}
            </div>
        </div>
    </a>
</div>
