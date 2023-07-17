<x-guest-layout>
    @include('client.layouts.header', ['menu' => $menu, 'trending' => $trending ])
    @include('client.widget.headline', ['data' => $headline, 'limit' => 5, 'top' => $trending ])

    <section class="pt-0">
        <div class="popular__section-news">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-lg-8">
                        @include('client.widget.list-article', ['title' => 'TERKINI', 'data' => $terbaru, 'limit' => 8])
                        @include('client.widget.medium-list-article', ['title' => 'SUARA RAKYAT', 'data' => $suara_rakyat, 'limit' => 6])
                        @include('client.widget.list-article', ['title' => 'OPINI', 'data' => $opini, 'limit' => 8])
                        @include('client.widget.slide-news', ['title' => 'HUKUM', 'data' => $hukum, 'limit' => 8])
                    </div>
                    <div class="col-md-12 col-lg-4">
                        @include('client.widget.popular', ['title' => 'POPULER', 'data' => $popular, 'limit' => 4])
                        @include('client.widget.advertise', ['data' => $iklan_sidebar, 'limit' => 4])
                        @include('client.widget.infografis', ['title' => 'INFOGRAFIS', 'data' => $infografis, 'limit' => 4])
                        @include('client.widget.social-media', ['data' => $popular, 'limit' => 4])
                        @include('client.widget.advertise', ['data' => $iklan_sidebar, 'limit' => 4])
                        @include('client.widget.tag-sidebar', ['data' => $tags, 'limit' => 4])
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('client.layouts.footer')
</x-guest-layout>
