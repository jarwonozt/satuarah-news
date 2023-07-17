<x-master-layout>
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-7 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h3 class="content-header-title float-left mb-0">Menu</h3>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="/dashboard">Home</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('menus.index') }}">List Video</a>
                                    </li>
                                    <li class="breadcrumb-item active">Create</li>
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
                                <form class="form" method="POST" enctype="multipart/form-data" action="{{ route('menus.store') }}">
                                    @csrf
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12 col-12">

                                                <div class="form-group">
                                                    <h5 class="text-primary">NAMA</h5>
                                                    <input id="title" name="title" type="text" class="form-control" placeholder="Nama Menu" value="{{ old('title') }}" required/>
                                                    @if ($errors->has('title'))<span class="text-danger">{{$errors->first('title')}}</span>@endif
                                                </div>

                                                <div class="form-group">
                                                    <h5 class="text-primary">SLUG</h5>
                                                    <div class="alert alert-primary" role="alert">
                                                        <div class="alert-body"><strong id="text-slug"> {{ old('slug') }}</strong></div>
                                                    </div>
                                                    <span id="input-slug" style="display:none;">
                                                        <input name="slug" type="text" id="slug" class="form-control mb-1" value="{{old('slug') }}"/>
                                                        <button type="button" class="btn btn-primary btn-xs" id="simpan_slug">OK</button>
                                                        <button type="button" class="btn btn-secondary btn-xs" id="close_slug">Cancel</button>
                                                    </span>
                                                    @if ($errors->has('slug'))<span class="text-danger">{{$errors->first('slug')}}</span>@endif
                                                </div>

                                                <div class="form-group">
                                                    <h5 class="text-primary">KATEGORI</h5>
                                                    <select name="category_id" class="form-control" id="basicSelect">
                                                        <option value="">-- Pilih Kategori --</option>
                                                        @foreach ($categories as $item)
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
                                                        <option value="">-- Pilih Parent --</option>
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
                                                            <input name="type" type="radio" id="customRadio3" class="custom-control-input" value="2" checked/>
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

    @include('admin.components.slug')
    @include('admin.components.texteditor')

    @push('styles')
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/plugins/forms/pickers/form-flat-pickr.css')}}">
    @endpush

    @push('scripts')
    <script src="{{asset('app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js')}}"></script>
    <script src="{{asset('app-assets/js/scripts/forms/pickers/form-pickers.js')}}"></script>
    @endpush
</x-master-layout>
