@extends('web.layouts.app')



@section('content')
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col col-lg-3 login_photo order-lg-1 order-1 d-none d-lg-block">
                <x-app-plugin.users-app.profile-menu :page-view="$pageView"/>
            </div>

            <div class="col col-lg-9 col-12 order-lg-2 order-2">
                <div class="card profile_card">

                    <div class="card-header">
                        <h3><i class="las la-map-signs"></i> {{__('web/profile.address_edit_h1')}}</h3>
                    </div>

                    <div class="card-body">

                        <x-site.html.confirm-massage/>

                        <form action="{{route('UsersApp_ProfileAddressUpdate',$address->uuid)}}" method="post" class="myForm mb__10">
                            @csrf

                            <div class="form-row">
                                <x-site.form.input name="name" :label="__('web/profile.form_name')" :value="old('name',$address->name)" col="12"/>
                            </div>

                            <div class="form-row">
                                <x-site.form.input name="recipient_name" :label="__('web/profile.form_recipient_name')" :value="old('recipient_name',$address->recipient_name)" col="8"/>
                            </div>


                            <div class="form-row">
                                <x-site.form.phone name="phone" :label="__('web/profile.form_mobile')" col="6" :value="old('phone',$address->phone)"
                                                   :initial-country="issetArr($address,'phone_code',IsConfig($config,'defCountry'))" />

                                <x-site.form.phone name="phone_option" :value="old('phone_option',$address->phone_option)" :label="__('web/profile.form_phone_option')"
                                                    :initial-country="issetArr($address,'phone_option_code',IsConfig($config,'defCountry'))" col="6" :req="false"/>

                            </div>

                            <div class="form-row">
                                <x-site.form.text-area name="address" :label="__('web/profile.form_address')" col="12" :value="old('address',$address->address)"/>
                            </div>

                            <div class="form-row mt__20">
                                <div class="col text_left_lang">
                                    <button class="btn def_but" type="submit"> {{__('web/profile.address_edit')}}</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection

