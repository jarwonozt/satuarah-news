<x-master-layout>
    @section('title')
        @lang('admin.service.title')
    @endsection
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <h5 class="fw-bold py-3 mb-1"><span class="text-muted fw-light">Dashboard /</span> @lang('admin.service.title')</h5>
            <div class="row mb-2">
                <div class="col">
                    <a href="{{ route('services.create') }}" class="btn btn-primary">@lang('admin.service.create')</a>
                    <a href="{{ route('servicecategories.index') }}" class="btn btn-outline-primary waves-effect">@lang('admin.category.title')</a>
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
                    <livewire:service-table theme="bootstrap-5" />
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
    @endpush


</x-master-layout>
