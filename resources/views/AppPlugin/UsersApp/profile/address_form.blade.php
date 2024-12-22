@extends('web.layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col col-lg-3 login_photo order-lg-1 order-1 d-none d-lg-block">
                <x-app-plugin.users-app.profile-menu :page-view="$pageView"/>
            </div>

            <div class="col col-lg-9 col-12 order-lg-2 order-2">
                @include('AppPlugin.UsersApp.profile.address_form_inc',['pageType' => 'orders'])
            </div>

        </div>
    </div>
@endsection

