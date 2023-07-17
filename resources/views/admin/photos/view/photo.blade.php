@php
    $data = \App\Models\Photo::find($row->id);
@endphp
<div class="d-flex align-items-center avatar-group my-3">
    <div class="avatar" title="{!! $data->caption !!}" data-bs-toggle="tooltip" data-bs-placement="bottom">
        <a data-fancybox="gallery-a" data-fancybox data-type="image" href="{{ $data->imagePath }}" data-caption="{{ $data->caption }}">
            <img src="{{ $data->imagePath }}" alt="Avatar" class="rounded-circle" />
        </a>
    </div>
    @foreach (\App\Models\PhotoLinkage::where('photo_id', $data->id)->orderBy('created_at')->limit(4)->get() as $key => $item)
    <div class="avatar" title="{!! $item->caption !!}" data-bs-toggle="tooltip" data-bs-placement="bottom">
        <a data-fancybox="gallery-a" data-fancybox data-type="image" href="{{ $item->imagePath }}" data-caption="{{ $item->caption }}">
            <img src="{{ $item->imagePath }}" alt="Avatar" class="rounded-circle" />
        </a>
    </div>
    @endforeach
    <div class="avatar" data-bs-placement="bottom">
        <a href="{{ route('photolinkages.edit', $data->id) }}">
            <img src="{{ asset('app-assets') }}/img/icons/plus.png" alt="Avatar" class="rounded-circle" />
        </a>
    </div>
</div>
