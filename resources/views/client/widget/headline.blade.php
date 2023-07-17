<section>
    <div class="popular__news-header">
        <div class="container">
            <div class="row no-gutters">
                <div class="col-md-8 ">
                    <div class="card__post-carousel">
                        @isset($data)
                        @php($count = 0)
                        @foreach ($data as $item)
                        @php($count++)
                            <div class="item">
                                <div class="card__post">
                                    <div class="card__post__body">
                                        <a href="{{ $item->url }}">
                                            <img src="{{ is_file(public_path($item->images['full'])) ? $item->images['full'] : asset('assets/images/placeholder/800x600.jpg') }}" class="img-fluid" alt="">
                                        </a>
                                        <div class="card__post__content bg__post-cover">
                                            <div class="card__post__category">
                                                {{ $item->getCategory->name }}
                                            </div>
                                            <div class="card__post__title">
                                                <h5>
                                                    <a href="{{ $item->url }}">
                                                        {!! $item->title !!}
                                                    </a>
                                                </h5>
                                            </div>
                                            <div class="card__post__author-info">
                                                <ul class="list-inline">
                                                    <li class="list-inline-item">
                                                        <span>
                                                            {{ $item->date }}
                                                        </span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        @if($count == $limit)
                        @break
                        @endif
                        @endforeach
                        @endisset
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="popular__news-right">
                        @isset($top)
                            @php($count = 0)
                            @foreach ($top as $item)
                            @php($count++)
                                <div class="card__post">
                                    <div class="card__post__body card__post__transition">
                                        <a href="{{ $item->url }}">
                                            <img src="{{ is_file(public_path($item->images['full'])) ? $item->images['full'] : asset('assets/images/placeholder/600x400.jpg') }}" class="img-fluid" alt="">
                                        </a>
                                        <div class="card__post__content bg__post-cover">
                                            <div class="card__post__category">
                                                {{ $item->getCategory->name }}
                                            </div>
                                            <div class="card__post__title">
                                                <h6>
                                                    <a href="{{ $item->url }}" class="text-white">{{ $item->title }}</a>
                                                </h6>
                                            </div>
                                            <div class="card__post__author-info">
                                                <ul class="list-inline">
                                                    <li class="list-inline-item">
                                                        <span>
                                                            {{ $item->date }}
                                                        </span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            @if($count == 2)
                            @break
                            @endif
                            @endforeach
                        @endisset
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
