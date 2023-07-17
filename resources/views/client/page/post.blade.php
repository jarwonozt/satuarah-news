<x-guest-layout>
    @include('client.layouts.header', ['menu' => $menu ])
    <section class="bg-white pb-60">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <!-- Breadcrumb -->
                    <ul class="breadcrumbs bg-light mb-4">
                        <li class="breadcrumbs__item">
                            <a href="/" class="breadcrumbs__url">
                                <i class="fa fa-home"></i> Home</a>
                        </li>
                        <li class="breadcrumbs__item">
                            <a href="/{{$data->getCategory->slug}}" class="breadcrumbs__url">{{ $data->getCategory->name }}</a>
                        </li>
                        <li class="breadcrumbs__item breadcrumbs__item--current">
                            {!! $data->title !!}
                        </li>
                    </ul>
                </div>

            </div>
            <div class="row">
                <div class="col-md-8">

                    <!-- Social media animation -->
                    {{-- <div class="social__media__animation ">
                        <ul class="menu topLeft bg__card-shadow">
                            <li class="share bottom">
                                <i class="fa fa-share-alt"></i>
                                <ul class="list__submenu">
                                    <li><a href="#" class="facebook"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="#" class="twitter"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="#" class="googlePlus"><i class="fa fa-whatsapp"></i></a></li>
                                    <li><a href="#" class="instagram"><i class="fa fa-instagram"></i></a></li>
                                </ul>
                            </li>
                        </ul>
                    </div> --}}
                    <div class="d-none d-sm-none d-md-block d-lg-block">
                        <div class="sticky-container">
                            <ul class="sticky">
                                <li>

                                    <p><a href="https://www.facebook.com/sharer/sharer.php?u={{$data->url}}" target="_blank"><img src="{{ asset('assets/fb.png') }}" width="40" height="40"></a></p>
                                </li>
                                <li>
                                    <p><a href="https://twitter.com/intent/tweet?url={{$data->url}}" target="_blank"><img src="{{ asset('assets/twitter.png') }}" width="40" height="40"></a></p>
                                </li>
                                <li>
                                    <p><a href="whatsapp://send?text={{$data->url}}" target="_blank"><img src="{{ asset('assets/wa.png') }}" width="40" height="40"></a></p>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- Article detail -->
                    <div class="wrap__article-detail">
                        <div class="wrap__article-detail-title mb-2">
                            <h2>
                                {!! $data->title !!}
                            </h2>
                            {{-- <h4>
                                {!! $data->prefix !!}
                            </h4> --}}
                        </div>
                        <div class="wrap__article-detail-info">
                            <ul class="list-inline">
                                @if ($data->getAuthor($data->id))
                                @foreach ($data->getAuthor($data->id) as $a=>$b)
                                @if($b['code'] === 'k')
                                {{-- <li class="list-inline-item">
                                    <figure class="image-profile">
                                        <img src="{{ $b['avatar'] }}" alt="" class="img-fluid img-circle" style="width: 40px;height: 40px;">
                                    </figure>
                                </li> --}}
                                <li class="list-inline-item">
                                    <span>
                                        by
                                    </span>
                                    <a href="{{$b['url']}}" class="text-dark">
                                        {!! $b['name'] !!},
                                    </a>
                                </li>
                                @endif
                                @endforeach
                                @endif
                                <li class="list-inline-item">
                                    <span class="text-dark text-capitalize ml-1">
                                        {{ $data->date }},
                                    </span>
                                </li>
                                <li class="list-inline-item ">
                                    <span class="mr-1 ml-1">
                                        <i class="fa fa-eye"></i>
                                        {{ $data->counter }}
                                    </span>

                                </li>
                            </ul>
                        </div>
                        <div class="wrap__article-detail-image">
                            <figure>
                                <img src="{{ is_file(public_path($data->images['full'])) ? $data->images['full'] : asset('assets/images/placeholder/800x500.jpg') }}"
                                    alt="" class="img-fluid">
                            </figure>
                            <small>{{ $data->caption }}</small>
                        </div>
                        <div class="text-start mt-2 d-block d-sm-block d-md-none d-lg-none">
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{$data->url}}" class="btn btn-social rounded text-white facebook">
                                        <i class="fa fa-facebook"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="https://twitter.com/intent/tweet?url={{$data->url}}" class="btn btn-social rounded text-white twitter">
                                        <i class="fa fa-twitter"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="whatsapp://send?text={{$data->url}}" class="btn btn-social rounded text-white whatsapp">
                                        <i class="fa fa-whatsapp"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <hr>

                        <div class="wrap__article-detail-content" style="font-size:20px!important;">

                            {!! $data['content'] !!}

                        </div>
                    </div>

                    <!-- News Tags -->
                    <div class="blog-tags">
                        <ul class="list-inline">
                            @isset($data->tags)
                                @foreach(explode(', ', $data->tags) as $tag)
                                <li class="list-inline-item">
                                    <a href="/tags/{{ $tag }}">#{{$tag}}</a>
                                </li>
                                @endforeach
                            @endisset
                        </ul>
                    </div>

                    <div class="clearfix"></div>
                    @include('client.widget.post-linkage', ['title' => 'PILIHAN UNTUKMU', 'data' => $posts, 'limit' => 8])
                    {{-- @include('client.widget.post-linkage', ['data' => $posts, 'limit' => 6, 'title' => 'TERKAIT']) --}}
                </div>
                <div class="col-md-4">
                    <div class="sidebar-section">
                        @include('client.widget.popular-sidebar', ['data' => $popular, 'limit' => 6, 'title' => 'POPULAR'])

                        @include('client.widget.advertise', ['data' => $iklan_sidebar, 'limit' => 4])
                        @include('client.widget.infografis', ['title' => 'INFOGRAFIS', 'data' => $popular, 'limit' => 4])
                        @include('client.widget.social-media', ['data' => $popular, 'limit' => 4])
                        @include('client.widget.advertise', ['data' => $popular, 'limit' => 4])


                    </div>
                </div>
                <div class="clearfix"></div>

            </div>

        </div>
    </section>

    @include('client.layouts.footer')
</x-guest-layout>
