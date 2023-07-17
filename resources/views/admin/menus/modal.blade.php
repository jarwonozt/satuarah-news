<div class="modal-size-lg d-inline-block">
    <div class="modal fade text-left" id="form" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel18">
                        @if($showEditModal)
                        <span>Edit Menu</span>
                        @else
                        <span>Buat Menu</span>
                        @endif
                    </h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"></span>
                    </button>
                </div>
                <form autocomplete="off" wire:submit.prevent="{{ $showEditModal ? 'update' : 'store' }}">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group mb-2">
                            <label class="form-label text-primary fw-bold" for="basic-default">NAMA</label>
                            <input wire:model.defer="name" id="name" type="text" class="form-control"/>
                            @if ($errors->has('name'))<span class="text-danger">{{$errors->first('name')}}</span>@endif
                        </div>
                        <div class="form-group mb-2">
                            <label class="form-label text-primary fw-bold" for="basic-default">URL</label>
                            <input wire:model.defer="slug" id="slug" type="text" class="form-control"/>
                            @if ($errors->has('slug'))<span class="text-danger">{{$errors->first('slug')}}</span>@endif
                        </div>
                        {{-- <div class="form-group mb-2">
                            <h5 class="text-primary">KATEGORI</h5>
                            <select wire:model.defer="category_id" class="form-control" id="basicSelect">
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
                        </div> --}}
                        <div class="form-group mb-2">
                            <label class="form-label text-primary fw-bold" for="basic-default">PARENT</label>
                            <select wire:model.defer="parent_id" class="form-control" id="basicSelect">
                                <option value="0"> -- No Parent -- </option>
                                @foreach ($row_category as $item)
                                <option value="{{ $item->id }}" {{ ($item->id == $parent_id ? 'selected' : '') }}>{!! $item->name !!}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-2">
                            <label class="form-label text-primary fw-bold" for="basic-default">TYPE</label>
                            <select wire:model.defer="type" class="form-control" id="basicSelect">
                                <option value="0" {{ ($type == 0 ? 'selected' : '') }}>NONE</option>
                                <option value="1" {{ ($type == 1 ? 'selected' : '') }}>SUBMENU</option>
                            </select>
                        </div>

                        <div class="form-group mb-2">
                            <label class="form-label text-primary fw-bold" for="basic-default">STATUS</label>
                            <div class="d-flex flex-row">
                                <div class="custom-control custom-radio">
                                    {{-- <input name="default-radio-1" class="form-check-input" type="radio" value="" id="defaultRadio2" checked />
                                    <label class="form-check-label" for="defaultRadio2"> Checked </label> --}}
                                    <input
                                        name="status"
                                        wire:model.defer="status"
                                        class="form-check-input"
                                        type="radio"
                                        id="defaultRadio1"
                                        value="1"
                                        {{ ($status == 1 ? 'checked' : '') }}
                                        />
                                    <label class="form-check-label" for="defaultRadio1"> Aktif </label>
                                </div>
                                <div class="custom-control custom-radio ms-2">
                                    <input
                                        name="status"
                                        wire:model.defer="status"
                                        class="form-check-input"
                                        type="radio"
                                        id="defaultRadio2"
                                        value="0"
                                        {{ ($status == 0 ? 'checked' : '') }}
                                        />
                                    <label class="form-check-label" for="defaultRadio2"> Nonaktif </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade text-left modal-primary" id="status" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel160">Hapus Data 😊</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"></span>
                </button>
            </div>
            <div class="modal-body">
                Apakah anda yakin ingin hapus data tersebut!
            </div>
            <div class="modal-footer">
                <button wire:click.prevent="deleteMenu()" type="button" class="btn btn-primary">Ok</button>
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
