@extends('portal.layouts.app')

@section('content')

    <x-portal.dash.layouts.breadcrumb :page="$page"/>

    <x-portal.html.container :one-div="false">
        <x-portal.html.card col="col-lg-12 col-12">
            <x-portal.html.form :route="route('portal.profile.saveNewPassword')">

                <x-portal.form.input name="old_password" type="password" req-type="len[8,20]"
                                     col="12|12" :l="__('portal/profile.form_pass_old')" i="fa-solid fa-lock-open"/>
                <x-portal.form.input name="password" type="password" req-type="len[8,20]"
                                     col="12|12" :l="__('portal/profile.form_pass_new')" i="fa-solid fa-lock"/>
                <x-portal.form.input name="password_confirmation" type="password" req-type="len[8,20]|equal[#password]"
                                     col="12|12" :l="__('portal/profile.form_pass_confirm')" i="fa-solid fa-lock"/>


                <x-portal.form.button n="update"/>
            </x-portal.html.form>
        </x-portal.html.card>

    </x-portal.html.container>

@endsection

