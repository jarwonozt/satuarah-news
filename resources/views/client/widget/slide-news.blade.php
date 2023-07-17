<div class="related-article mt-4">
    <h4>
        {{ $title }}
    </h4>

    <div class="article__entry-carousel-three">
        @foreach ($data as $item)
        @if ($loop->index < $limit) <div class="item">
            <div class="article__entry">
                <a href="{{ $item->url }}">
                    <img src="{{ is_file(public_path($item->images['medium'])) ? $item->images['thumbnail'] : asset('assets/images/placeholder/500x400.jpg') }}"
                        alt="" class="img-fluid">
                </a>
                <div class="article__image">
                </div>
                <div class="article__content">
                    <ul class="list-inline">
                        <li class="list-inline-item">
                            <span class="text-primary">
                                {{ $item->getCategory->name }}
                            </span>
                        </li>
                        <li class="list-inline-item">
                            <span>
                                {{ $item->date }}
                            </span>
                        </li>

                    </ul>
                    <b>
                        <a href="{{ $item->url }}" class="text-dark">
                            {{ $item->title }}
                        </a>
                    </b>

                </div>
            </div>
    </div>
    @endif
    @endforeach
</div>
</div>
