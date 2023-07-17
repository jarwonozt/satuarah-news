@section('title')
    Menu
@endsection
<x-master-layout>
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <h5 class="fw-bold py-3 mb-1"><span class="text-muted fw-light">Dashboard /</span> Menu</h5>

        @livewire('menu')
    </div>
</div>


@include('admin.navigation.footer')
</div>

@push('scripts')
    <script>
        window.addEventListener('show-form', event => {
            $('#form').modal('show');
        })
        window.addEventListener('hide-form', event => {
            $('#form').modal('hide');
        })
        window.addEventListener('show-status', event => {
            $('#status').modal('show');
        })
        window.addEventListener('hide-status', event => {
            $('#status').modal('hide');
        })
    </script>
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
    </script>
@endpush
</x-master-layout>
