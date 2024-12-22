<ul class="nav ProfileMenuList flex-column">


    {{--  <li class="nav-items {{activeProfileMenu($pageView,"cart_page")}}">--}}
    {{--    <a href="{{route('Shop_CartView')}}" class="nav-link">--}}
    {{--      <i class="las la-shopping-cart"></i> {{__('web/profile.menu_cart')}}--}}
    {{--    </a>--}}
    {{--  </li>--}}

    {{--  <li class="nav-items {{activeProfileMenu($pageView,"orders")}}">--}}
    {{--    <a href="{{route('Customer_Orders')}}" class="nav-link">--}}
    {{--      <i class="lab la-cc-visa"></i> {{__('web/profile.menu_orders_list')}}--}}
    {{--    </a>--}}
    {{--  </li>--}}


    {{--  <li class="nav-items {{activeProfileMenu($pageView,"wish_list")}}">--}}
    {{--    <a href="{{route('page_WishList')}}" class="nav-link">--}}
    {{--      <i class="las la-heart"></i> {{__('web/profile.menu_wish_list')}}--}}
    {{--    </a>--}}
    {{--  </li>--}}

    <li class="nav-items {{activeProfileMenu($pageView,"accountInfo")}}">
        <a href="{{route('UsersApp_Profile')}}" class="nav-link">
            <i class="lar la-address-card"></i> {{__('web/profile.menu_account_info')}}
        </a>
    </li>

    <li class="nav-item {{activeProfileMenu($pageView,"AddressInfo")}}">
        <a href="{{route('UsersApp_ProfileAddress')}}" class="nav-link">
            <i class="las la-map-signs"></i> {{__('web/profile.menu_address')}}
        </a>
    </li>

    <li class="nav-item {{activeProfileMenu($pageView,"ChangePassword")}}">
        <a href="{{route('UsersApp_ProfileChangePassword')}}" class="nav-link">
            <i class="las la-key"></i> {{__('web/profile.menu_change_pass')}}
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('UsersApp_logout') }}">
            <i class="las la-unlock-alt"></i> {{__('web/profile.but_logout')}}
        </a>
    </li>
</ul>

