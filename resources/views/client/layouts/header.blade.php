<header class="bg-light">
    <div class="navigation-wrap navigation-shadow bg-white">
        <nav class="navbar navbar-hover navbar-expand-lg navbar-soft">
            <div class="container">
                <div class="offcanvas-header">
                    <div data-toggle="modal" data-target="#modal_aside_right" class="btn-md">
                        <span class="navbar-toggler-icon"></span>
                    </div>
                </div>
                <figure class="mb-0 mx-auto d-block d-sm-none">
                    <a href="#">
                        <img src="{{ asset('assets') }}/images/placeholder/logo.png" width="280" height="60" alt="" class="img-fluid logo">
                    </a>
                </figure>

                <!-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main_nav99">
                        <span class="navbar-toggler-icon"></span>
                    </button> -->
                <div class="collapse navbar-collapse justify-content-between" id="main_nav99">
                    <ul class="navbar-nav mx-auto">
                        @foreach ($menu as $item)
                        @if ($item->parent_id == 0 && $item->category_id == 1)
                        <li class="nav-item {{ $item->type == 1 ? 'dropdown' : '' }}">
                            @if ($item->type == 1)
                            <a class="nav-link active dropdown-toggle" href="{{ $item->slug }}" data-toggle="dropdown"> {{ $item->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-left">
                                @foreach ($menu as $value)
                                @if($value->parent_id == $item->id)
                                <li><a class="dropdown-item" href="{{ $value->slug }}"> {{ $value->name }} </a></li>
                                @endif
                                @endforeach
                            </ul>
                            @else
                            <a class="nav-link" href="{{ $item->slug }}"> {{ $item->name }} </a>
                            @endif
                        </li>
                        @endif
                        @endforeach
                    </ul>

                    <!-- Search bar.// -->
                    <ul class="navbar-nav ">
                        <li class="nav-item search hidden-xs hidden-sm "> <a class="nav-link" href="#">
                                <i class="fa fa-search"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- Search content bar.// -->
                    <div class="top-search navigation-shadow">
                        <div class="container">
                            <div class="input-group ">
                                <form method="GET" action="{{ route('search') }}">

                                    <div class="row no-gutters mt-3">
                                        <div class="col">
                                            <input name="q" class="form-control border-secondary border-right-0 rounded-0" type="search" value=""
                                                placeholder="Cari Artikel " id="example-search-input4">
                                        </div>
                                        <div class="col-auto">
                                            <button type="submit" class="btn btn-outline-secondary border-left-0 rounded-0 rounded-right"><i
                                                    class="fa fa-search"></i></button>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Search content bar.// -->
                </div> <!-- navbar-collapse.// -->
            </div>
        </nav>
        <div class="container">
            <div class="row mt-2">
                <div class="d-none d-md-block d-lg-block d-xl-block col-md-6 col-lg-6 col-xl-6 justify-content-center align-self-center">
                    <figure class="mb-0">
                        <a href="/">
                            <img src="{{ asset('assets') }}/images/placeholder/logo.png" width="300" height="60" alt="" class="img-fluid logo">
                        </a>
                    </figure>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="image-slider">
                        @foreach ($banner_header as $item)
                            <img src="{{ $item->imagePath }}" alt="{{ $item->title }}">
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Navbar menu  -->

    <!-- Navbar sidebar menu  -->
    <div id="modal_aside_right" class="modal fixed-left fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-aside" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="widget__form-search-bar  ">
                        <div class="row no-gutters">
                            <form method="GET" action="{{ route('search') }}">
                            <div class="col">
                                <input name="q" class="form-control border-secondary border-right-0 rounded-0" value="" placeholder="Search">
                            </div>
                            <div class="col-auto">
                                <button type="submit" class="btn btn-outline-secondary border-left-0 rounded-0 rounded-right">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                            </form>
                        </div>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <nav class="list-group list-group-flush">
                        <ul class="navbar-nav">
                            @foreach ($menu as $item)
                            @if ($item->parent_id == 0 && $item->category_id == 1)
                            <li class="nav-item {{ $item->type == 1 ? 'dropdown' : '' }}">
                                @if ($item->type == 1)
                                <a class="nav-link active dropdown-toggle" href="{{ $item->slug }}" data-toggle="dropdown"> {{ $item->name }}
                                </a>
                                <ul class="dropdown-menu dropdown-menu-left">
                                    @foreach ($menu as $value)
                                    @if($value->parent_id == $item->id)
                                    <li><a class="dropdown-item" href="{{ $value->slug }}"> {{ $value->name }} </a></li>
                                    @endif
                                    @endforeach
                                </ul>
                                @else
                                <a class="nav-link" href="{{ $item->slug }}"> {{ $item->name }} </a>
                                @endif
                            </li>
                            @endif
                            @endforeach
                        </ul>

                    </nav>
                </div>
            </div>
        </div> <!-- modal-bialog .// -->
    </div> <!-- modal.// -->
    <!-- End Navbar sidebar menu  -->
    <!-- End Navbar  -->
</header>
