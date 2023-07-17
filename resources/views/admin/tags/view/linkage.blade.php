<div class="avatar avatar-sm me-2">
    {{-- <a href="{{ route('postlinkages.show', $row->id) }}"> --}}
    <a href="#">
        <div class="avatar-initial rounded bg-label-secondary text-primary">
            <div class="avatar-content">
                {{ $row->countLinkage() }}
            </div>
        </div>
    </a>
</div>
