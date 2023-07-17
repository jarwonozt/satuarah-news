<x-master-layout>
    @section('title')
        @lang('admin.image.title')
    @endsection
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <h5 class="fw-bold py-3 mb-2"><span class="text-muted fw-light">Dashboard / <a href="{{ route('images.index') }}">@lang('admin.image.title')</a> /</span> @lang('admin.image.create')</h6>
            <form class="form" method="POST" enctype="multipart/form-data" action="{{ route('images.store') }}">
            @csrf
            <div class="row justify-content-start">
                <div class="col-12">
                    @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <div class="alert-body">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                </div>
                <div class="col-12 col-md-8 col-xl-8">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label text-primary fw-bold text-uppercase" for="basic-default">@lang('admin.form.title') </label></span>
                                <input id="title" name="title" type="text" class="form-control" placeholder="@lang('admin.form.title') @lang('admin.image.title')" value="{{ old('title') }}" required/>
                                @if ($errors->has('title'))<span class="text-danger">{{$errors->first('title')}}</span>@endif
                            </div>
                            <div class="mb-3">
                                <label class="form-label text-primary fw-bold text-uppercase" for="basic-default">slug/url</label></span>
                                <input name="slug" type="text" class="form-control mb-1" value="{{ old('slug') }}" />
                                @if ($errors->has('slug'))<span class="text-danger">{{$errors->first('slug')}}</span>@endif
                            </div>
                            <div class="mb-3">
                                <label class="form-label text-primary fw-bold text-uppercase" for="basic-default">@lang('admin.form.category')</label>
                                <select name="category_id" id="selectpickerBasic" class="selectpicker w-100" data-style="btn-default" required>
                                    <option value="">-- PILIH --</option>
                                    @foreach ($categories as $item)
                                    <option value="{{ $item->id }}">{{ strtoupper($item->name) }}</option>
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
                                <textarea name="description" class="form-control" rows="4">{{ old('description') }}</textarea>
                                @if ($errors->has('description'))<span class="text-danger">Description Wajib Isi!!!</span>@endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4 col-xl-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label class="form-label text-primary fw-bold" for="basic-default">IMAGE</label>
                                @if ($errors->has('image'))<span class="text-danger">{{$errors->first('image')}}</span>@endif
                                <div class="form-group mb-2">
                                    <div class="media flex-column text-center">
                                        <img name="image" src="{{ asset('assets/images/dummy-image.jpeg') }}" alt="users avatar" class="user-avatar users-avatar-shadow rounded my-25 cursor-pointer" width="100%" />
                                        <div class="media-body mt-50">
                                            <label class="btn btn-primary mb-0 mt-1" for="change-picture">
                                                <span class="d-none d-sm-block">Pilih Image</span>
                                                <input class="form-control" name="image" type="file" id="change-picture" hidden accept="image/png, image/jpeg, image/jpg, image/svg+xml" />
                                                <span class="d-block d-sm-none">
                                                    <i class="mr-0" data-feather="edit"></i>
                                                </span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 mt-3">
                                <label class="form-label text-primary fw-bold text-uppercase" for="basic-default">status</label></span>
                                <div class="d-flex flex-row">
                                    <div class="custom-control custom-radio">
                                        <input name="status" type="radio" id="customRadio4" class="form-check-input" value="1" checked />
                                        <label class="custom-control-label" for="customRadio4">Terbit</label>
                                    </div>
                                    <div class="custom-control custom-radio ms-2">
                                        <input name="status" type="radio" id="customRadio5" class="form-check-input" value="0" />
                                        <label class="custom-control-label" for="customRadio5">Tidak</label>
                                    </div>
                                </div>
                                @if ($errors->has('status'))<span class="text-danger">{{$errors->first('status')}}</span>@endif
                            </div>
                        </div>
                    </div>
                    <div class="card mt-2">
                        <div class="card-body">
                            <button type="submit" class="btn btn-primary text-uppercase">@lang('admin.save')</button>
                            <a href="{{ route('images.index') }}" class="btn btn-secondary text-uppercase">@lang('admin.cancel')</a>
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
        <link rel="stylesheet" href="{{ asset('app-assets') }}/vendor/libs/bootstrap-daterangepicker/bootstrap-daterangepicker.css" />
        <link rel="stylesheet" href="{{ asset('app-assets') }}/vendor/libs/jquery-timepicker/jquery-timepicker.css" />
        <link rel="stylesheet" href="{{ asset('app-assets') }}/vendor/libs/select2/select2.css" />
        <link rel="stylesheet" href="{{ asset('app-assets') }}/vendor/libs/bootstrap-select/bootstrap-select.css" />
    @endpush

    @push('scripts')
        <script src="{{ asset('app-assets') }}/vendor/libs/select2/select2.js"></script>
        <script src="{{ asset('app-assets') }}/vendor/libs/bootstrap-select/bootstrap-select.js"></script>
        <script src="{{ asset('app-assets') }}/js/forms-selects.js"></script>
        <script src="{{asset('app-assets-old/vendors/js/pickers/flatpickr/flatpickr.min.js')}}"></script>
        <script src="{{asset('app-assets-old/js/scripts/forms/pickers/form-pickers.js')}}"></script>
        @include('admin.components.slug')
        <script>
            $(function () {
                    var changePicture = $('#change-picture'),
                        userAvatar = $('.user-avatar'),
                        languageSelect = $('#users-language-select2'),
                        form = $('.form-validate'),
                        birthdayPickr = $('.birthdate-picker');

                    // Change user profile picture
                    if (changePicture.length) {
                        $(changePicture).on('change', function (e) {
                        var reader = new FileReader(),
                            files = e.target.files;
                        reader.onload = function () {
                            if (userAvatar.length) {
                            userAvatar.attr('src', reader.result);
                            }
                        };
                        reader.readAsDataURL(files[0]);
                        });
                    }
                });
        </script>
        <script>
            $(function () {
                    $('#youtube_id').on('blur', function(){
                    $val = $(this).val();
                    $('#frame_image').attr('src', 'https://www.youtube.com/embed/'+$val);
                    });
                });
        </script>
    @endpush
    @include('admin.components.texteditor')
</x-master-layout>
