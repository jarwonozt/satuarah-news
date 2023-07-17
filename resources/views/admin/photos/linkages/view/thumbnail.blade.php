<div class="d-flex align-items-center avatar-group my-3">
    <div class="avatar" title="{!! $row->caption !!}" data-bs-toggle="tooltip" data-bs-placement="bottom">
        <a
            data-fancybox
            data-fancybox data-type="image"
            href="{{ $row->imagePath }}"
            data-caption="{{ $row->caption }}">
            <img src="{{ $row->imagePath }}" alt="Avatar" class="rounded-circle" />
        </a>
    </div>
</div>
