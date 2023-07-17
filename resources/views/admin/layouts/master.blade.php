<!DOCTYPE html>

<html lang="❴❴ session()->get('locale') ?? app()->getLocale() ❵❵" class="light-style layout-navbar-fixed layout-menu-fixed" dir="ltr" data-theme="theme-default"
    data-assets-path="{{ asset('app-assets') }}/" data-template="vertical-menu-template">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>@yield('title') | {{ config('app.name') }}</title>

    <meta name="description" content="" />

    <link rel="icon" type="image/x-icon" href="{{ asset('app-assets') }}/img/favicon/favicon.ico" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('app-assets') }}/vendor/fonts/fontawesome.css" />
    <link rel="stylesheet" href="{{ asset('app-assets') }}/vendor/fonts/tabler-icons.css" />
    <link rel="stylesheet" href="{{ asset('app-assets') }}/vendor/fonts/flag-icons.css" />
    <link rel="stylesheet" href="{{ asset('app-assets') }}/vendor/css/rtl/core.css"
        class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('app-assets') }}/vendor/css/rtl/theme-default.css"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('app-assets') }}/css/demo.css" />
    <link rel="stylesheet" href="{{ asset('app-assets') }}/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="{{ asset('app-assets') }}/vendor/libs/node-waves/node-waves.css" />
    <link rel="stylesheet" href="{{ asset('app-assets') }}/vendor/libs/typeahead-js/typeahead.css" />
    <link rel="stylesheet" href="{{ asset('app-assets') }}/vendor/css/pages/page-icons.css" />

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>


    @stack('styles')

    @livewireStyles
</head>

<body>
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">

            @include('admin.navigation.menu')

            <div class="layout-page">

                @include('admin.navigation.navbar')

                {{ $slot }}

            </div>
        </div>

        <div class="layout-overlay layout-menu-toggle"></div>

        <div class="drag-target"></div>
    </div>

    <script src="{{ asset('app-assets') }}/vendor/js/helpers.js"></script>
    <script src="{{ asset('app-assets') }}/vendor/js/template-customizer.js"></script>
    <script src="{{ asset('app-assets') }}/js/config.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"
        integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="{{ asset('app-assets') }}/vendor/libs/jquery/jquery.js"></script>
    <script src="{{ asset('app-assets') }}/vendor/libs/popper/popper.js"></script>
    <script src="{{ asset('app-assets') }}/vendor/js/bootstrap.js"></script>
    <script src="{{ asset('app-assets') }}/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="{{ asset('app-assets') }}/vendor/libs/node-waves/node-waves.js"></script>

    <script src="{{ asset('app-assets') }}/vendor/libs/hammer/hammer.js"></script>
    <script src="{{ asset('app-assets') }}/vendor/libs/i18n/i18n.js"></script>
    <script src="{{ asset('app-assets') }}/vendor/libs/typeahead-js/typeahead.js"></script>

    <script src="{{ asset('app-assets') }}/vendor/js/menu.js"></script>

    @stack('vendor-js')

    <script src="{{ asset('app-assets') }}/js/main.js"></script>

    @livewireScripts

    @stack('scripts')
</body>

</html>
