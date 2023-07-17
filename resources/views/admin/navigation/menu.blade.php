<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="/" class="app-brand-link">
            <span class="app-brand-text demo menu-text fw-bold">{{ config('app.name') }}</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
            <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboards -->
        <li class="menu-item">
            <a href="{{ route('dashboard') }}" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ti ti-smart-home"></i>
                <div data-i18n="Dashboards">Dashboards</div>
                <div class="badge bg-label-primary rounded-pill ms-auto">3</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="{{ route('dashboard') }}" class="menu-link">
                        <div data-i18n="Analytics">Analytics</div>
                    </a>
                </li>
            </ul>
        </li>



        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Menu</span>
        </li>
        @role('super admin|admin|guest|')
        <li class="menu-item {{ (request()->segment(2) == 'posts' ? 'active' : '') }} nav-item">
            <a href="{{ route('posts.index') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-news"></i>
                <div data-i18n="@lang('admin.post.title')">@lang('admin.post.title')</div>
            </a>
        </li>
        @endrole
        @role('super admin|admin')
        <li class="menu-item {{ (request()->segment(2) == 'pages' ? 'active' : '') }} nav-item">
            <a href="{{ route('pages.index') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-box-multiple"></i>
                <div data-i18n="@lang('admin.page.title')">@lang('admin.page.title')</div>
            </a>
        </li>
        <li class="menu-item {{ (request()->segment(2) == 'files' ? 'active' : '') }} nav-item">
            <a href="{{ route('files.index') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-file"></i>
                <div data-i18n="@lang('admin.file.title')">@lang('admin.file.title')</div>
            </a>
        </li>
        <li class="menu-item {{ (request()->segment(2) == 'services' ? 'active' : '') }} nav-item">
            <a href="{{ route('services.index') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-devices"></i>
                <div data-i18n="@lang('admin.service.title')">@lang('admin.service.title')</div>
            </a>
        </li>
        <li class="menu-item {{ (request()->segment(2) == 'videos' ? 'active' : '') }} nav-item">
            <a href="{{ route('videos.index') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-brand-zoom"></i>
                <div data-i18n="@lang('admin.video.title')">@lang('admin.video.title')</div>
            </a>
        </li>
        <li class="menu-item {{ (request()->segment(2) == 'images' ? 'active' : '') }} nav-item">
            <a href="{{ route('images.index') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-photo"></i>
                <div data-i18n="@lang('admin.image.title')">@lang('admin.image.title')</div>
            </a>
        </li>
        <li class="menu-item {{ (request()->segment(2) == 'photos' ? 'active' : '') }} nav-item">
            <a href="{{ route('photos.index') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-camera"></i>
                <div data-i18n="@lang('admin.photo.title')">@lang('admin.photo.title')</div>
            </a>
        </li>
        @endrole

        {{-- <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Integrasi</span>
        </li>
        <li class="menu-item {{ (request()->segment(2) == 'photos' ? 'active' : '') }} nav-item">
            <a href="#" class="menu-link">
                <i class="menu-icon tf-icons ti ti-cpu"></i>
                <div data-i18n="@lang('admin.integrasi.title')">@lang('admin.integrasi.title')</div>
            </a>
        </li>
        <li class="menu-item {{ (request()->segment(2) == 'offices' ? 'active' : '') }} nav-item">
            <a href="{{ route('offices.index') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-building-skyscraper"></i>
                <div data-i18n="@lang('admin.office.title')">@lang('admin.office.title')</div>
            </a>
        </li> --}}
        @role('super admin')
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Admin</span>
        </li>
        <li class="menu-item {{ (request()->segment(2) == 'menus' ? 'active' : '') }} nav-item">
            <a href="{{ route('menus.index') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-list"></i>
                <div data-i18n="Menu">Menu</div>
            </a>
        </li>
        <li class="menu-item {{ (request()->segment(2) == 'points' ? 'active' : '') }} nav-item">
            <a href="{{ route('points.index') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-coin"></i>
                <div data-i18n="Point">Point</div>
            </a>
        </li>
        <li class="menu-item {{ (request()->segment(2) == 'users' ? 'active' : '') }} nav-item">
            <a href="{{ route('users.index') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-users"></i>
                <div data-i18n="Users">Users</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="/log-viewer" class="menu-link">
                <i class="menu-icon tf-icons ti ti-float-left"></i>
                <div data-i18n="Log View">Log View</div>
            </a>
        </li>
        @endrole
    </ul>
</aside>
