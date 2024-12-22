<div class="sidebar-wrapper {{ session('ToggleSidebar', null) }}" data-layout="stroke-svg">
    <div>
        <div class="logo-wrapper">
            <a href="{{route('portal.dashboard')}}">
                <img class="img-fluid for-light" src="{{getDefPhotoPath($DefPhotoList,'logo_light')}}" alt="">
                <img class="img-fluid for-dark" src="{{getDefPhotoPath($DefPhotoList,'logo_dark')}}" alt="">
            </a>
            <div class="toggle-sidebar toggle_sidebar_save">
                <svg class="sidebar-toggle">
                    <use href="{{defPortalAssets('svg/icon-sprite.svg#toggle-icon') }}"></use>
                </svg>
            </div>
        </div>
        <div class="logo-icon-wrapper">
            <a href="{{route('portal.dashboard')}}">
                <img class="img-fluid" src="{{getDefPhotoPath($DefPhotoList,'logo_icon')}}" alt="">
            </a>
        </div>
        <nav class="sidebar-main">
            {{--            <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>--}}
            <div id="sidebar-menu">
                <ul class="sidebar-links" id="simple-bar">

                    <li class="pin-title sidebar-main-title">
                        <div><h6>{{__('portal/dash.dash_pinned')}}</h6></div>
                    </li>

                    <x-portal.html.side-bar-menu :r="route('portal.dashboard')" :t="__('portal/dash.app_menu')" i="home" :pin="false"/>

{{--                    <x-portal.html.side-bar-menu :t="__('portal/profile.app_menu')" i="user">--}}
{{--                        <ul class="sidebar-submenu">--}}
{{--                            <li><a class="" href="{{route('portal.profile.editProfile')}}">{{__('portal/profile.app_menu_edit')}}</a></li>--}}
{{--                            @if(Route::currentRouteName() == 'portal.profile.updateProfilePhoto')--}}
{{--                                <li><a class="" href="{{route('portal.profile.updateProfilePhoto')}}">{{__('portal/cropper.profile_h1')}}</a></li>--}}
{{--                            @endif--}}
{{--                            @if(Route::currentRouteName() == 'portal.profile.updateProfileBanner')--}}
{{--                                <li><a class="" href="{{route('portal.profile.updateProfileBanner')}}">{{__('portal/cropper.banner_h1')}}</a></li>--}}
{{--                            @endif--}}

{{--                            <li><a class="" href="{{route('portal.profile.updatePassword')}}">{{__('portal/profile.app_menu_edit_pass')}}</a></li>--}}
{{--                            <li><a class="" href="{{route('portal.profile.settings')}}">{{__('portal/profile.app_menu_settings')}}</a></li>--}}
{{--                            <li><a class="" href="{{route('portal.logout')}}">{{__('portal/profile.app_menu_log')}}</a></li>--}}
{{--                        </ul>--}}
{{--                    </x-portal.html.side-bar-menu>--}}

                    <x-portal.html.side-bar-menu :t="__('portal/cards.app_menu')" i="learning">
                        <ul class="sidebar-submenu">
                            <li><a href="{{route('portal.cards.cardsList')}}">{{__('portal/cards.app_menu_list')}}</a></li>
                            <li><a href="{{route('portal.cards.cardAdd')}}">{{__('portal/cards.app_menu_add')}}</a></li>
                            @foreach($authUser->cards  as $card)
                                @if(request()->route('uuid') != $card->uuid)
                                    <li><a href="{{route('portal.cards.cardEdit',$card->uuid)}}">{{$card->card_name}} </a></li>
                                @endif
                            @endforeach
                        </ul>
                    </x-portal.html.side-bar-menu>

                    @foreach($authUser->cards  as $card)
                        @if(request()->route('uuid') == $card->uuid)
                            <x-portal.html.side-bar-menu :t="$card->card_name" :pin="false" i="learning">
                                <ul class="sidebar-submenu">
                                    <li><a href="{{route('portal.cards.cardEdit',$card->uuid)}}">{{__('portal/cards.page_menu_info')}} </a></li>
                                    <li><a href="{{route('portal.cards.cardEditLinks',$card->uuid)}}">{{__('portal/cards.page_menu_links')}} </a></li>
                                    <li><a href="{{route('portal.cards.cardEditSort',$card->uuid)}}">{{__('portal/cards.page_menu_sort')}} </a></li>
                                    <li><a href="{{route('portal.cards.cardEditTemplate',$card->uuid)}}">{{__('portal/cards.page_menu_them')}} </a></li>
{{--                                    <li><a href="{{route('portal.cards.cardEditProfile',$card->uuid)}}">{{__('portal/cards.app_menu_photo_profile')}} </a></li>--}}
{{--                                    <li><a href="{{route('portal.cards.cardEditCover',$card->uuid)}}">{{__('portal/cards.app_menu_photo_cover')}} </a></li>--}}
                                </ul>
                            </x-portal.html.side-bar-menu>
                        @endif
                    @endforeach


{{--                    <li class="sidebar-main-title"><div><h6>Components</h6></div></li>--}}
{{--                    <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="#">--}}
{{--                            <svg class="stroke-icon">--}}
{{--                                <use href="{{defPortalAssets('svg/icon-sprite.svg#stroke-form') }}"></use>--}}
{{--                            </svg>--}}
{{--                            <svg class="fill-icon">--}}
{{--                                <use href="{{defPortalAssets('svg/icon-sprite.svg#stroke-form') }}"></use>--}}
{{--                            </svg>--}}
{{--                            <span>Forms</span></a>--}}
{{--                        <ul class="sidebar-submenu">--}}
{{--                            <li>--}}
{{--                                <a class="submenu-title" href="#">Form Controls--}}
{{--                                    <h5 class="sub-arrow"><i class="fa fa-angle-right"></i></h5>--}}
{{--                                </a>--}}
{{--                                <ul class="submenu-content opensubmegamenu">--}}
{{--                                    <li><a href="#">Form Validation</a></li>--}}
{{--                                    <li><a href="#">Base Inputs</a></li>--}}
{{--                                    <li><a href="#">Checkbox & Radio</a></li>--}}
{{--                                    <li><a href="#">Input Groups</a></li>--}}
{{--                                    <li><a href="#">Input Mask</a></li>--}}
{{--                                    <li><a href="#">Mega Options</a></li>--}}
{{--                                </ul>--}}
{{--                            </li>--}}


{{--                        </ul>--}}
{{--                    </li>--}}

                </ul>
            </div>
            {{--            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>--}}
        </nav>
    </div>
</div>
