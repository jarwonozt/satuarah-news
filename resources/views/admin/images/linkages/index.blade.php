<x-master-layout>
    @section('title')
        @lang('admin.post.linkage.title')
    @endsection
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <h5 class="fw-bold py-3 mb-2"><span class="text-muted fw-light">Dashboard / <a href="{{ route('posts.index') }}">@lang('admin.post.title')</a> /</span> @lang('admin.post.linkage.title')</h6>
            <div class="row mb-2">
                <div class="col">
                    <button type="button" id="create" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal"
                        data-bs-target="#create-modal">
                        @lang('admin.post.linkage.create')
                    </button>
                </div>
            </div>
            @if (session()->has('message'))
            <div class="alert alert-primary alert-dismissible" role="alert">
                <div class="alert-body"><strong>{{ session('message') }}</strong></div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            <div class="row">
                <div class="col-12 mb-2">
                    <div class="card user-card">
                        <div class="card-body">
                            <div class="user-info mb-1">
                                <h4 class="mb-1">{!! $data['post']['title'] !!}</h4>
                                <span class="card-text">{!! $data['post']['preview'] !!}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-datatable table-responsive p-2">
                    <livewire:linkage-table theme="bootstrap-5" />
                </div>
            </div>
        </div>
    </div>
    @include('admin.posts.linkages.modal-create')

    @include('admin.navigation.footer')
    </div>

    @push('scripts')
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
