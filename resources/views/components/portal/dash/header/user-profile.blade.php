<li class="profile-nav onhover-dropdown pe-0 py-0">
    <div class="d-flex align-items-center profile-media">
        <img class="b-r-25" src="{{getUserPhoto($authUser,'profile','s')}}">
        <div class="flex-grow-1"><span class="userName">{{$authUser->name}}</span>
            <p class="mb-0 font-nunito profileArrow">{{__('portal/dash.account_type')}}
                <i class="fas fa-sort-down"></i>
            </p>
        </div>
    </div>
    <ul class="profile-dropdown onhover-show-div">
        <li><a href="{{route('portal.profile.editProfile')}}"><i data-feather="user"></i><span>{{__('portal/profile.app_menu')}}</span></a></li>
        <li><a href="{{route('portal.profile.updatePassword')}}"><i data-feather="lock"></i><span>{{__('portal/profile.app_menu_edit_pass')}}</span></a></li>
        <li><a href="{{route('portal.dashboard')}}"><i data-feather="settings"></i><span>{{__('portal/profile.app_menu_settings')}}</span></a></li>
        <li><a href="{{route('portal.logout')}}"> <i data-feather="log-in"></i><span>{{__('portal/profile.app_menu_log')}}</span></a></li>
    </ul>
</li>
