<!DOCTYPE html>

<html lang="en" class="light-style customizer-hide" dir="ltr" data-theme="theme-default"
    data-assets-path="{{ asset('app-assets') }}/" data-template="vertical-menu-template">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Login | {{ config('app.name') }}</title>

    <meta name="description" content="" />

    <link rel="icon" type="image/x-icon" href="{{ asset('app-assets') }}/img/favicon/favicon.ico" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('app-assets') }}/vendor/fonts/fontawesome.css" />
    <link rel="stylesheet" href="{{ asset('app-assets') }}/vendor/fonts/tabler-icons.css" />
    <link rel="stylesheet" href="{{ asset('app-assets') }}/vendor/fonts/flag-icons.css" />

    <link rel="stylesheet" href="{{ asset('app-assets') }}/vendor/css/rtl/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('app-assets') }}/vendor/css/rtl/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('app-assets') }}/css/demo.css" />

    <link rel="stylesheet" href="{{ asset('app-assets') }}/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="{{ asset('app-assets') }}/vendor/libs/node-waves/node-waves.css" />
    <link rel="stylesheet" href="{{ asset('app-assets') }}/vendor/libs/typeahead-js/typeahead.css" />
    <link rel="stylesheet" href="{{ asset('app-assets') }}/vendor/libs/formvalidation/dist/css/formValidation.min.css" />

    <link rel="stylesheet" href="{{ asset('app-assets') }}/vendor/css/pages/page-auth.css" />
    <script src="{{ asset('app-assets') }}/vendor/js/helpers.js"></script>

    <script src="{{ asset('app-assets') }}/vendor/js/template-customizer.js"></script>
    <script src="{{ asset('app-assets') }}/js/config.js"></script>
</head>

<body>

    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner py-4">
                <!-- Login -->
                <div class="card">
                    <div class="card-body">
                        <!-- Logo -->
                        <div class="app-brand justify-content-center mb-4 mt-2">
                            <a href="index.html" class="app-brand-link gap-2">
                                <span class="app-brand-text demo text-body fw-bold ms-1">{{ config('app.name') }}</span>
                            </a>
                        </div>
                        <!-- /Logo -->
                        <p class="mb-4">Please sign-in to your account and start the adventure</p>
                        @if (session('status'))
                            <div class="alert alert-danger">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-danger p-1">
                                <div class="font-medium text-red-600">{{ __('Whoops! Something went wrong.') }}</div>

                                <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form id="formAuthentication" class="mb-3" action="{{ route('login') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label fw-bold text-primary">Email</label>
                                <input type="email" name="email" value="{{ old('email') }}" class="form-control" id="email" placeholder="Enter your email or username" autofocus />
                            </div>
                            <div class="mb-3 form-password-toggle">
                                <div class="d-flex justify-content-between">
                                    <label class="form-label fw-bold text-primary" for="password">Password</label>
                                </div>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" class="form-control" name="password"
                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                        aria-describedby="password" />
                                    <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-primary d-grid w-100" type="submit">Sign in</button>
                            </div>
                        </form>

                        {{-- <p class="text-center">
                            <span>New on our platform?</span>
                            <a href="auth-register-basic.html">
                                <span>Create an account</span>
                            </a>
                        </p> --}}
                    </div>
                </div>
                <!-- /Register -->
            </div>
        </div>
    </div>

    <!-- / Content -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('app-assets') }}/vendor/libs/jquery/jquery.js"></script>
    <script src="{{ asset('app-assets') }}/vendor/libs/popper/popper.js"></script>
    <script src="{{ asset('app-assets') }}/vendor/js/bootstrap.js"></script>
    <script src="{{ asset('app-assets') }}/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="{{ asset('app-assets') }}/vendor/libs/node-waves/node-waves.js"></script>

    <script src="{{ asset('app-assets') }}/vendor/libs/hammer/hammer.js"></script>
    <script src="{{ asset('app-assets') }}/vendor/libs/i18n/i18n.js"></script>
    <script src="{{ asset('app-assets') }}/vendor/libs/typeahead-js/typeahead.js"></script>

    <script src="{{ asset('app-assets') }}/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ asset('app-assets') }}/vendor/libs/formvalidation/dist/js/FormValidation.min.js"></script>
    <script src="{{ asset('app-assets') }}/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js"></script>
    <script src="{{ asset('app-assets') }}/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js"></script>

    <!-- Main JS -->
    <script src="{{ asset('app-assets') }}/js/main.js"></script>

    <!-- Page JS -->
    <script src="{{ asset('app-assets') }}/js/pages-auth.js"></script>
</body>

</html>

