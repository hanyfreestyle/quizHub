@extends('portal.layouts.appAuth')

@section('content')
    <div class="container-fluid authPage container_body">
        <div class="row">
            <div class="col-xl-5 img_bg">
                <img class="bg-img-cover bg-center" src="{{defPortalAssets('img/forget.jpg')}}" alt="logo">
            </div>
            <div class="col-xl-7 p-0">
                <div class="login-card login-dark login-bg">
                    <div>
                        <div class="selLang">
                            <a href="{{ LaravelLocalization::getLocalizedURL(portalChangeLangKey(), null, [], true) }}">
                                <img class="b-r-10 " width="30px" src="{{flagAssets(portalChangeLangKey().'.png') }}">
                            </a>
                        </div>
                        <div>
                            <a class="logoAuth" href="{{route('web.index')}}">
                                <img class="img-fluid for-dark" src="{{getDefPhotoPath($DefPhotoList,'logo_dark')}}" alt="logo">
                            </a>
                        </div>
                        <div class="login-main">
                            <form class="theme-form needs-validation custom-input customForm" action="{{route('portal.forgetPasswordSend')}}" method="post" novalidate="" data-parsley-validate="">
                                @csrf
                                <h4>{!! __('portal/auth.h1_reset_pass') !!}</h4>
                                <p class="h4_p">{!! __('portal/auth.h1_reset_pass_p') !!}</p>

                                <x-site.html.confirm-massage/>

                                <x-portal.form.input name="email" col="12|12" type="email" dir="en" req-type="email" add-style="lang_en"
                                                     :l="__('portal/auth.form_email')" i="fa-regular fa-envelope"/>

                                <div class="form-group mb-0">
                                    <button class="btn btn-primary btn-block w-100 submit_form" type="submit">{{__('portal/auth.but_forget')}}</button>
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

