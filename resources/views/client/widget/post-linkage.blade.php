<div class="wrapper__list__article">
    <h4 class="border_section">{{ $title }}</h4>
</div>
<div class="row ">
    @php($count = 0)
    @foreach ($data as $item)
    @php($count++)
    <div class="col-sm-12 col-md-6">
        <div class="wrapp__list__article-responsive">
            <div class="mb-3">
                <div class="card__post card__post-list">
                    <div class="image-sm">
                        <a href="{{ $item->url }}">
                            <img src="{{ is_file(public_path($item->images['full'])) ? $item->images['full'] : asset('assets/images/placeholder/600x400.jpg') }}"
                                class="img-fluid" alt="">
                        </a>
                    </div>

                    <div class="card__post__body ">
                        <div class="card__post__content">

                            <div class="card__post__author-info mb-2">
                                <ul class="list-inline">
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
                                <h6>
                                    <a href="{{ $item->url }}">
                                        {!! $item->title !!}
                                    </a>
                                </h6>

                            </div>

                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
    @if($count == $limit)
    @break
    @endif
    @endforeach
</div>

