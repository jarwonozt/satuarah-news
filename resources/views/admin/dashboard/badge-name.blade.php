<div class="col-lg-6 col-md-12 col-sm-12">
    <div class="card card-congratulations">
        <div class="card-body text-center">
            <div class="avatar avatar-xl bg-primary shadow">
                <div class="avatar-content">
                    {{-- @if (isset(auth()->user()->image))
                        <img class="round" src="{{ '/storage/pictures/users/mid/'.auth()->user()->image }}" alt="{!! $data['top_point']['data'][0]['username'] !!}" height="40" width="40">
                    @else
                        <img class="round" src="https://ui-avatars.com/api/?name={!! $data['top_point']['data'][0]['username'] !!}&amp;color=7F9CF5&amp;background=EBF4FF" alt="{!! $data['top_point']['data'][0]['username'] !!}" height="40" width="40">
                    @endif --}}
                </div>
            </div>
            <div class="text-center">
                <h1 class="mb-1 text-white" style="text-transform:capitalize">
                    @foreach (auth()->user()->getRoleNames() as $role)
                        {{ ucwords($role) }}
                    @endforeach
                    - {{ ucwords(auth()->user()->name) }}
                </h1>
                <p class="card-text m-auto w-75">
                    Selamat Datang di CMS {{ config('app.name') }}
                </p>
            </div>
        </div>
    </div>
</div>
