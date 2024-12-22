@extends('web.layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-md-center">

            <div class="col col-lg-3 login_photo order-lg-1 order-1 d-none d-lg-block">
{{--                <x-app-plugin.users-app.profile-menu :page-view="$pageView"/>--}}
            </div>

            <div class="col col-lg-9 col-12 order-lg-2 order-2">

                <div class="card profile_card">

                    <div class="card-header">
                        <h3><i class="lar la-address-card"></i>{{__('web/profile.menu_account_info')}}</h3>
                    </div>

                    <div class="card-body">
                        <x-site.html.confirm-massage/>
                        <form action="{{route('UsersApp_ProfileUpdate')}}" method="post" class="myForm mb__10">
                            @csrf
                            <div class="form-row">
                                <x-site.form.input name="name" :label="__('web/profile.form_name')" :value="old('name',$UserProfile->name)" col="8"/>
                                <x-site.form.input name="phone" :disabled="true" :label="__('web/profile.form_mobile')" :value="old('phone',$UserProfile->phone)" col="4"/>
                            </div>

                            <div class="form-row">
                                <x-site.form.input name="email" :label="__('web/profile.form_email')" :value="old('email',$UserProfile->email)" col="6"/>
                            </div>

                            <div class="form-row">
                                <x-site.form.phone name="whatsapp" :value="old('whatsapp',$UserProfile->whatsapp)" :req="false" :label="__('web/profile.form_whatsapp')" col="6"/>
                            </div>
                            <div class="form-row mt__20">
                                <div class="col text_left_lang">
                                    <button class="btn def_but" type="submit">{{__('web/profile.but_update')}}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

