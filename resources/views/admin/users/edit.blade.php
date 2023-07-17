<x-master-layout>
    @section('title')
    Edit User
    @endsection
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <h5 class="fw-bold py-3 mb-2"><span class="text-muted fw-light">Dashboard / <a href="{{ route('users.index') }}">Users</a> /</span> Edit User</h6>

            <form class="form" method="POST" enctype="multipart/form-data" action="{{ route('users.update', $data['user']['id']) }}">
                @method('PUT')
                @csrf
                <div class="row justify-content-start">
                    <div class="col-12 col-md-7 col-xl-7">
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label text-primary fw-bold" for="basic-default">NAME</label>
                                    <input id="title" name="name" type="text" class="form-control"
                                        placeholder="Nama Lengkap" value="{{ $data['user']['name'] }}" required />
                                    @if ($errors->has('title'))<span
                                        class="text-danger">{{$errors->first('title')}}</span>@endif
                                </div>
                                <div class="mb-3">
                                    <label class="form-label text-primary fw-bold" for="basic-default">EMAIL</label>
                                    <input id="email" name="email" type="email" class="form-control"
                                        placeholder="cth :user@gmail.com" value="{{ $data['user']['email'] }}"
                                        required />
                                    @if ($errors->has('email'))<span
                                        class="text-danger">{{$errors->first('email')}}</span>@endif
                                </div>
                                <div class="mb-3">
                                    <label class="form-label text-primary fw-bold" for="basic-default">ROLE</label>
                                    <select name="roles" class="form-control" id="basicSelect" required>
                                        <option value="">-- PILIH --</option>
                                        @foreach ($data['roles'] as $item)
                                        <option value="{{ $item->name }}" {{ ($item->name == $data['current_role'] ? 'selected' : '') }}>{{ strtoupper($item->name)
                                            }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('roles'))
                                    <span class="text-danger">
                                        {{ $errors->first('roles') }}
                                    </span>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label class="form-label text-primary fw-bold" for="basic-default">TYPE</label>
                                    <div class="d-flex flex-row">
                                        @foreach (config('app.user_type') as $k=>$item)
                                        <div class="custom-control custom-control-success custom-checkbox">
                                            <input type="checkbox" name="user_type[]" value="{{ $k }}" class="form-check-input"
                                                @foreach ($data['user_type'] as $v) {{ ($k==$v ? 'checked' : '' ) }} @endforeach>
                                            <label class="custom-control-label me-1" for="colorCheck{{ $k }}">{{ $item }}</label>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-5 col-xl-5">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <label class="form-label text-primary fw-bold" for="basic-default">IMAGE</label>
                                    <div class="form-group mb-2">
                                        <div class="media flex-column text-center">
                                            <div class="media-body mt-1 w-100">
                                                <div class="d-inline-block">
                                                    <div class="form-group mb-0">
                                                        <div class="custom-file mb-1">
                                                            <input name="image" type="file" class="custom-file-input" id="image-crop" accept="image/*" />
                                                            @if ($errors->has('image'))<span
                                                                class="text-danger">{{$errors->first('image')}}</span>@endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="16_9_width" id="16_9_width" />
                                        <input type="hidden" name="16_9_height" id="16_9_height" />
                                        <input type="hidden" name="16_9_x" id="16_9_x" />
                                        <input type="hidden" name="16_9_y" id="16_9_y" />

                                        <input type="hidden" name="4_3_width" id="4_3_width" />
                                        <input type="hidden" name="4_3_height" id="4_3_height" />
                                        <input type="hidden" name="4_3_x" id="4_3_x" />
                                        <input type="hidden" name="4_3_y" id="4_3_y" />

                                        <input type="hidden" name="1_1_width" id="1_1_width" />
                                        <input type="hidden" name="1_1_height" id="1_1_height" />
                                        <input type="hidden" name="1_1_x" id="1_1_x" />
                                        <input type="hidden" name="1_1_y" id="1_1_y" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-4">
                        <div class="card">
                            <div class="card-body">
                                <button type="submit" class="btn btn-primary">SIMPAN</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        @include('admin.navigation.footer')

        <div class="content-backdrop fade"></div>
    </div>

    @include('admin.components.imagecropuser')

</x-master-layout>
