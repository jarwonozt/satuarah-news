<x-master-layout>
    @section('title')
        @lang('admin.point.setting')
    @endsection
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <h5 class="fw-bold py-3 mb-2"><span class="text-muted fw-light">Dashboard / <a href="{{ route('points.index') }}">@lang('admin.point.title')</a> /</span> @lang('admin.point.setting')</h5>
            <div class="row mb-2">
                <div class="col">
                    <div class="modal fade text-left modal-primary" id="createCategory" tabindex="-1" role="dialog"
                        aria-labelledby="myModalLabel160" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true"></span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="text-center mb-4">
                                        <h3 class="mb-2">@lang('admin.category.create')</h3>
                                    </div>
                                    <form action="{{ route('pagecategories.store') }}" method="POST" class="row g-3">
                                        @csrf
                                        <div class="col-12">
                                            <h6 class="form-label text-primary text-uppercase" for="modalAddCardName">@lang('admin.form.name')</label>
                                            <input type="text" name="name" id="modalAddCardName" class="form-control" />
                                        </div>
                                        <div class="col-12">
                                            <h6 class="form-label text-primary text-uppercase" for="modalAddCardName">@lang('admin.form.description')</h6>
                                            <textarea name="description" id="modalAddCardName" class="form-control" rows="3"></textarea>
                                        </div>
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary me-sm-3 me-1">@lang('admin.save')</button>
                                            <button type="reset" class="btn btn-label-secondary btn-reset" data-bs-dismiss="modal"
                                                aria-label="Close">@lang('admin.cancel')</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if (session()->has('message'))
            <div class="alert alert-primary alert-dismissible" role="alert">
                <div class="alert-body"><strong>{{ session('message') }}</strong></div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <section id="all-post">
                <div class="card card-company-table">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (isset($data))
                                    @foreach ($data as $k=>$v)
                                    <tr>
                                        <td class="text-nowrap">{{$v['name']}}</td>
                                        <td class="text-center">
                                            <a class="btn btn-sm btn-primary" href="{{ route('pointsettings.edit', $v['id']) }}">
                                                <span class="align-middle">Edit</span>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
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
