<x-master-layout>
    @section('title')
        @lang('admin.point.title')
    @endsection
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <h5 class="fw-bold py-3 mb-2"><span class="text-muted fw-light">Dashboard /</span>@lang('admin.point.title')</h5>
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
                                        <h3 class="mb-2">@lang('admin.point.setting')</h3>
                                    </div>
                                    <form action="{{ route('points.store') }}" method="POST" class="row g-3">
                                        @csrf
                                        <div class="col-12">
                                            <h6 class="form-label text-primary text-uppercase" for="modalAddCardName">
                                                @lang('admin.form.name')</label>
                                                <input type="text" name="name" id="modalAddCardName"
                                                    class="form-control" />
                                        </div>
                                        <div class="col-12">
                                            <h6 class="form-label text-primary text-uppercase" for="modalAddCardName">
                                                @lang('admin.form.description')</h6>
                                            <textarea name="description" id="modalAddCardName" class="form-control"
                                                rows="3"></textarea>
                                        </div>
                                        <div class="col-12">
                                            <button type="submit"
                                                class="btn btn-primary me-sm-3 me-1">@lang('admin.save')</button>
                                            <button type="reset" class="btn btn-label-secondary btn-reset"
                                                data-bs-dismiss="modal"
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
                <form method="get" action="{{ route('points.index') }}">
                    <div class="d-flex justify-content-end align-items-end">
                        <div class="form-group me-4">
                            <a href="{{ route('pointsettings.index') }}" id="create" class="btn btn-primary waves-effect waves-light">
                                @lang('admin.point.setting')
                            </a>
                        </div>
                        <div class="form-group me-2">
                            <h6 class="text-primary">BULAN</h6>
                            <select name="month" class="form-control">
                                @foreach($data['date']['month'] as $k=>$v)
                                <option value="{{ $k }}" @if($k==$data['date_now']['month']) selected @endif>{{ $v }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group me-2">
                            <h6 class="text-primary">TAHUN</h6>
                            <select name="year" class="form-control">
                                @foreach($data['date']['years'] as $k=>$v)
                                <option value="{{ $k }}" @if($k==$data['date_now']['year']) selected @endif>{{ $v }}&nbsp;&nbsp;
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group ml-1">
                            <button type="submit" class="btn-icon btn btn-primary btn-round btn-md">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
                <div class="card card-company-table mt-2">
                    <div class="card-body p-0">
                        {{-- {{ $month .'+'. $year }} --}}
                        <div wire:loading></div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>Name</th>
                                        <th class="text-center">Post</th>
                                        <th class="text-center">Viewed</th>
                                        <th class="text-center">Point</th>
                                        {{-- <th class="text-center">Action</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @isset($data['data'])
                                        @foreach ($data['data'] as $k=>$v)
                                        <tr>
                                            <td>
                                                {{ $k+1 }}
                                            </td>
                                            <td>
                                                <span class="font-weight-bold">{!! $v['name'] !!}</span>
                                            </td>
                                            <td class="text-center">
                                                <div class="badge bg-primary">
                                                    <span>{{ $v['total_post'] }}</span>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <div class="badge bg-primary">
                                                    <span>{{ $v['total_view']}}</span>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <div class="badge bg-primary">
                                                    <span>{{ $v['total_point']}}</span>
                                                </div>
                                            </td>
                                            {{-- <td class="text-center">
                                                <div class="content-header-right">
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-primary btn-icon rounded dropdown-toggle hide-arrow" data-bs-toggle="dropdown"
                                                            aria-expanded="false">
                                                            <i class="ti ti-select"></i>
                                                        </button>
                                                        <ul class="dropdown-menu dropdown-menu-end">
                                                            <a href="#" class="dropdown-item">
                                                                <i class="mr-1 fas fa-eye"></i>
                                                                <span class="align-middle">View</span>
                                                            </a>
                                                            <a class="dropdown-item" href="#">
                                                                <i class="mr-1 fas fa-edit"></i>
                                                                <span class="align-middle">Edit</span>
                                                            </a>
                                                            <a type="button" class="dropdown-item">
                                                                <i class="mr-1 fas fa-trash"></i>
                                                                <span class="align-middle">Delete</span>
                                                            </a>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </td> --}}
                                        </tr>
                                        @endforeach
                                    @endisset
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
