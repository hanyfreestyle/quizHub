@extends('portal.layouts.appAuth')

@section('content')
    <div class="container-fluid authPage container_body">
        <div class="row">
            <div class="col-xl-5 img_bg">
                <img class="bg-img-cover bg-center" src="{{defPortalAssets('img/login_photo.jpg')}}" alt="logo">
            </div>
            <div class="col-xl-7 p-0">
{{--                <div class="login-card login-dark login-bg">--}}
                <div class="login-card login-dark login-bg">
                    <div>
                        <div class="selLang">
                            <a href="{{ LaravelLocalization::getLocalizedURL(portalChangeLangKey(), null, [], true) }}">
                                <img src="{{flagAssets(portalChangeLangKey().'.png') }}">
                            </a>
                        </div>
                        <div>
                            <a class="logoAuth" href="{{route('web.index')}}">
                                <img class="img-fluid for-dark" src="{{getDefPhotoPath($DefPhotoList,'logo_dark')}}" alt="logo">
                            </a>
                        </div>
                        <div class="login-main">
                            <form class="theme-form needs-validation custom-input customForm" action="{{route('portal.loginCheck')}}" method="post" novalidate="" data-parsley-validate="">
                                @csrf
                                <h4>{!! __('portal/auth.h1_login') !!}</h4>
                                <p class="h4_p">{!! __('portal/auth.h1_login_p') !!}</p>

                                <x-site.html.confirm-massage/>

                                <x-portal.form.input name="email" col="12|12" type="email" dir="en" add-style="lang_en" req-type="email"
                                                     :l="__('portal/auth.form_email')" i="fa-regular fa-envelope"/>

                                <x-portal.form.input name="password" type="password" dir="en" req-type="len[8,40]"
                                                     col="12|12" :l="__('portal/auth.form_pass')" i="fa-solid fa-lock-open"/>


                                <div class="form-group">
                                    <div class="remember-forgot __no_spacing">
                                        <a href="{{route('portal.forgetPassword')}}" class="forgot-link">{{__('portal/auth.form_pass_forget')}}</a>
                                    </div>

                                </div>

                                <div class="form-group mb-0">
                                    <button class="btn btn-primary btn-block w-100 submit_form" type="submit">{{__('portal/auth.but_login')}}</button>
                                </div>

                                <h6 class="text-muted mt-4 or">{!! __('portal/auth.form_text_social_account') !!}</h6>
                                <div class="social mt-4">
                                    <div class="btn-showcase">

                                        <a class="btn btn-light" href="#" >
                                            <i class="fab fa-google"></i> Google
                                        </a>
                                        <a class="btn btn-light" href="#">
                                            <i class="fab fa-facebook-square"></i> Facebook
                                        </a>
                                    </div>
                                </div>
                                <p class="mt-4 mb-0 text-center footer_form_text">
                                    {!!__('portal/auth.form_text_have_no') !!}
                                    <a class="ms-2" href="{{route('portal.signUp')}}">{{__('portal/auth.form_text_sign_up')}}</a>
                                </p>
                            </form>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

