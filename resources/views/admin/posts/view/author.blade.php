<div class="d-flex align-items-center avatar-group my-3">
    @foreach ($row->getAuthor($row->id) as $item)
    <div class="avatar" title="{!! $item['type'].': '.$item['name'] !!}" data-bs-toggle="tooltip" data-bs-placement="bottom">
        <img src="{{ $item['avatar'] }}" alt="Avatar"
            class="rounded-circle" />
    </div>
    @endforeach 
</div>
