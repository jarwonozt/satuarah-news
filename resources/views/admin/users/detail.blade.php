<x-master-layout>
    @section('title')
        Profile
    @endsection
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">User /</span> Profile</h4>

            <div class="row">
                <div class="col-md-12">
                    <ul class="nav nav-pills flex-column flex-md-row mb-4">
                        <li class="nav-item">
                            <a class="nav-link active" href="javascript:void(0);"><i class="ti-xs ti ti-users me-1"></i>Profile Setting</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('security') }}"><i class="ti-xs ti ti-lock me-1"></i> Security</a>
                        </li>
                    </ul>
                    <div class="card mb-4">
                        <form action="{{ route('update.profile.setting') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="d-flex align-items-start align-items-sm-center gap-4">
                                    <img src="{{ auth()->user()->image ? asset(auth()->user()->imagePath) : asset('app-assets/img/avatars/1.png') }}" alt="user-avatar" class="d-block w-px-100 h-px-100 rounded" id="uploadedAvatar" />
                                    <div class="button-wrapper">
                                        <label for="upload" class="btn btn-primary me-2 mb-3" tabindex="0">
                                            <span class="d-none d-sm-block">Upload new photo</span>
                                            <i class="ti ti-upload d-block d-sm-none"></i>
                                            <input type="file" name="image" id="upload" class="account-file-input" hidden accept="image/png, image/jpeg" />
                                        </label>
                                        <div class="text-muted">Allowed JPG, GIF or PNG. Max size of 3MB</div>
                                    </div>
                                </div>
                                @if ($errors->has('image'))<span class="text-danger mt-1">{{ $errors->first('image') }}</span>@endif
                            </div>
                            <hr class="my-0" />
                            <div class="card-body">
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label for="name" class="form-label">Name</label>
                                        <input class="form-control" type="text" id="name" name="name" value="{{ auth()->user()->name }}" autofocus />
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="email" class="form-label">Email</label>
                                        <input class="form-control" type="text" id="email" name="email" value="{{ auth()->user()->email }}">
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <button type="submit" class="btn btn-primary me-2">@lang('admin.save')</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="content-backdrop fade"></div>
        @push('scripts')
            <script>
            $(function () {
                    var changePicture = $('#upload'),
                        userAvatar = $('#uploadedAvatar'),
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
        @endpush
    </div>
</x-master-layout>
