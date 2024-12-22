@extends('web.layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-md-center ">
            <div class="col col-lg-8 col-12 order-lg-2 order-2">

                <div class="card login_card">
                    <div class="card-body">

                        <x-site.html.confirm-massage/>
                        <form action="{{route('UsersApp_SignUpCreate')}}" method="post" class="myForm mb__10">
                            @csrf
                            <div class="form-row">
                                <x-site.form.input name="name" :label="__('web/profile.form_name')" value="{{old('name')}}" col="12"/>
                            </div>

                            <div class="form-row">
                                <x-site.form.phone name="phone" value="{{old('phone')}}" :label="__('web/profile.form_mobile')" col="6"/>
                                <x-site.form.input name="email" value="{{old('email')}}" :label="__('web/profile.form_email')" col="6"/>
                            </div>

                            <div class="form-row">
                                <x-site.form.input name="password" type="password" value="{{old('password')}}" label="{{__('web/profile.form_pass')}}" col="6"/>
                                <x-site.form.input name="password_confirmation" type="password" label="{{__('web/profile.form_pass_confirm')}}" col="6"/>
                            </div>

                            <div class="form-row mt__20">
                                <div class="col text_left_lang">
                                    <button class="btn def_but w_100" type="submit">{{ __('web/profile.form_text_sign_up') }}</button>
                                </div>
                            </div>
                            <div class="form_note text-center mt__20">
                                <a href="{{route('UsersApp_login')}}">{{ __('web/profile.but_login') }}</a>
                                <span>{{__('web/profile.form_text_have')}}</span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

