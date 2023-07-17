<aside class="wrapper__list__article mb-4">
    <a href="/suara-rakyat">
        <h4 class="border_section">{{ $title }}</h4>
    </a>
    <div class="row">
        @php($count = 0)
        @foreach ($data as $item)
        @php($count++)
            <div class="col-md-6">
                <div class="mb-4">
                    <div class="article__image">
                        <a href="{{ $item->url }}">
                            <img src="{{ is_file(public_path($item->images['full'])) ? $item->images['full'] : asset('assets/images/placeholder/600x400.jpg') }}" alt="" class="img-fluid">
                        </a>
                    </div>
                    <div class="article__entry">
                        <div class="article__content">
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <span>
                                        {{ $item->date }}
                                    </span>
                                </li>

                            </ul>
                            <h5>
                                <a href="{{ $item->url }}">
                                    {!! $item->title !!}
                                </a>
                            </h5>

                        </div>
                    </div>
                </div>
            </div>
        @if($count == $limit)
        @break
        @endif
        @endforeach
    </div>
    <div class="text-center">
        <a href="/suara-rakyat" class="btn btn-sm btn-outline-primary mb-4 text-capitalize"> read more</a>
    </div>
</aside>
