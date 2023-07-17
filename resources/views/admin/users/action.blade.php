{{-- <div class="content-header-right">
    <div class="dropdown">
        <button class="btn btn-primary btn-round btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-chevron-circle-down font-medium-3"></i></button>
        <div class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item" wire:click="confirmResetPassword({{ $row->id }})">
                <i class="mr-1 fas fa-key"></i>
                <span class="align-middle">Reset Password</span>
            </a>
            <a class="dropdown-item" href="{{ route('users.edit', $row->id) }}">
                <i class="mr-1 fas fa-edit"></i>
                <span class="align-middle">Edit</span>
            </a>
            <a type="button" class="dropdown-item" wire:click="deleteModal({{ $row->id }})">
                <i class="mr-1 fas fa-trash"></i>
                <span class="align-middle">Delete</span>
            </a>
        </div>
    </div>
</div> --}}
<div class="btn-group">
    <button type="button" class="btn btn-primary btn-icon rounded dropdown-toggle hide-arrow"
        data-bs-toggle="dropdown" aria-expanded="false">
        <i class="ti ti-select"></i>
    </button>
    <ul class="dropdown-menu dropdown-menu-end">
        <a class="dropdown-item" wire:click="confirmResetPassword({{ $row->id }})">
            <i class="mr-1 fas fa-key"></i>
            <span class="align-middle">Reset Password</span>
        </a>
        <a class="dropdown-item" href="{{ route('users.edit', $row->id) }}">
            <i class="mr-1 fas fa-edit"></i>
            <span class="align-middle">Edit</span>
        </a>
        <a type="button" class="dropdown-item" wire:click="deleteModal({{ $row->id }})">
            <i class="mr-1 fas fa-trash"></i>
            <span class="align-middle">Delete</span>
        </a>
    </ul>
</div>
