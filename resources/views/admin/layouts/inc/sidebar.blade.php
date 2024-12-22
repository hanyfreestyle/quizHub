<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <a href="{{route('admin.Dashboard')}}" class="brand-link">
        <img src="{{defAdminClient(config('adminConfig.app_logo_menu'))}}" alt="logo" class="brand-image" >
        <span class="brand-text font-weight-light">{{config('adminConfig.app_logo_text')}}</span>
    </a>


    <div class="sidebar">

        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{!! UserProfilePhoto() !!}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="{{route('admin.Dashboard')}}" class="d-block"> {{ Auth::user()->name }}</a>
            </div>
        </div>


        @if(config('adminConfig.sidebar_navbar_search') == true)
            <div class="form-inline">
                <div class="input-group" data-widget="sidebar-search">
                    <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-sidebar">
                            <i class="fas fa-search fa-fw"></i>
                        </button>
                    </div>
                </div>
            </div>
        @endif

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column {{sideBarNavUlStyle()}}" data-widget="treeview" role="menu" {{sideBarAccordion()}} >
                @foreach( $adminMenu as $MenuList )
                    @if($MenuList->type == "One")
                        @if( $MenuList->roleView == 'adminlang_view')
                            @if(config('app.ADMIN_LANG'))
                                @can($MenuList->roleView)
                                    @if( Route::has($MenuList->url))
                                        <li class="nav-item">
                                            <a href="{{ route($MenuList->url) }}" class="nav-link  @if(Route::is($MenuList->sel_routs.'.*')) active @endif ">
                                                @if(isset($MenuList->icon))<i class="nav-icon {{$MenuList->icon}}"></i>@endif
                                                <p>{!! __($MenuList->name) !!}</p>
                                            </a>
                                        </li>
                                    @endif
                                @endcan
                            @endif
                        @else
                            @can($MenuList->roleView)
                                @if( Route::has($MenuList->url))
                                    <li class="nav-item">
                                        <a href="{{ route($MenuList->url) }}" class="nav-link  @if(Route::is($MenuList->sel_routs.'.*')) active @endif ">
                                            @if(isset($MenuList->icon))<i class="nav-icon {{$MenuList->icon}}"></i>@endif
                                            <p>{!! __($MenuList->name) !!}</p>
                                        </a>
                                    </li>
                                @endif
                            @endcan
                        @endif
                    @elseif($MenuList->type == "Many")
                        @can($MenuList->roleView)
                            <li class="nav-item @if(Route::is($MenuList->sel_routs.'.*'))  menu-open @endif ">
                                <a href="#" class="nav-link @if(Route::is($MenuList->sel_routs.'.*')) active @endif">
                                    @if(isset($MenuList->icon))<i class="nav-icon {{$MenuList->icon}}"></i>@endif
                                    <p>
                                        {!! __($MenuList->name) !!}
                                        @if( thisCurrentLocale() == 'ar')
                                            <i class="right fas fa-angle-left"></i>
                                        @else
                                            <i class="right fas fa-angle-right"></i>
                                        @endif
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    @foreach($MenuList->subMenu as $SubMenu)
                                        @if( Route::has($SubMenu->url))
                                            @if($SubMenu->is_active)
                                                @can($SubMenu->roleView)
                                                    <li class="nav-item">
                                                        <a href="{{ route($SubMenu->url) }}" class="nav-link {{ AdminActiveMenu($SubMenu->sel_routs) }} ">
                                                            @if(isset($SubMenu->icon))<i class="nav-icon {{$SubMenu->icon}}"></i>@endif
                                                            <p>
                                                                {{__($SubMenu->name)}}
                                                            </p>
                                                        </a>
                                                    </li>
                                                @endcan
                                            @endif
                                        @endif
                                    @endforeach
                                </ul>
                            </li>
                        @endcan
                    @endif

                @endforeach
            </ul>
        </nav>
    </div>
</aside>
