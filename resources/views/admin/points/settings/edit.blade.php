<x-master-layout>
    @section('title')
        @lang('admin.point.setting')
    @endsection
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <h5 class="fw-bold py-3 mb-2"><span class="text-muted fw-light">Dashboard / <a href="{{ route('points.index') }}">@lang('admin.point.title')</a> /<a href="{{ route('pointsettings.index') }}">@lang('admin.point.setting')</a> /</span> @lang('admin.point.edit') {{ $data['title'] }}</h5>

            @if (session()->has('message'))
            <div class="alert alert-primary alert-dismissible" role="alert">
                <div class="alert-body"><strong>{{ session('message') }}</strong></div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <section id="all-post">
                @if (session()->has('message'))
                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                    <div class="alert-body"><strong>{{ session('message') }}</strong></div>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                <div class="card card-company-table">
                    <div class="card-body p-0">
                        <form class="form-horizontal" role="form" id="coba" method="POST" enctype="multipart/form-data"
                            action="{{route('pointsettings.update', $data['id'])}}">
                            @method('PUT')
                            @csrf
                            <div class="card-body row">
                                <h5><span>Point Content Berita</span></h3>
                                @if(isset($data['data']))
                                @foreach($data['data'] as $k=>$v)
                                @if(isset($v['category']))
                                @foreach($v['category'] as $a=>$b)
                                <div class="form-group col-2">
                                    <label class="text-primary">{{$b['name']}}</label>
                                    <div>
                                        <input hidden name="modul[]" type="text" class="form-control col-md-5" value="{{ $k }}" />
                                        <input hidden name="category[]" type="number" class="form-control col-md-5"
                                            value="{{$b['category_id']}}" />
                                        <select name="point[]" class="form-control">
                                            @for($i=0;$i<=20;$i++) <option value="{{$i}}" @if($b['point']> 0)
                                                @if($b['point'] == $i)
                                                selected="selected"
                                                @endif
                                                @endif
                                                >{{$i}}</option>
                                                @endfor
                                        </select>
                                    </div>
                                </div>
                                @endforeach
                                @endif
                                @endforeach
                                @endif
                            </div>
                            <hr>
                            <div class="card-body row">
                                <h5><span>Point Content Photo & Video</span></h5>
                                @if(isset($data['data']))
                                @foreach($data['data'] as $k=>$v)
                                @if($k == 'post')
                                @continue
                                @endif
                                <div class="form-group col-2">
                                    <label class="text-primary text-capitalize">{{$k}}</label>
                                    <div>
                                        <input hidden name="modul[]" type="text" class="form-control col-md-5" value="{{ $k }}" />
                                        <input hidden name="category[]" type="number" class="form-control col-md-5"
                                            value="{{$b['category_id']}}" />
                                        <select name="point[]" class="form-control">
                                            @for($i=0;$i<=20;$i++) <option value="{{$i}}" @if($b['point']> 0)
                                                @if($b['point'] == $i)
                                                selected="selected"
                                                @endif
                                                @endif
                                                >{{$i}}</option>
                                                @endfor
                                        </select>
                                    </div>
                                </div>
                                @endforeach
                                @endif
                            </div>
                            <hr>
                            <div class="card-footer mt-3">
                                <div class="float-right">
                                    <button type="submit" class="btn btn-primary mr-1">Save</button>
                                    <a class="btn btn-secondary mr-1" href="{{ route('pointsettings.index') }}">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>


    @include('admin.navigation.footer')
    </div>

    @push('styles')
        <link rel="stylesheet" href="{{ asset('app-assets') }}/vendor/libs/select2/select2.css" />
        <link rel="stylesheet" href="{{ asset('app-assets') }}/vendor/libs/bootstrap-select/bootstrap-select.css" />
    @endpush

    @push('scripts')
    <script src="{{ asset('app-assets') }}/vendor/libs/select2/select2.js"></script>
    <script src="{{ asset('app-assets') }}/vendor/libs/bootstrap-select/bootstrap-select.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            $(function () {
                $('[data-toggle="tooltip"]').tooltip()
            })
            Livewire.hook('message.processed', (message, component) => {
                $(function () {
                    $('[data-toggle="tooltip"]').tooltip()
                })
            })
        });

        window.addEventListener('openModalEdit', event => {
        $("#edit-modal").modal('show');
        });

        window.addEventListener('closeModalEdit', event => {
        $("#edit-modal").modal('hide');
        });

        window.addEventListener('openModalDetail', event => {
        $("#detail-modal").modal('show');
        });

        window.addEventListener('openModalStatus', event => {
        $("#status-modal").modal('show');
        });

        window.addEventListener('closeModalStatus', event => {
        $("#status-modal").modal('hide');
        });

        window.addEventListener('openModalResetPasswordSuccess', event => {
            $("#resetpasswordsuccess-modal").modal('show');
        });

        window.addEventListener('openModalResetPassword', event => {
            $("#resetpassword-modal").modal('show');
        });

        window.addEventListener('closeModalResetPassword', event => {
            $("#resetpassword-modal").modal('hide');
        });

        window.addEventListener('openModalDelete', event => {
            $("#delete-modal").modal('show');
        });

        window.addEventListener('closeModalDelete', event => {
            $("#delete-modal").modal('hide');
        });

        window.addEventListener('openModalDeleteSelected', event => {
        $("#delete-modal-selected").modal('show');
        });

        window.addEventListener('closeModalDeleteSelected', event => {
        $("#delete-modal-selected").modal('hide');
        });
    </script>
    <script src="{{ asset('app-assets') }}/vendor/js/dropdown-hover.js"></script>
    @endpush


</x-master-layout>
