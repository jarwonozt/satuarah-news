{{-- <div class="avatar-group text-center">
    <a href="#">
        @php
        $user_type = explode(',', $row->user_type);
        @endphp
        @foreach ($user_type as $type)
        <div data-toggle="tooltip" data-popup="tooltip-custom" data-placement="top" title="" class="avatar pull-up my-0"
            data-original-title="{!! config('app.user_type')[$type] !!}">
            <img src="https://ui-avatars.com/api/?name={{urlencode($type) }}&color=ffffff&background=005599"
                alt="Avatar" height="32" width="32" />
        </div>
        @endforeach
    </a>
</div> --}}
<div class="d-flex align-items-center avatar-group my-3">
    @php
    $user_type = explode(',', $row->user_type);
    @endphp
    @foreach ($user_type as $type)
    <div class="avatar" title="{!! config('app.user_type')[$type] !!}" data-bs-toggle="tooltip"
        data-bs-placement="bottom">
        <img src="https://ui-avatars.com/api/?name={{urlencode($type) }}&color=ffffff&background=005599" alt="Avatar"
            class="rounded-circle" />
    </div>
    @endforeach
</div>