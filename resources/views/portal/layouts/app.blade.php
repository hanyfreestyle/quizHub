<!DOCTYPE html>
<html lang="en" {!!htmlArDir()!!} >
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <link rel="icon" href="{{defPortalAssets('css/images/favicon.png') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{defPortalAssets('css/images/favicon.png') }}" type="image/x-icon">
    <title>Profile Hub </title>
    <x-site.def.fav-icon/>
    {{--    <link rel="preconnect" href="https://fonts.googleapis.com">--}}
    {{--    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">--}}
    {{--    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@200;300;400;600;700;800;900&amp;display=swap" rel="stylesheet">--}}
    {{--    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900&amp;display=swap" rel="stylesheet">--}}

    <link rel="stylesheet" type="text/css" href="{{defPortalAssets('css/all.css') }}">

    <!-- Icons-->
    {{--    <link rel="stylesheet" type="text/css" href="{{defPortalAssets('css/vendors/icofont.css') }}">--}}
    {{--    <link rel="stylesheet" type="text/css" href="{{defPortalAssets('css/vendors/themify.css') }}">--}}
    {{--    <link rel="stylesheet" type="text/css" href="{{defPortalAssets('css/vendors/flag-icon.css') }}">--}}
    {{--    <link rel="stylesheet" type="text/css" href="{{defPortalAssets('css/vendors/feather-icon.css') }}">--}}

<!-- Plugins css start-->
    <link rel="stylesheet" type="text/css" href="{{defPortalAssets('css/vendors/slick.css') }}">
    <link rel="stylesheet" type="text/css" href="{{defPortalAssets('css/vendors/slick-theme.css') }}">
    <link rel="stylesheet" type="text/css" href="{{defPortalAssets('css/vendors/scrollbar.css') }}">
    <link rel="stylesheet" type="text/css" href="{{defPortalAssets('css/vendors/animate.css') }}">
    @yield('BeforStrap')

    {!! $MinifyTools->setWebAssets('assets/portal/')->MinifyCss('css/vendors/bootstrap.css',$cssMinifyType,true) !!}
    {!! $MinifyTools->setWebAssets('assets/portal/')->MinifyCss('css/style.css',$cssMinifyType,true) !!}
    {{--    {!! $MinifyTools->setWebAssets('assets/portal/')->MinifyCss('css/responsive.css',$cssMinifyType,true) !!}--}}

    {!! $MinifyTools->setWebAssets('assets/portal/')->MinifyCss('css/style_color.css',$cssMinifyType,true) !!}
    {!! $MinifyTools->setWebAssets('assets/portal/')->MinifyCss('css/style_dash.css',$cssMinifyType,true) !!}
    {{--    {!! $MinifyTools->setWebAssets('assets/portal/')->MinifyCss('css/style_left_menu.css',$cssMinifyType,true) !!}--}}
    {!! $MinifyTools->setWebAssets('assets/portal/')->MinifyCss('css/style_card_menu.css',$cssMinifyType,true) !!}

    {!! $MinifyTools->setWebAssets('assets/portal/')->MinifyCss('css/style_form.css',$cssMinifyType,true) !!}
    {!! $MinifyTools->setWebAssets('assets/portal/')->MinifyCss('css/style_popup.css',$cssMinifyType,true) !!}
    {!! $MinifyTools->setWebAssets('assets/portal/')->MinifyCss('css/style_card.css',$cssMinifyType,true) !!}
    {!! $MinifyTools->setWebAssets('assets/portal/')->MinifyCss('css/style_profile_card.css',$cssMinifyType,true) !!}
    {!! $MinifyTools->setWebAssets('assets/portal/')->MinifyCss('css/style_cropper.css',$cssMinifyType,true) !!}

    {!! $MinifyTools->setWebAssets('assets/portal/')->MinifyCss('css/style_update.css',$cssMinifyType,true) !!}
    {{--    {!! $MinifyTools->setWebAssets('assets/portal/')->MinifyCss('css/style_update_work.css',$cssMinifyType,true) !!}--}}
    {!! $MinifyTools->setWebAssets('assets/portal/')->MinifyCss('css/style_update_work_2.css',$cssMinifyType,true) !!}
    @yield('AddStyle')
    @yield('StyleFile')
    @stack('addThisStyle')
    {!! $MinifyTools->setWebAssets('assets/portal/')->MinifyCss('css/style_lang_'.thisCurrentLocale().'.css',$cssMinifyType,true) !!}
</head>
<body class="{{ session('theme', 'dark dark-only') }}" {!! bodyDir() !!} >
{!!  loaderWrapper(config('appPortal.Body.loading')) !!}
<div class="tap-top"><i data-feather="chevrons-up"></i></div>

<div class="page-wrapper compact-wrapper" id="pageWrapper">

    @include('portal.include.page-header')

    <div class="page-body-wrapper">
        <x-portal.dash.layouts.side-menu/>
        <div class="page-body">
            @yield('content')
        </div>
        @include('portal.include.footer')
    </div>
</div>

<!-- latest jquery-->
<script src="{{defPortalAssets('js/jquery.min.js') }}"></script>
<script src="{{defPortalAssets('js/bootstrap/bootstrap.bundle.min.js') }}"></script>
{{--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>--}}
<!-- feather icon js-->
<script src="{{defPortalAssets('js/icons/feather-icon/feather.min.js') }}"></script>
<script src="{{defPortalAssets('js/icons/feather-icon/feather-icon.js') }}"></script>
<!-- scrollbar js-->
<script src="{{defPortalAssets('js/scrollbar/simplebar.js') }}"></script>
<script src="{{defPortalAssets('js/scrollbar/custom.js') }}"></script>
<!-- Sidebar jquery-->
<script src="{{defPortalAssets('js/config.js') }}"></script>
<!-- Plugins JS start-->
<script src="{{defPortalAssets('js/sidebar-menu.js') }}"></script>
<script src="{{defPortalAssets('js/sidebar-pin.js') }}"></script>

<script src="{{defPortalAssets('js/slick/slick.min.js') }}"></script>
<script src="{{defPortalAssets('js/slick/slick.js') }}"></script>
<script src="{{defPortalAssets('js/header-slick.js') }}"></script>
<script src="{{defPortalAssets('vendor/sweetalert/sweetalert2.js') }}"></script>
<script src="{{defPortalAssets('vendor/sortable/sortable.js') }}"></script>


<script src="{{defPortalAssets('js/parsley/parsley.js') }}"></script>
<script src="{{defPortalAssets('js/parsley/i18n/'.thisCurrentLocale().'.js') }}"></script>
<script src="{{defPortalAssets('js/form-validation-custom.js') }}"></script>
<script src="{{defPortalAssets('js/script.js') }}"></script>

<x-site.js.load-web-font/>
@yield('AddScript')
@stack('JsCode')
<script>
    $(document).ready(function () {
        $(".toggle_sidebar_save").click(function () {
            $nav = $(".sidebar-wrapper");
            $current = $nav.hasClass("close_icon");
            saveToggleSidebar($current);
        });
    });

    function saveToggleSidebar(current) {
        fetch('{{route('portal.saveToggleSidebar')}}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({current: current})
        });
    }

    function saveThemePreference(theme) {
        fetch('{{route('portal.saveTheme')}}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({theme: theme})
        });
    }
</script>
</body>
</html>
