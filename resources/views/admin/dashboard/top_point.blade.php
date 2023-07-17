<div class="col-lg-4 col-md-6 col-12">
    <div class="card card-congratulation-medal bg-light-primary">
        <div class="card-body">
            <div class="text-center">
                <div class="avatar avatar-xl bg-primary shadow">
                    <div class="avatar-content">
                        @if (!empty($data['top_point'][0]['picture']))
                            <img class="round" src="{{ '/storage/pictures/users/mid/'.$data['top_point'][0]['picture'] }}" alt="{!! $data['top_point']['data'][0]['username'] !!}" height="40" width="40">
                        @else
                            <img class="round" src="https://ui-avatars.com/api/?name={!! $data['top_point']['data'][0]['username'] !!}&amp;color=7F9CF5&amp;background=EBF4FF" alt="{!! $data['top_point']['data'][0]['username'] !!}" height="40" width="40">
                        @endif
                    </div>
                </div>
                <h3 class="font-weight-bolder mt-1">{!! $data['top_point']['data'][0]['username'] !!}</h3>
                <p class="card-text">Author Paling Produktif</p>
                <h4 class="font-weight-bolder text-primary"><i data-feather="pocket" class="font-medium-5"></i> {{ $data['top_point']['data'][0]['total_point'] }} Point</h4>
            </div>
            <img src="https://jateng.cms.nu.or.id/app-assets/images/illustration/badge.svg" class="congratulation-medal" alt="Medal Pic" />
        </div>
    </div>
</div>
