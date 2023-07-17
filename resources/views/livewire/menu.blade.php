<div>
    <div class="row mb-2">
        <div class="col">
            <a href="#" wire:click.prevent="create" class="btn btn-primary">Tambah</a>
        </div>
    </div>

    @if (session()->has('message'))
    <div class="alert alert-primary alert-dismissible" role="alert">
        <div class="alert-body"><strong>{{ session('message') }}</strong></div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="card">
        <div class="table-responsive text-nowrap">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>NAMA</th>
                        <th>URL</th>
                        <th>OLEH</th>
                        <th>ACTIONS</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse ($rows as $item)
                    @if ($item->parent_id == 0)
                    <tr>
                        <td scope="row">
                            @if (!$item->parent_id)
                            <span class="badge badge-center rounded-pill bg-primary bg-glow">{{ $item->order }}</span>
                            @endif
                        </td>
                        <td>
                            @if ($item->parent_id)
                            <span class="badge badge-center rounded-pill bg-primary bg-glow">{{ $item->order }}</span>
                            @endif
                            <strong class="text-primary">{!! $item->name !!}</strong>
                        </td>
                        <td>{{ $item->slug }}</td>
                        {{-- <td class="text-center">
                            <span class="badge badge-light-primary">{{ $item->getParent($item->parent_id) }}</span>
                        </td> --}}
                        <td class="text-center">
                            <a href="#">
                                <div class="avatar" title="{!! 'Ditambahkan: '.$item->getAdd->name !!}" data-bs-toggle="tooltip" data-bs-placement="bottom">
                                    <img src="{{ $item->getAvatar($item->getAdd->name) }}" alt="Avatar" class="rounded-circle pull-up">
                                </div>
                            </a>
                        </td>
                        <td class="text-center">
                            <div class="btn-group btn-group-sm" role="group" aria-label="Action">
                                @if($item->order != 1)
                                <button wire:click.prevent="moveUp({{ $item->id }})" class="btn btn-primary" title="Up"><i
                                        class="fas fa-chevron-up"></i></button>
                                @endif
                                @if($item->order != $rows->count())
                                <button wire:click.prevent="moveDown({{ $item->id }})" class="btn btn-primary" title="Down"><i
                                        class="fas fa-chevron-down"></i></button>
                                @endif
                                <button wire:click.prevent="edit({{ $item }})" class="btn btn-primary" title="Edit"><i
                                        class="fas fa-pen"></i></button>
                                <button wire:click.prevent="editStatus({{ $item }})" class="btn btn-primary" title="Delete"><i
                                        class="fas fa-trash"></i></button>
                            </div>
                        </td>
                    </tr>
                    @endif
                    @foreach ($rows as $value)
                    @if($value->parent_id == $item->id)
                    <tr>
                        <td scope="row">
                            @if (!$value->parent_id)
                            <span class="badge badge-center rounded-pill bg-label-warning">{{ $value->order }}</span>
                            @endif
                        </td>
                        <td>
                            @if ($value->parent_id)
                            <span class="badge badge-center rounded-pill bg-label-warning">{{ $value->order }}</span>
                            @endif
                            <span class="text-primary ">{!! $value->name !!}</span>
                        </td>
                        <td>{{ $value->slug }}</td>
                        {{-- <td class="text-center">
                            <span class="badge badge-light-primary">{{ $value->getParent($value->parent_id) }}</span>
                        </td> --}}
                        <td>
                            <a href="#">
                                <div class="avatar" title="{!! 'Ditambahkan: '.$item->getAdd->name !!}" data-bs-toggle="tooltip"
                                    data-bs-placement="bottom">
                                    <img src="{{ $item->getAvatar($item->getAdd->name) }}" alt="Avatar" class="rounded-circle pull-up">
                                </div>
                            </a>
                        </td>
                        <td class="text-center">
                            <div class="btn-group btn-group-sm" role="group" aria-label="Action">
                                @if($value->order != 1)
                                <button wire:click.prevent="moveUp({{ $value->id }})" class="btn btn-primary" title="Up"><i
                                        class="fas fa-chevron-up"></i></button>
                                @endif
                                @if($value->order != $rows->count())
                                <button wire:click.prevent="moveDown({{ $value->id }})" class="btn btn-primary" title="Down"><i
                                        class="fas fa-chevron-down"></i></button>
                                @endif
                                <button wire:click.prevent="edit({{ $value }})" class="btn btn-primary" title="Edit"><i
                                        class="fas fa-pen"></i></button>
                                <button wire:click.prevent="editStatus({{ $value }})" class="btn btn-primary" title="Delete"><i
                                        class="fas fa-trash"></i></button>
                            </div>
                        </td>
                    </tr>
                    @endif
                    @endforeach

                    @empty
                    <tr>
                        <td colspan="6" class="text-center">
                            <div class="d-flex justify-content-center">
                                <img src="{{ asset('assets/empty.svg') }}" alt="" width="100">
                            </div>
                            <h4 class="text-muted">Ups! Data tidak tersedia 😳</h4>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @include('admin.menus.modal')
</div>
