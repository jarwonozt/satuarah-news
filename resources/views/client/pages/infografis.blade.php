<x-guest-layout>
    @include('client.layouts.header', ['menu' => $menu ])
    <section class="bg-white pb-60">
        <div class="popular__section-news">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-lg-8">
                        <div class="wrapper__list__article">
                            <h4 class="border_section">INFOGRAFIS</h4>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row">
                                    @foreach ($data as $item)
                                        <div class="col-lg-6">
                                            <div class="article__entry-new">
                                                <div class="article__category">
                                                    {{ $item->title }}
                                                </div>
                                                <div class="article__image articel__image__transition">
                                                    <a href="{{ $item->slug }}">
                                                        <img src="{{ is_file(public_path($item->imagePath)) ? $item->imagePath : asset('assets/images/placeholder/500x400.jpg') }}" alt="" class="img-fluid">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="clearfix"></div>
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
                        @include('client.widget.tag-sidebar', ['data' => $popular, 'limit' => 4])
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('client.layouts.footer')
</x-guest-layout>

