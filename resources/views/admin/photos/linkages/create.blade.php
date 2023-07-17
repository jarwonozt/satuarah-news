<x-master-layout>
    @section('title')
        @lang('admin.photo.title')
    @endsection
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <h5 class="fw-bold py-3 mb-2"><span class="text-muted fw-light">Dashboard / <a href="{{ route('photos.index') }}">@lang('admin.photo.title')</a> /</span> @lang('admin.photo.create')</h6>
            <form class="form" method="POST" enctype="multipart/form-data" action="{{ route('photolinkages.store') }}">
            @csrf
            <div class="row justify-content-start">
                <div class="col-12 col-md-8 col-xl-8">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5>{{ $photo->title }}</h5>
                            <div class="d-flex align-items-center flex-wrap">
                                <div class="avatar avatar-xl me-1">
                                    <a data-fancybox="gallery-a"data-fancybox data-type="image" href="{{ $photo->imagePath }}" data-caption="{{ $photo->caption }}">
                                        <img src="{{ $photo->imagePath }}" alt="{{ $photo->title }}" class="rounded">
                                    </a>
                                </div>
                                @foreach ($photoLinkage as $item)
                                    <div class="avatar avatar-xl me-1">
                                        <a data-fancybox="gallery-a"data-fancybox data-type="image" href="{{ $item->imagePath }}" data-caption="{{ $item->caption }}">
                                            <img src="{{ $item->imagePath }}" alt="{{ $item->getParent->title }}" class="rounded">
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4 col-xl-4">
                    <input type="hidden" name="parent_id" value="{{ $photo->id }}">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label class="form-label text-primary fw-bold" for="basic-default">IMAGE</label>
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
                            <div class="mb-3 mt-2">
                                <label class="form-label text-primary fw-bold text-uppercase" for="basic-default">caption</label></span>
                                <textarea name="caption" class="form-control" rows="2" placeholder="Caption Image">{{ old('caption') }}</textarea>
                                @if ($errors->has('caption'))<span class="text-danger">{{$errors->first('caption')}}</span>@endif
                            </div>
                        </div>
                    </div>
                    <div class="card mt-2">
                        <div class="card-body">
                            <button type="submit" class="btn btn-primary text-uppercase">@lang('admin.save')</button>
                            <a href="{{ route('photos.index') }}" class="btn btn-secondary text-uppercase">@lang('admin.cancel')</a>
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
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css" type="text/css" media="screen" />
    @endpush
    @include('admin.components.texteditor')
</x-master-layout>
