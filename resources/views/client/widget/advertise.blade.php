<aside class="wrapper__list__article">
    <h4 class="border_section">Advertise</h4>
    <div class="card__post-carousel">
        @isset($data)
        @php($count = 0)
        @foreach ($data as $item)
        @php($count++)
        <div class="item">
            <div class="card__post">
                <div class="card__adv__body">
                    <a href="{{ $item->slug }}">
                        <img src="{{ is_file(public_path($item->imagePath)) ? $item->imagePath : asset('assets/images/placeholder/800x600.jpg') }}"
                            class="img-fluid" alt="">
                    </a>
                </div>
            </div>
        </div>
        @if($count == $limit)
        @break
        @endif
        @endforeach
        @endisset
    </div>
</aside>
