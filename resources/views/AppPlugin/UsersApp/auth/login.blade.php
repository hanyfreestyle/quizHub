@extends('portal.layouts.appAuth')

@section('content')
    <div class="row">
        <div class="col-xl-5 d-none d-xl-block p-0 vh-100 bg-image-cover bg-no-repeat" style="background-image: url({{defPortalAssets('images/login-bg.jpg')}});"></div>
        <div class="col-xl-7 vh-100 align-items-center d-flex bg-white rounded-3 overflow-hidden">
            <div class="card shadow-none border-0 ms-auto me-auto login-card">
                <div class="card-body rounded-0 text-left">
                    <h2 class="fw-700 display1-size display2-md-size mb-4 text-center">Log in</h2>
                    <form action="{{route('portal.loginCheck')}}" method="post" class="myForm">

                        <div class="form-group icon-input mb-3">
                            <i class="font-sm ti-email text-grey-500 pe-0"></i>
                            <input type="text" class="style2-input ps-5 form-control text-grey-900 font-xsss fw-600" placeholder="Your Email Address">
                        </div>
                        <div class="form-group icon-input mb-1">
                            <input type="Password" class="style2-input ps-5 form-control text-grey-900 font-xss ls-3" placeholder="Password">
                            <i class="font-sm ti-lock text-grey-500 pe-0"></i>
                        </div>
                        <div class="form-check text-left mb-3">
                            <input type="checkbox" class="form-check-input mt-2" id="exampleCheck1">
                            <label class="form-check-label font-xsss text-grey-500" for="exampleCheck1">Remember me</label>
                            <a href="forgot.html" class="fw-600 font-xsss text-grey-700 mt-1 float-right">Forgot your Password ?</a>
                        </div>

                        <div class="form-group mb-1">
                            <button class="form-control text-center text-white fw-600 bg-dark border-0" type="submit">{{ __('web/profile.but_login') }}</button>
                            <h6 class="text-grey-500 font-xsss fw-500 mt-0 mb-0 lh-32">Dont have account <a href="register.html" class="fw-700 ms-1">Register</a></h6>
                        </div>

                    </form>

                    <div class="col-sm-12 p-0 text-left">

                    <div class="col-sm-12 p-0 text-center mt-2">

                        <h6 class="mb-0 d-inline-block bg-white fw-500 font-xsss text-grey-500 mb-3">Or, Sign in with your social account </h6>
                        <div class="form-group mb-1"><a href="#" class="form-control text-left style2-input text-white fw-600 bg-facebook border-0 p-0 mb-2"><img src="images/icon-1.png" alt="icon"
                                                                                                                                                                  class="ms-2 w40 mb-1 me-5"> Sign in
                                with Google</a></div>
                        <div class="form-group mb-1"><a href="#" class="form-control text-left style2-input text-white fw-600 bg-twiiter border-0 p-0 "><img src="images/icon-3.png" alt="icon"
                                                                                                                                                             class="ms-2 w40 mb-1 me-5"> Sign in with
                                Facebook</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

{{--    <div class="container">--}}
{{--        <div class="row justify-content-md-center ">--}}
{{--            <div class="col col-lg-6 col-12 offset-md-1 order-lg-2 order-2">--}}
{{--                <div class="card login_card">--}}
{{--                    <div class="card-body">--}}
{{--                        <x-site.html.confirm-massage/>--}}

{{--                        <form action="{{route('portal.loginCheck',$cart)}}" method="post" class="myForm mb__10">--}}

{{--                            @csrf--}}
{{--                            <div class="form-row  mt__10">--}}
{{--                                <x-site.form.phone name="phone" col="12" value="{{old('phone')}}" label="{{__('web/profile.form_mobile')}}"/>--}}
{{--                            </div>--}}

{{--                            <div class="form-row">--}}
{{--                                <x-site.form.input name="password" type="password" label="{{__('web/profile.form_pass')}}" value="{{old('password')}}" col="12"/>--}}
{{--                            </div>--}}
{{--                            <div class="form-row mt__20">--}}
{{--                                <div class="col text_left_lang">--}}
{{--                                    <button class="btn def_but w_100" type="submit">{{ __('web/profile.but_login') }}</button>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="form_note text-center mt__20">--}}
{{--                                <a href="{{route('UsersApp_SignUp')}}">{!! __('web/profile.form_text_sign_up') !!}</a>--}}
{{--                                <span>{!! __('web/profile.form_text_have_no') !!}</span>--}}
{{--                            </div>--}}
{{--                        </form>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--        </div>--}}
{{--    </div>--}}
@endsection

