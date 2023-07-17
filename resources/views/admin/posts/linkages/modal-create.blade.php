<div class="modal-size-default d-inline-block">
    <div class="modal fade text-left" id="create-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel18">Tambahkan Postingan Terkait <a href="/post/{{ $data['post']->slug }}" class="text-primary">{{ $data['post']->title }}</a></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <livewire:post-linkage-table parent_id="{{ $data['post']['id'] }}"/>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade text-left modal-primary" id="status-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel160">Update Status 😊</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                Apakah anda yakin ingin update status data tersebut!
            </div>
            <div class="modal-footer">
                <button wire:click.prevent="updateStatus()" type="button" class="btn btn-primary">Ok</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
