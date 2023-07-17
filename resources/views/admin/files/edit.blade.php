<x-master-layout>
    @section('title')
    @lang('admin.file.edit')
    @endsection
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <h5 class="fw-bold py-3 mb-2"><span class="text-muted fw-light">Dashboard / <a href="{{ route('files.index') }}">@lang('admin.file.title')</a> / </span>@lang('admin.file.edit')</h6>
                <form class="form" method="POST" enctype="multipart/form-data" action="{{ route('files.update', $data->id) }}">
                    @method('PUT')
                    @csrf
                    <div class="row justify-content-start">
                        <div class="col-12">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label class="form-label text-primary fw-bold text-uppercase" for="basic-default">@lang('admin.form.title') </label></span>
                                        <input id="title" name="title" type="text" class="form-control" placeholder="@lang('admin.form.title') @lang('admin.file.title')" value="{{ $data->title }}" required />
                                        @if ($errors->has('title'))
                                        <span class="text-danger">{{ $errors->first('title') }}</span>
                                        @endif
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label text-primary fw-bold text-uppercase" for="basic-default">slug</label></span>
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
                                        @if ($errors->has('slug'))
                                        <span class="text-danger">{{ $errors->first('slug') }}</span>
                                        @endif
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label text-primary fw-bold text-uppercase"
                                            for="basic-default">@lang('admin.form.category')</label>
                                        <select name="category_id" id="selectpickerBasic" class="selectpicker w-100"
                                            data-style="btn-default" required>
                                            <option value="">-- PILIH --</option>
                                            @foreach ($categories as $item)
                                            <option value="{{ $item->id }}" {{ ($item->id == $data->category_id ? 'selected' : '') }}>{{ strtoupper($item->name) }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('roles'))
                                        <span class="text-danger">
                                            {{ $errors->first('roles') }}
                                        </span>
                                        @endif
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label text-primary fw-bold text-uppercase" for="basic-default">@lang('admin.form.description')</label></span>
                                        <textarea name="description" class="form-control" rows="4">{{ $data->description }}</textarea>
                                        @if ($errors->has('description'))
                                        <span class="text-danger">Deskripsi Wajib Isi!!!</span>
                                        @endif
                                    </div>
                                    <div class="mb-3 mt-2">
                                        <label class="form-label text-primary fw-bold text-uppercase" for="basic-default">@lang('admin.file.title')</label>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="input-group hdtuto control-group lst increment">
                                                    <input type="file" name="file[]" accept="application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint,text/plain, application/pdf" class="myfrm form-control" required>
                                                    <div class="input-group-btn">
                                                        <button class="add_button btn btn-primary ml-1" type="button"><i class="ti ti-plus"></i></button>
                                                    </div>
                                                </div>
                                                <div class="clone hide">
                                                    <div class="hdtuto control-group lst input-group" style="margin-top:10px">
                                                        <input type="file" name="file[]" accept="application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint,text/plain, application/pdf" class="myfrm form-control" required>
                                                        <div class="input-group-btn">
                                                            <button class="remove_button btn btn-danger ml-1" type="button"><i class="ti ti-trash"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                @foreach ($data->files as $item)
                                                <ul class="list-group">
                                                    <li class="list-group-item d-flex justify-content-between align-items-center mb-1">
                                                        <span class="mr-1">
                                                            <i data-feather="file" class="font-medium-2"></i>
                                                        </span>
                                                        <span>{{ $item->name }}</span>
                                                        <a href="{{ route('file.delete', $item->id) }}" class="btn btn-danger btn-sm"><i class="ti ti-trash"></i></a>
                                                    </li>

                                                </ul>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3 mt-2">
                                        <label class="form-label text-primary fw-bold text-uppercase"
                                            for="basic-default">status</label></span>
                                        <div class="d-flex flex-row">
                                            <div class="custom-control custom-radio">
                                                <input name="status" type="radio" id="customRadio4" class="form-check-input" value="1" checked />
                                                <label class="custom-control-label" for="customRadio4">Terbit</label>
                                            </div>
                                            <div class="custom-control custom-radio ms-2">
                                                <input name="status" type="radio" id="customRadio5" class="form-check-input" value="2" />
                                                <label class="custom-control-label" for="customRadio5">Tidak</label>
                                            </div>
                                        </div>
                                        @if ($errors->has('status'))
                                        <span class="text-danger">{{ $errors->first('status') }}</span>
                                        @endif
                                    </div>
                                    <div class="mt-3">
                                        <button type="submit" class="btn btn-primary text-uppercase">@lang('admin.save')</button>
                                        <a href="{{ route('files.index') }}" class="btn btn-secondary text-uppercase">@lang('admin.cancel')</a>
                                    </div>
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
    @endpush

    @push('scripts')
    <script src="{{ asset('app-assets') }}/vendor/libs/select2/select2.js"></script>
    <script src="{{ asset('app-assets') }}/vendor/libs/bootstrap-select/bootstrap-select.js"></script>
    <script src="{{ asset('app-assets') }}/vendor/libs/typeahead-js/typeahead.js"></script>
    <script src="{{ asset('app-assets') }}/vendor/libs/bloodhound/bloodhound.js"></script>
    <script src="{{ asset('app-assets') }}/js/forms-selects.js"></script>
    <script src="{{ asset('app-assets') }}/js/forms-typeahead.js"></script>
    <script src="{{ asset('app-assets-old/vendors/js/pickers/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ asset('app-assets-old/js/scripts/forms/pickers/form-pickers.js') }}"></script>
    @include('admin.components.slug')
    <script type="text/javascript">
        $(document).ready(function() {
                $(".add_button").click(function() {
                    var lsthmtl = $(".clone").html();
                    $(".increment").after(lsthmtl);
                });
                $("body").on("click", ".remove_button", function() {
                    $(this).parents(".hdtuto").remove();
                });
            });
    </script>
    @endpush

    @include('admin.components.imagecrop')
</x-master-layout>
