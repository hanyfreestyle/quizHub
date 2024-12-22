@extends('portal.layouts.app')

@section('content')

    <x-portal.dash.layouts.breadcrumb :page="$page"/>

    <div class="container-fluid container_body">
        <div class="edit-profile user-profile">
            <div class="row">
                <x-portal.html.card col="col-lg-8 order-1 order-lg-0  ">
                    <x-portal.html.form :route="route('portal.profile.updateProfile')">


                        <x-portal.form.input name="name" col="12|12" :row="$userProfile"
                                             :l="__('portal/profile.form_name')" i="fa-solid fa-user"/>

                        <x-portal.form.phone name="phone" :row="$userProfile" :label="__('portal/profile.form_phone')"
                                             :initial-country="issetArr($userProfile,'phone_code',IsConfig($config,'defCountry'))" col="6|12"/>

                        <x-portal.form.phone name="whatsapp" :row="$userProfile" :label="__('portal/profile.form_whatsapp')"
                                             :initial-country="issetArr($userProfile,'whatsapp_code',IsConfig($config,'defCountry'))" col="6|12"/>

                        {{--                        <x-portal.form.input input-type="textarea" name="hanyss" col="12|12" :row="$userProfile" :holder="__('portal/profile.form_name_2')"--}}
                        {{--                                             :l="__('portal/profile.form_name_2')" i="fa-solid fa-user"/>--}}


                        <x-portal.form.button n="update"/>

                    </x-portal.html.form>
                </x-portal.html.card>
                <div class="col-sm-12 col-lg-4 order-0 order-lg-1">
                    <x-portal.profile.user-card-photo />
                </div>
            </div>
        </div>
    </div>


@endsection

