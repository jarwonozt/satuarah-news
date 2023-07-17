
<div class="col-lg-4 col-md-6 col-12">
    <div class="card card-developer-meetup">
        <div class="meetup-img-wrapper rounded-top text-center">
            <img src="https://jateng.cms.nu.or.id/app-assets/images/illustration/email.svg" alt="Meeting Pic" height="170" />
                                                <button type="button" class="close" data-toggle="modal" data-target="#agendaModal">
                <span aria-hidden="true"></span>
            </button>
        </div>
        <div class="card-body">
            <div class="meetup-header d-flex align-items-center">
                <div class="meetup-day">
                    <h6 class="mb-0">{{ $data['wiget']['day'] }}</h6>
                    <h3 class="mb-0">22</h3>
                </div>
                <div class="my-auto">
                    <h4 class="card-title mb-25"></h4>
                    <p class="card-text mb-0"><span class="text-primary">Topik: </span></p>
                </div>
            </div>
            <div class="media">
                <div class="avatar bg-light-primary rounded mr-1">
                    <div class="avatar-content">
                        <i data-feather="calendar" class="avatar-icon font-medium-3"></i>
                    </div>
                </div>
                <div class="media-body">
                    <h6 class="mb-0">{{ $data['wiget']['date'] }}</h6>
                    <small>{{ $data['wiget']['time'] }} WIB</small>
                </div>
            </div>
        </div>
    </div>
</div>
