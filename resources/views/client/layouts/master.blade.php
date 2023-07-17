<!DOCTYPE html>
<html lang="">

<head>
    <meta charset="utf-8">
    <x-seo::meta />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" href="{{ asset('assets/icon.png') }}">
    <meta name="theme-color" content="#030303">
    <!-- google fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,500;0,700;1,300;1,500&family=Poppins:ital,wght@0,300;0,500;0,700;1,300;1,400&display=swap"
        rel="stylesheet">
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> --}}

    <link href="{{ asset('assets') }}/css/styles.css?537a1bbd0e5129401d28" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/slick/slick.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/slick/slick-theme.css') }}">
</head>

<body>
{{-- <body onload=display_ct();> --}}
    <!-- loading -->
    {{-- <div class="loading-container">
        <div class="h-100 d-flex align-items-center justify-content-center">
            <ul class="list-unstyled">
                <li>
                    <img src="{{ asset('assets') }}/images/placeholder/loading.png" alt="Alternate Text" height="100" />

                </li>
                <li>

                    <div class="spinner">
                        <div class="rect1"></div>
                        <div class="rect2"></div>
                        <div class="rect3"></div>
                        <div class="rect4"></div>
                        <div class="rect5"></div>

                    </div>

                </li>
                <li>
                    <p>Loading</p>
                </li>
            </ul>
        </div>
    </div> --}}
    <!-- End loading -->

    {{ $slot }}

    <a href="javascript:" id="return-to-top"><i class="fa fa-chevron-up"></i></a>
    <script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="{{ asset('assets') }}/js/index.bundle.js?537a1bbd0e5129401d28"></script>
    <script src="{{ asset('assets/slick/slick.js') }}" type="text/javascript" charset="utf-8"></script>
    <script>
        $('.image-slider').slick({
            autoplay: true,
            autoplaySpeed: 5000,
        });
    </script>
</body>

</html>
