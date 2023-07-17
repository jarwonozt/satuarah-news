<div class="modal fade text-left modal-primary" id="delete-modal" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel160" aria-hidden="true">
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
                <button wire:click.prevent="deleteStatus()" type="button" class="btn btn-primary">Ok</button>
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade text-left modal-primary" id="delete-modal-selected" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel160" aria-hidden="true">
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
                <button wire:click.prevent="deleteSelected()" type="button" class="btn btn-primary">Ok</button>
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
