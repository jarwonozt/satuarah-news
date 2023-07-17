<div class="btn-group">
    <button type="button" class="btn btn-primary btn-icon rounded dropdown-toggle hide-arrow" data-bs-toggle="dropdown"
        aria-expanded="false">
        <i class="ti ti-select"></i>
    </button>
    <ul class="dropdown-menu dropdown-menu-end">
        <a class="dropdown-item" href="{{ route('offices.edit', $row->id) }}">
            <i class="mr-1 fas fa-edit"></i>
            <span class="align-middle">Edit</span>
        </a>
        <a type="button" class="dropdown-item" wire:click="deleteModal({{ $row->id }})">
            <i class="mr-1 fas fa-trash"></i>
            <span class="align-middle">Delete</span>
        </a>
    </ul>
</div>
