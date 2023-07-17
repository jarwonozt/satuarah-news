<aside class="wrapper__list__article">
    <h4 class="border_section">{{ $title }}</h4>
    @foreach ($data as $item)
    <div class="card__post__content p-0">
        <div class="card__post__author-info mb-2">
            <ul class="list-inline mb-0">
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
            <h5>
                <a href="{{ $item->url }}">
                    {{ $item->title }}
                </a>
            </h5>
        </div>
    </div>
    <hr>
    @endforeach

</aside>
