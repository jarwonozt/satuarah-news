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
                            <a class="nav-link" href="{{ route('profile') }}"><i class="ti-xs ti ti-users me-1"></i>Profile Setting</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('security') }}"><i class="ti-xs ti ti-lock me-1"></i> Security</a>
                        </li>
                    </ul>
                    @if (session()->has('message'))
                    <div class="alert alert-primary alert-dismissible" role="alert">
                        <div class="alert-body"><strong>{{ session('message') }}</strong></div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    @if (session()->has('error'))
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <div class="alert-body"><strong>{{ session('error') }}</strong></div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    <div class="card mb-4">
                        <h5 class="card-header">Ubah Password</h5>
                        <div class="card-body">
                            <form id="formAccountSettings" action="{{ route('security.change') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="mb-3 col-md-6 form-password-toggle">
                                        <label class="form-label" for="currentPassword">Password Saat Ini</label>
                                        <div class="input-group input-group-merge">
                                            <input class="form-control" type="password" name="current_password" id="currentPassword" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                                            <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                                        </div>
                                        @error('current_password')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-md-6 form-password-toggle">
                                        <label class="form-label" for="newPassword">Password Baru</label>
                                        <div class="input-group input-group-merge">
                                            <input class="form-control" type="password" id="new_password" name="new_password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                                            <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                                        </div>
                                        @error('new_password')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3 col-md-6 form-password-toggle">
                                        <label class="form-label" for="confirmPassword">Konfirmasi Password</label>
                                        <div class="input-group input-group-merge">
                                            <input class="form-control" type="password" id="new_password_confirmation" name="new_password_confirmation" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                                            <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                                        </div>
                                    </div>
                                    <div>
                                        <button type="submit" class="btn btn-primary me-2">@lang('admin.save')</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!--/ Change Password -->

                    <!-- Two-steps verification -->
                    <div class="card mb-4">
                        <h5 class="card-header">Two-steps verification</h5>
                        <div class="card-body">
                            <h6 class="fw-semibold mb-3">Two factor authentication is not enabled yet.</h6>
                            <p class="w-50">
                                Two-factor authentication adds an additional layer of security to your account by requiring more
                                than just a password to log in.
                                <a href="javascript:void(0);">Learn more.</a>
                            </p>
                            <button class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#enableOTP">
                                Enable two-factor authentication
                            </button>
                        </div>
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
