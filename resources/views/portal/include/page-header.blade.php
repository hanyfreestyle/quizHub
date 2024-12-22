<div class="page-header {{ session('ToggleSidebar', null) }}">
    <div class="header-wrapper row m-0">
        <div class="header-logo-wrapper col-auto p-0">
            <div class="logo-wrapper">
                <a href="{{route('portal.dashboard')}}">
{{--                    <img class="img-fluid for-light" src="{{defPortalAssets('images/logo/logo.png') }}" alt="">--}}
{{--                    <img class="img-fluid for-dark" src="{{defPortalAssets('images/logo/logo_dark.png') }}" alt="">--}}
                </a>
            </div>
            <div class="toggle-sidebar">
                <svg class="sidebar-toggle">
                    <use href="{{defPortalAssets('svg/icon-sprite.svg#stroke-animation') }}"></use>
                </svg>
            </div>
        </div>
        <x-portal.dash.header.search/>

        <div class="nav-right col-xl-8 col-lg-12 col-auto pull-right right-header p-0">
            <ul class="nav-menus">
                <x-portal.dash.header.search type="Mobile"/>
                <x-portal.dash.header.notification/>
                <x-portal.dash.header.card-list />

                <x-portal.dash.header.bookmark/>
                <x-portal.dash.header.message/>
                <x-portal.dash.header.cart/>
                <x-portal.dash.header.dark-mode/>
                <x-portal.dash.header.language/>
                <x-portal.dash.header.user-profile/>
            </ul>
        </div>

        <x-portal.dash.header.result-template/>
    </div>
</div>
