<x-guest-layout>
    @include('client.layouts.header', ['menu' => $menu ])
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class="breadcrumbs bg-light mb-4">
                        <li class="breadcrumbs__item">
                            <a href="/" class="breadcrumbs__url">
                                <i class="fa fa-home"></i> Home</a>
                        </li>
                        <li class="breadcrumbs__item">
                            <a href="#" class="breadcrumbs__url">Page</a>
                        </li>
                        <li class="breadcrumbs__item breadcrumbs__item--current">
                            {{ $data->title }}
                        </li>
                    </ul>

                    <div class="wrap__about-us">
                        <h2>{!! $data->title !!}</h2>
                        {!! $data->content !!}
                        <div class="clearfix"></div>

                    </div>
                </div>


            </div>
        </div>
    </section>
</x-guest-layout>
