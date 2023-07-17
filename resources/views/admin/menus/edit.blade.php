<x-master-layout>
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-7 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h3 class="content-header-title float-left mb-0">Video</h3>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="/dashboard">Home</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('menus.index') }}">List Menu</a>
                                    </li>
                                    <li class="breadcrumb-item active">Edit</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <section id="multiple-column-form">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <form class="form" method="POST" enctype="multipart/form-data" action="{{ route('menus.update', $data['menu']['id']) }}">
                                    @method('PUT')
                                    @csrf
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12 col-12">

                                                <div class="form-group">
                                                    <h5 class="text-primary">JUDUL</h5>
                                                    <input id="title" name="title" type="text" class="form-control" placeholder="Judul Video" value="{{ $data['menu']['name']}}"/>
                                                    @if ($errors->has('title'))<span class="text-danger">{{$errors->first('title')}}</span>@endif
                                                </div>

                                                <div class="form-group">
                                                    <h5 class="text-primary">SLUG</h5>
                                                    <div class="alert alert-primary" role="alert">
                                                        <div class="alert-body"><strong id="text-slug"> {{ $data['menu']['slug'] }}</strong></div>
                                                    </div>
                                                    <span id="input-slug" style="display:none;">
                                                        <input name="slug" type="text" id="slug" class="form-control mb-1" value="{{ $data['menu']['slug'] }}"/>
                                                        <button type="button" class="btn btn-primary btn-xs" id="simpan_slug">OK</button>
                                                        <button type="button" class="btn btn-secondary btn-xs" id="close_slug">Cancel</button>
                                                    </span>
                                                    @if ($errors->has('slug'))<span class="text-danger">{{$errors->first('slug')}}</span>@endif
                                                </div>
                                                <div class="form-group">
                                                    <h5 class="text-primary">KATEGORI</h5>
                                                    <select name="category_id" class="form-control" id="basicSelect">
                                                        <option value="{{ isset($data['menu']['category_id']) ? $data['menu']['category_id'] : null }}">{{ isset($data['menu']->getCategory->name) ? $data['menu']->getCategory->name : 'Kosong' }}</option>
                                                        <option value="">-- Pilih --</option>
                                                        @foreach ($data['categories'] as $item)
                                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @if ($errors->has('category_id'))
                                                    <span class="text-danger">
                                                        {{ $errors->first('category_id') }}
                                                    </span>
                                                    @endif
                                                </div>

                                                <div class="form-group">
                                                    <h5 class="text-primary">PARENT MENU</h5>
                                                    <select name="parent_id" class="form-control" id="basicSelect">
                                                        <option value="{{ isset($data['parent']['id']) ? $data['parent']['id'] : null }}">{{ isset($data['parent']['name']) ? $data['parent']['name'] : 'Kosong' }}</option>
                                                        <option value="">-- Pilih --</option>
                                                            {!! $data['treeKategori'] !!}
                                                    </select>
                                                </div>

                                                <div class="form-group border rounded p-1">
                                                    <h5 class="text-primary">TYPE</h5>
                                                    <div class="d-flex flex-row">
                                                        <div class="custom-control custom-radio">
                                                            <input name="type" type="radio" id="customRadio2" class="custom-control-input" value="1"/>
                                                            <label class="custom-control-label" for="customRadio2">SUBMENU</label>
                                                        </div>
                                                        <div class="custom-control custom-radio ml-2">
                                                            <input name="type" type="radio" id="customRadio3" class="custom-control-input" value="0" checked/>
                                                            <label class="custom-control-label" for="customRadio3">NONE</label>
                                                        </div>
                                                    </div>
                                                    @if ($errors->has('type'))<span class="text-danger">{{$errors->first('type')}}</span>@endif
                                                </div>

                                                <div class="form-group border rounded p-1">
                                                    <h5 class="text-primary">STATUS</h5>
                                                    <div class="d-flex flex-row">
                                                        <div class="custom-control custom-radio">
                                                            <input name="status" type="radio" id="customRadio4" class="custom-control-input" value="1" checked/>
                                                            <label class="custom-control-label" for="customRadio4">Aktif</label>
                                                        </div>
                                                        <div class="custom-control custom-radio ml-2">
                                                            <input name="status" type="radio" id="customRadio5" class="custom-control-input" value="0"/>
                                                            <label class="custom-control-label" for="customRadio5">Tidak</label>
                                                        </div>
                                                    </div>
                                                    @if ($errors->has('status'))<span class="text-danger">{{$errors->first('status')}}</span>@endif
                                                </div>
                                                <div class="form-group border rounded p-1">
                                                    <button type="submit" class="btn btn-primary mr-1">Simpan</button>
                                                    <button type="reset" class="btn btn-outline-secondary">Reset</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

    @include('admin.components.imagecrop')
    @include('admin.components.slug')
    @include('admin.components.texteditor')

    @push('styles')
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/plugins/forms/pickers/form-flat-pickr.css')}}">
    @endpush

    @push('scripts')
    <script src="{{asset('app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js')}}"></script>
    <script src="{{asset('app-assets/js/scripts/forms/pickers/form-pickers.js')}}"></script>
    <script>
        $(function () {
            var changePicture = $('#change-picture'),
                userAvatar = $('.user-avatar'),
                languageSelect = $('#users-language-select2'),
                form = $('.form-validate'),
                birthdayPickr = $('.birthdate-picker');

            // Change user profile picture
            if (changePicture.length) {
                $(changePicture).on('change', function (e) {
                var reader = new FileReader(),
                    files = e.target.files;
                reader.onload = function () {
                    if (userAvatar.length) {
                    userAvatar.attr('src', reader.result);
                    }
                };
                reader.readAsDataURL(files[0]);
                });
            }
        });
    </script>
    @endpush
</x-master-layout>
