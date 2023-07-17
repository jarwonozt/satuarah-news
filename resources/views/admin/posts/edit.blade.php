<x-master-layout>
    @section('title')
    @lang('admin.post.edit')
    @endsection
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <h5 class="fw-bold py-3 mb-2"><span class="text-muted fw-light">Dashboard / <a href="{{ route('posts.index') }}">@lang('admin.post.title')</a> /</span> @lang('admin.post.edit')</h5>

                <form class="form" method="POST" enctype="multipart/form-data" action="{{ route('posts.update', $data->id) }}">
                    @method('PUT')
                    @csrf
                    <div class="row justify-content-start">
                        <div class="col-12 col-md-8 col-xl-8">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label class="form-label text-primary fw-bold"
                                            for="basic-default">@lang('admin.form.publish_date')</label>
                                        <input type="text" name="published_at" class="form-control flatpickr-date-time" placeholder="YYYY-MM-DD HH:MM" value="{{ $data->published_at ?? now() }}" />
                                        @if ($errors->has('published_at'))<span class="text-danger">{{$errors->first('published_at')}}</span>@endif
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label text-primary fw-bold text-uppercase" for="basic-default">prefix </label><span class="text-danger">(opsional)</span>
                                        <input id="prefix" name="prefix" type="prefix" class="form-control"
                                            placeholder="prefix @lang('admin.post.title')" value="{{ $data->prefix }}" />
                                        @if ($errors->has('prefix'))<span
                                            class="text-danger">{{$errors->first('prefix')}}</span>@endif
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label text-primary fw-bold text-uppercase"
                                            for="basic-default">@lang('admin.form.title') </label></span>
                                        <input id="title" name="title" type="text" class="form-control"
                                            placeholder="@lang('admin.form.title') @lang('admin.post.title')"
                                            value="{{ $data->title }}" required />
                                        @if ($errors->has('title'))<span
                                            class="text-danger">{{$errors->first('title')}}</span>@endif
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label text-primary fw-bold text-uppercase"
                                            for="basic-default">slug</label></span>
                                        <div class="alert alert-primary" role="alert">
                                            <div class="alert-body"><strong id="text-slug"> {{ $data->slug }}</strong>
                                            </div>
                                        </div>
                                        <span id="input-slug" style="display:none;">
                                            <input name="slug" type="text" id="slug" class="form-control mb-1"
                                                value="{{ $data->slug }}" />
                                            <button type="button" class="btn btn-primary btn-xs"
                                                id="simpan_slug">OK</button>
                                            <button type="button" class="btn btn-secondary btn-xs"
                                                id="close_slug">Cancel</button>
                                        </span>
                                        @if ($errors->has('slug'))<span
                                            class="text-danger">{{$errors->first('slug')}}</span>@endif
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label text-primary fw-bold text-uppercase" for="basic-default">@lang('admin.form.category')</label>
                                        <select name="category_id" id="selectpickerBasic" class="selectpicker w-100" data-style="btn-default" required>
                                            <option value="">-- PILIH --</option>
                                            @foreach ($categories as $item)
                                            <option value="{{ $item->id }}" {{ $item->id == $data->category_id ? 'selected' : '' }}>{{ strtoupper($item->name) }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('roles'))
                                        <span class="text-danger">
                                            {{ $errors->first('roles') }}
                                        </span>
                                        @endif
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label text-primary fw-bold text-uppercase"
                                            for="basic-default">preview</label></span>
                                        <textarea name="preview" id="preview"
                                            class="form-control">{{ $data->preview }}</textarea>
                                        @if ($errors->has('preview'))<span class="text-danger">Preview Wajib
                                            Isi!!!</span>@endif
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label text-primary fw-bold text-uppercase"
                                            for="basic-default">content</label></span>
                                        <textarea name="content" id="content"
                                            class="form-control">{{ $data->content }}</textarea>
                                        @if ($errors->has('content'))<span class="text-danger">Content Wajib
                                            Isi!!!</span>@endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 col-xl-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label class="form-label text-primary fw-bold" for="basic-default">IMAGE</label>
                                        <div class="form-group mb-2">
                                            <div class="media flex-column text-center">
                                                <div class="media-body mt-1 w-100">
                                                    <div class="d-inline-block">
                                                        <div class="form-group mb-0">
                                                            <div class="custom-file mb-1">
                                                                <input name="image" type="file"
                                                                    class="custom-file-input" id="image-crop"
                                                                    accept="image/*" />
                                                                @if ($errors->has('image'))<span
                                                                    class="text-danger">{{$errors->first('image')}}</span>@endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="hidden" name="16_9_width" id="16_9_width" />
                                            <input type="hidden" name="16_9_height" id="16_9_height" />
                                            <input type="hidden" name="16_9_x" id="16_9_x" />
                                            <input type="hidden" name="16_9_y" id="16_9_y" />

                                            <input type="hidden" name="4_3_width" id="4_3_width" />
                                            <input type="hidden" name="4_3_height" id="4_3_height" />
                                            <input type="hidden" name="4_3_x" id="4_3_x" />
                                            <input type="hidden" name="4_3_y" id="4_3_y" />

                                            <input type="hidden" name="1_1_width" id="1_1_width" />
                                            <input type="hidden" name="1_1_height" id="1_1_height" />
                                            <input type="hidden" name="1_1_x" id="1_1_x" />
                                            <input type="hidden" name="1_1_y" id="1_1_y" />
                                        </div>
                                    </div>
                                    <div class="mb-3 mt-2">
                                        <label class="form-label text-primary fw-bold text-uppercase"
                                            for="basic-default">caption</label></span>
                                        <textarea name="caption" class="form-control" rows="2"
                                            placeholder="Caption Image">{{ $data->caption }}</textarea>
                                        @if ($errors->has('caption'))<span
                                            class="text-danger">{{$errors->first('caption')}}</span>@endif
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label text-primary fw-bold text-uppercase"
                                            for="basic-default">Authors</label></span>
                                        @foreach($authors as $k=>$v)
                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                            <label for="{{$k}}">{{$v['name']}}</label>
                                            <select name="author[{{$k}}]" class="form-control form-control-sm" style="width: 65%" @if($k=='e' ) @endif>
                                                <option value="">Pilih {{$v['name']}}</option>
                                                @foreach($v['data'] as $a=>$b)
                                                <option op="{{$k}}" value="{{$b['id']}}" {{ ($b['id']==$v['id'] ? 'selected' : '' ) }}>{{$b['name']}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @endforeach
                                    </div>
                                    <div class="mb-3 mt-2">
                                        <label class="form-label text-primary fw-bold text-uppercase" for="basic-default">@lang('admin.tag.title') <a href="" class="badge bg-primary" data-bs-toggle="modal" data-bs-target="#create-tags"><i class="fa fa-plus"></i></a></label></span>
                                        <select class="select2 form-control" name="tags[]" multiple>
                                            <optgroup label="Tags">
                                                @foreach ($tagsCurrent as $tagc)
                                                    <option value="{{ $tagc->slug }}" selected>{{ $tagc->title }}</option>
                                                @endforeach
                                                @foreach ($tags as $tag)
                                                    <option value="{{ $tag->slug }}">{{ $tag->title }}</option>
                                                @endforeach
                                            </optgroup>
                                        </select>
                                        {{-- <input name="tags" type="text" class="form-control" placeholder="tags1, tags2"
                                            value="{{ $data->caption }}" /> --}}
                                        @if ($errors->has('tags'))<span
                                            class="text-danger">{{$errors->first('tags')}}</span>@endif
                                    </div>
                                    <div class="mb-3 mt-2">
                                        <label class="form-label text-primary fw-bold text-uppercase"
                                            for="basic-default">type</label></span>
                                        <div class="d-flex flex-row">
                                            <div class="custom-control custom-radio">
                                                <input name="type" type="radio" id="customRadio2" class="form-check-input" value="1" {{ $data->type == 1 ? 'checked' : '' }} />
                                                <label class="custom-control-label" for="customRadio2">NORMAL</label>
                                            </div>
                                            <div class="custom-control custom-radio ms-2">
                                                <input name="type" type="radio" id="customRadio3" class="form-check-input" value="2" {{ $data->type == 2 ? 'checked' : '' }}/>
                                                <label class="custom-control-label" for="customRadio3">SLIDE/HEADLINE</label>
                                            </div>
                                        </div>
                                        @if ($errors->has('type'))<span class="text-danger">{{$errors->first('type')}}</span>@endif
                                    </div>
                                    <div class="mb-3 mt-2">
                                        <label class="form-label text-primary fw-bold text-uppercase" for="basic-default">status</label></span>
                                        <div class="d-flex flex-row">
                                            <div class="custom-control custom-radio">
                                                <input name="status" type="radio" id="customRadio4" class="form-check-input" value="1" {{ $data->status == 1 ? 'checked' : '' }} />
                                                <label class="custom-control-label" for="customRadio4">Terbit</label>
                                            </div>
                                            <div class="custom-control custom-radio ms-2">
                                                <input name="status" type="radio" id="customRadio5" class="form-check-input" value="0" {{ $data->status == 0 ? 'checked' : '' }}/>
                                                <label class="custom-control-label" for="customRadio5">Tidak</label>
                                            </div>
                                        </div>
                                        @if ($errors->has('status'))<span class="text-danger">{{$errors->first('status')}}</span>@endif
                                    </div>
                                </div>
                            </div>
                            <div class="card mt-2">
                                <div class="card-body">
                                    <button type="submit"
                                        class="btn btn-primary text-uppercase">@lang('admin.save')</button>
                                    <a href="{{ route('posts.index') }}"
                                        class="btn btn-secondary text-uppercase">@lang('admin.cancel')</a>
                                </div>
                            </div>

                        </div>
                    </div>
                </form>
        </div>

        @include('admin.navigation.footer')

        <div class="content-backdrop fade"></div>
    </div>

    @push('styles')
    <link rel="stylesheet" href="{{ asset('app-assets') }}/vendor/libs/flatpickr/flatpickr.css" />
    <link rel="stylesheet" href="{{ asset('app-assets') }}/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.css" />
    <link rel="stylesheet"
        href="{{ asset('app-assets') }}/vendor/libs/bootstrap-daterangepicker/bootstrap-daterangepicker.css" />
    <link rel="stylesheet" href="{{ asset('app-assets') }}/vendor/libs/jquery-timepicker/jquery-timepicker.css" />
    <link rel="stylesheet" href="{{ asset('app-assets') }}/vendor/libs/pickr/pickr-themes.css" />
    <link rel="stylesheet" href="{{ asset('app-assets') }}/vendor/libs/select2/select2.css" />
    <link rel="stylesheet" href="{{ asset('app-assets') }}/vendor/libs/tagify/tagify.css" />
    <link rel="stylesheet" href="{{ asset('app-assets') }}/vendor/libs/bootstrap-select/bootstrap-select.css" />
    <link rel="stylesheet" href="{{ asset('app-assets') }}/vendor/libs/typeahead-js/typeahead.css" />
    {{--
    <link rel="stylesheet" type="text/css"
        href="{{asset('app-assets-old/vendors/css/pickers/flatpickr/flatpickr.min.css')}}">
    <link rel="stylesheet" type="text/css"
        href="{{asset('app-assets-old/css/plugins/forms/pickers/form-flat-pickr.css')}}"> --}}
    @endpush

    @push('scripts')
    {{-- <script src="{{ asset('app-assets') }}/vendor/libs/flatpickr/flatpickr.js"></script>
    <script src="{{ asset('app-assets') }}/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.js"></script>
    <script src="{{ asset('app-assets') }}/vendor/libs/bootstrap-daterangepicker/bootstrap-daterangepicker.js"></script>
    <script src="{{ asset('app-assets') }}/vendor/libs/jquery-timepicker/jquery-timepicker.js"></script>
    <script src="{{ asset('app-assets') }}/vendor/libs/pickr/pickr.js"></script>
    <script src="{{ asset('app-assets') }}/js/forms-pickers.js"></script> --}}
    <script src="{{ asset('app-assets') }}/vendor/libs/select2/select2.js"></script>
    <script src="{{ asset('app-assets') }}/vendor/libs/bootstrap-select/bootstrap-select.js"></script>
    <script src="{{ asset('app-assets') }}/vendor/libs/typeahead-js/typeahead.js"></script>
    <script src="{{ asset('app-assets') }}/vendor/libs/bloodhound/bloodhound.js"></script>
    <script src="{{ asset('app-assets') }}/js/forms-selects.js"></script>
    {{-- <script src="{{ asset('app-assets') }}/vendor/libs/tagify/tagify.js"></script> --}}
    {{-- <script src="{{ asset('app-assets') }}/js/forms-tagify.js"></script> --}}
    <script src="{{ asset('app-assets') }}/js/forms-typeahead.js"></script>
    <script src="{{asset('app-assets-old/vendors/js/pickers/flatpickr/flatpickr.min.js')}}"></script>
    <script src="{{asset('app-assets-old/js/scripts/forms/pickers/form-pickers.js')}}"></script>
    @include('admin.components.slug')
    @endpush

    {{-- @include('admin.components.imagecropuser') --}}
    @include('admin.components.imagecrop')
    @include('admin.components.texteditor')
</x-master-layout>
