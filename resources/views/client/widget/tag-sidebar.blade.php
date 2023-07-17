<aside class="wrapper__list__article">
    <h4 class="border_section">tags</h4>
    <div class="blog-tags p-0">
        <ul class="list-inline">
            @foreach ($data as $item)
                <li class="list-inline-item">
                    <a href="{{ $item->url }}">
                        #{{ $item->title }}
                    </a>
                </li>
            @endforeach

        </ul>
    </div>
</aside>
