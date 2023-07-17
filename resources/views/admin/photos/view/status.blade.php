@if($row->status == 1)
<div class="avatar avatar-sm me-2">
    <a type="button" wire:click="statusModal({{ $row->id }})">
        <div class="avatar-initial rounded-circle bg-label-success">
            <i class="avatar-icon fa fa-check font-medium-2"></i>
        </div>
    </a>
</div>
@else
<div class="avatar avatar-sm me-2">
    <a type="button" wire:click="statusModal({{ $row->id }})">
        <div class="avatar-initial rounded-circle bg-label-danger">
            <i class="avatar-icon fa fa-ban font-medium-2"></i>
        </div>
    </a>
</div>
@endif
