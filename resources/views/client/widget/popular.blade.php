<aside class="wrapper__list__article">
    <h5 class="border_section">{{ $title }}</h5>
    <div class="wrapper__list-number">
        @php($count = 0)
        @foreach ($data as $item)
        @php($count++)
            <div class="card__post__list">
                <div class="list-number">
                    <span>
                        {{ $loop->index + 1 }}
                    </span>
                </div>
                <a href="/{{ $item->getCategory->slug }}" class="category">
                    {{ $item->getCategory->name }}
                </a>
                <ul class="list-inline">
                    <li class="list-inline-item">

                        <h5>
                            <a href="{{ $item->url }}">
                                {{ $item->title }}
                            </a>
                        </h5>
                    </li>
                </ul>

            </div>
        @if($count == $limit)
        @break
        @endif
        @endforeach
    </div>
</aside>
