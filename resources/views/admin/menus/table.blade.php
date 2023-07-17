
<x-livewire-tables::table.cell>
    @if($row->type == 1)
        <span class="text-primary"><i class="fa fa-star"></i></span>
    @endif
    <span class="font-weight-bold">{!! ucwords($row->name) !!}</span>

</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    <div><a class="badge badge-light-primary" href="{{ config('app.url').'/'.$row->slug }}">{{ config('app.url').'/'.$row->slug }}</a></div>
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    <span>{{ isset($row->getCategory->name) ? $row->getCategory->name : '' }}</span>
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    <div class="badge badge-light-danger">{{ strtoupper($row->getAdd->name) }}</div>
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    @if($row->status == 1)
        <div class="avatar bg-light-success rounded">
            <a type="button" wire:click="statusModal({{ $row->id }})">
                <div class="avatar-content">
                    <i class="avatar-icon fa fa-check font-medium-2"></i>
                </div>
            </a>
        </div>
    @else
        <div class="avatar bg-light-danger rounded">
            <a type="button" wire:click="statusModal({{ $row->id }})">
                <div class="avatar-content">
                    <i class="avatar-icon fa fa-times font-medium-2"></i>
                </div>
            </a>
        </div>
    @endif
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    <div class="btn-group" role="group" aria-label="Basic example">
        <a wire:click="moveUp({{ $row->id }})" href="" type="button" class="btn btn-sm btn-primary"><i class="fas fa-chevron-up"></i></a>
        <a wire:click="moveDown({{ $row->id }})" type="button" class="btn btn-sm btn-primary"><i class="fas fa-chevron-down"></i></a>
        <a wire:click="deleteModal({{ $row->id }})" type="button" class="btn btn-sm btn-primary"><i class="fas fa-pen"></i></a>
        <a href="{{ route('menus.edit', $row->id) }}" type="button" class="btn btn-sm btn-primary"><i class="fas fa-trash"></i></a>
    </div>
</x-livewire-tables::table.cell>
