<div class="card hovercard text-center user_html_card">
    <div class="icon_wrapper_2"><a href="{{route('portal.profile.updateProfileBanner')}}"><i class="far fa-edit"></i></a></div>
    <div class="cardheader" style="background-image: url('{{getUserPhoto($authUser,'banner','m')}}')"></div>
    <div class="user-image">
        <div class="avatar">
            <img src="{{getUserPhoto($authUser,'profile','m')}}">
        </div>
        <div class="icon-wrapper"><a href="{{route('portal.profile.updateProfilePhoto')}}"><i class="far fa-edit"></i></a></div>
    </div>

    <div class="info">
        <div class="row">
            <div class="col-sm-12 col-lg-12 order-sm-0 order-xl-0">
                <div class="user-designation text-center">
                    <div class="title">{{$authUser->name}}</div>
                    <div class="desc">{{$authUser->name}}</div>
                </div>
            </div>

            <div class="col-12 col-lg-12 order-sm-1 order-xl-1">
                <div class="row">
                    <x-portal.html.col-info col="6|6" :n="__('portal/profile.form_email')" :d="$authUser->email" i="fa fa-envelope"/>
                    <x-portal.html.col-info col="6|6" :n="__('portal/profile.lab_account_type')" :d="__('portal/dash.account_type')" i="fa-solid fa-briefcase"/>
                    <x-portal.html.col-info col="6|6" :n="__('portal/profile.form_phone')" :d="$authUser->phone" i="fa fa-phone" s="number" />
                    <x-portal.html.col-info col="6|6" :n="__('portal/profile.form_whatsapp')" :d="$authUser->whatsapp" i="fa-brands fa-whatsapp" s="number" />



                </div>
            </div>

        </div>
        {{--        <hr>--}}
        {{--        <div class="social-media">--}}
        {{--            <ul class="list-inline">--}}
        {{--                <li class="list-inline-item"><a href="https://www.facebook.com/" target="_blank"><i class="fa fa-facebook"></i></a></li>--}}
        {{--                <li class="list-inline-item"><a href="https://accounts.google.com/" target="_blank"><i class="fa fa-google-plus"></i></a></li>--}}
        {{--                <li class="list-inline-item"><a href="https://twitter.com/" target="_blank"><i class="fa fa-twitter"></i></a></li>--}}
        {{--                <li class="list-inline-item"><a href="https://www.instagram.com/" target="_blank"><i class="fa fa-instagram"></i></a></li>--}}
        {{--                <li class="list-inline-item"><a href="https://rss.app/" target="_blank"><i class="fa fa-rss"></i></a></li>--}}
        {{--            </ul>--}}
        {{--        </div>--}}

    </div>
</div>
