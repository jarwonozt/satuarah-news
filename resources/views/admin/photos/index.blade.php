<x-master-layout>
    @section('title')
        @lang('admin.photo.title')
    @endsection
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <h5 class="fw-bold py-3 mb-1"><span class="text-muted fw-light">Dashboard /</span> @lang('admin.photo.title')</h5>
            <div class="row mb-2">
                <div class="col">
                    <a href="{{ route('photos.create') }}" class="btn btn-primary">@lang('admin.photo.create')</a>
                </div>
            </div>

            @if (session()->has('message'))
            <div class="alert alert-primary alert-dismissible" role="alert">
                <div class="alert-body"><strong>{{ session('message') }}</strong></div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <div class="card">
                <div class="card-datatable table-responsive p-2">
                    <livewire:photo-table theme="bootstrap-5" />
                </div>
            </div>
        </div>
    </div>

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
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css" type="text/css" media="screen" />
    @endpush


</x-master-layout>
