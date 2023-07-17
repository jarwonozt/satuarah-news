<x-master-layout>
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-body">
                <section id="dashboard-analytics">
                    <div class="row match-height">
                        <div class="col-lg-6 col-12">
                            <div class="card card-revenue-budget">
                                <div class="row mx-0">
                                    <div class="col-md-12 col-12 revenue-report-wrapper">
                                        <div class="d-sm-flex justify-content-between align-items-center mb-3">
                                            <h4 class="card-title mb-50 mb-sm-0">Top Post</h4>
                                        </div>
                                        <div>
                                            @if (!empty($chartPost))
                                                {!! $chartPost->container() !!}
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="card card-revenue-budget">
                                <div class="row mx-0">
                                    <div class="col-md-12 col-12 revenue-report-wrapper">
                                        <div class="d-sm-flex justify-content-between align-items-center mb-3">
                                            <h4 class="card-title mb-50 mb-sm-0">Top Point</h4>
                                        </div>
                                        <div>
                                            @if (!empty($chart))
                                                {!! $chart->container() !!}
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <script src="{{ $chart ? $chart->cdn() : null }}"></script>

    @if (!empty($chart) && !empty($chartPost))
        {{ $chart->script() }}
        {{ $chartPost->script() }}
    @endif
    @push('scripts')

    @endpush
</x-master-layout>

