<div class="col-12">
    <div class="card card-company-table">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Views</th>
                    </tr>
                    </thead>
                    <tbody>
                        @if (isset($data['posts']['data']))
                            @foreach ($data['posts']['data'] as $k=>$v)
                                <tr>
                                    <td>{!! $v['title'] !!}</td>
                                    <td>
                                        <div class="badge badge-light-primary">{{ $v['category'] }}</div>
                                    </td>
                                    <td class="text-nowrap">
                                        <div class="d-flex align-items-center">
                                            <span class="font-weight-bolder mr-1">
                                                {{ $v['counter'] }}
                                            </span>
                                            <i data-feather="trending-up" class="text-success font-medium-1"></i>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
