<!DOCTYPE html>
<html lang="en-US">

<head>
	<title>{{ config('app.name') }}</title>
	{{-- <meta name="description" content="{{ $meta->preview }}" />
	<meta name="keywords" content="{{ $meta->tags }}" /> --}}
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="author" content="Pusbimdik Khonghucu Kemenag" />
    <meta name="robots" content="index, follow, max-snippet:-1, max-image-preview:standard, max-video-preview:-1" />
    <meta name="language" content="id-id" />
    <meta name="geo.country" content="id" />
    <meta name="geo.placename" content="Indonesia" />
    <meta name="distribution" content="Global" />
    <meta name="googlebot-news" content="index, follow" />
    <meta name="googlebot" content="index, follow" />

	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />

    {{-- <meta property="og:url" content="{{ $meta->url ?? url('/') }}" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="{{ $meta->title }}" />
    <meta property="og:description" content="{{ $meta->preview  }}" />
    <meta property="og:image" content="{{ $meta->meta_image ?? asset('/assets/images/logo.png') }}" />
    <meta property="og:image:type" content="image/jpeg">
    <meta property="og:image:width" content="800">
    <meta property="og:image:height" content="450">
    <meta property="og:site_name" content="{{ url('/') }}" >

    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:site" content="@kemenagsulsel">
    <meta name="twitter:creator" content="@kemenagsulsel">
    <meta name="twitter:description" content="{{ $meta->description  }}" />
    <meta name="twitter:image" content="{{ $meta->meta_image ?? asset('/assets/images/logo.png') }}" />
    <meta name="twitter:image:src" content="{{ $meta->meta_image ?? asset('/assets/images/logo.png') }}" />
    <meta name="twitter:title" content="{{ $meta->title }}" /> --}}


	<!-- Favicon-->
	<link rel="icon" href="{{ asset('assets/img/favicon.png') }}" type="image/x-icon" />
	<!-- Stylesheets-->
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/fonts/font-awesome/css/font-awesome.min.css')}}">
	<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}" type="text/css" media="all" />
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/bootstrap-extended.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/components.css')}}">
	<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" type="text/css" media="all" />
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/font-awesome/css/font-awesome.min.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}" type="text/css" media="all" />
	<link rel="stylesheet" href="{{ asset('assets/css/main.css')}} " type="text/css" media="all" />
    <link rel="stylesheet" href="{{ asset('assets/css/colors.css') }}" type="text/css" media="all">
    @yield('styles')
    @livewireStyles

</head>

<body class="mobile_nav_class jl-has-sidebar">
	<div class="options_layout_wrapper jl_clear_at jl_radius jl_none_box_styles jl_border_radiuss jl_en_day_night">
		<div class="options_layout_container full_layout_enable_front">
            @include('client.navigation.header')
            <div class="mobile_menu_overlay"></div>
			<div class="jl_home_bw">
                @yield('content')
			</div>
            @include('client.navigation.footer')
			<div id="go-top"> <a href="#go-top"><i class="jli-up-chevron"></i></a>
			</div>
		</div>
	</div>

	<script src="{{asset('assets/js/jquery.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
	<script src="{{asset('assets/js/fluidvids.js')}}"></script>
	<script src="{{asset('assets/js/slick.js')}}"></script>
	<script src="{{asset('assets/js/custom.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/theia-sticky-sidebar@1.7.0/dist/ResizeSensor.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/theia-sticky-sidebar@1.7.0/dist/theia-sticky-sidebar.min.js"></script>

    @yield('scripts')
    @livewireScripts

</body>

</html>
