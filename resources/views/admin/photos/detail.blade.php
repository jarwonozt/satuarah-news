<x-master-layout>
    @section('title')
        @lang('admin.photo.title')
    @endsection
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <h5 class="fw-bold py-3 mb-2"><span class="text-muted fw-light">Dashboard / <a href="{{ route('photos.index') }}">@lang('admin.photo.title')</a> /</span> @lang('admin.photo.detail')</h6>
            <div class="row justify-content-start">
                <div class="col-12 col-md-4 col-xl-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <div class="form-group mb-2">
                                    <div class="media flex-column text-center">
                                        <img name="image" src="{{ $data->image ? $data->imagePath : asset('assets/images/dummy-image.jpeg') }}" alt="users avatar" class="user-avatar users-avatar-shadow rounded my-25 cursor-pointer" width="100%" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-8 col-xl-8">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="mb-1">{!! $data->title !!}</h5>
                            <span class="card-text">{!! $data->content !!}</span>
                        </div>
                    </div>
                </div>
                <div class="col-12 mt-4">
                    <div class="card user-card">
                        <div class="card-body">
                            <div class="user-info mb-1">
                                <div class="row">
                                    <div class="col-6">
                                        <h5 class="mb-1">Foto Terkait <span class="badge badge-light-primary">{{ $photoContent->count() }}</span></h5>
                                    </div>
                                    <div class="col-6 d-flex justify-content-end">
                                        <div class="form-group breadcrumb-right">
                                            <a href="{{ route('photolinkages.edit', $data->id) }}" class="btn btn-primary">@lang('admin.photo.create') @lang('admin.photo.linkage')</a>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-3">
                                        @livewire('photo-linkage-table', ['photo_id' => $data->id ])
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('admin.navigation.footer')

        <div class="content-backdrop fade"></div>
    </div>

    @push('scripts')
        <script>
            window.addEventListener('openModalDelete', event => {
                $("#delete-modal").modal('show');
            });

            window.addEventListener('closeModalDelete', event => {
                $("#delete-modal").modal('hide');
            });
        </script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css" type="text/css" media="screen" />
    @endpush
    @include('admin.components.texteditor')
</x-master-layout>
