<x-guest-layout>
    @include('client.layouts.header', ['menu' => $menu ])
    <section class="bg-white pb-60">
        <div class="popular__section-news">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-lg-8">
                        <div class="wrapper__list__article">
                            <h4 class="border_section">{{ $title }}</h4>
                        </div>
                        <div class="row ">
                            @foreach ($data as $item)
                            <div class="col-sm-12 col-md-6">
                                <div class="wrapp__list__article-responsive">
                                    <div class="mb-3">
                                        <div class="card__post card__post-list">
                                            <div class="image-sm">
                                                <a href="{{ $item->url }}">
                                                    <img src="{{ is_file(public_path($item->images['full'])) ? $item->images['full'] : asset('assets/images/placeholder/600x400.jpg') }}"
                                                        class="img-fluid" alt="">
                                                </a>
                                            </div>

                                            <div class="card__post__body ">
                                                <div class="card__post__content">

                                                    <div class="card__post__author-info mb-2">
                                                        <ul class="list-inline">
                                                            <li class="list-inline-item">
                                                                <span class="text-primary">
                                                                    {{ $item->getCategory->name }}
                                                                </span>
                                                            </li>
                                                            <li class="list-inline-item">
                                                                <span class="text-dark text-capitalize">
                                                                    {{ $item->date }}
                                                                </span>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="card__post__title">
                                                        <h6>
                                                            <a href="{{ $item->url }}">
                                                                {!! $item->title !!}
                                                            </a>
                                                        </h6>

                                                    </div>

                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="d-flex justify-content-center mt-4 mb-3">

                            {{ $data->links() }}
                        </div>

                    </div>
                    <div class="col-md-12 col-lg-4">
                        @include('client.widget.popular-sidebar', ['title' => 'POPULER', 'data' => $popular, 'limit' =>
                        4])
                        @include('client.widget.advertise', ['data' => $popular, 'limit' => 4])
                        @include('client.widget.infografis', ['title' => 'INFOGRAFIS', 'data' => $popular, 'limit' =>
                        4])
                        @include('client.widget.social-media', ['data' => $popular, 'limit' => 4])
                        @include('client.widget.advertise', ['data' => $popular, 'limit' => 4])
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('client.layouts.footer')
</x-guest-layout>
