<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="index, follow">
    <x-admin.web.google-tags type="web_master_meta"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
{{--    {!! SEO::generate() !!}--}}
    <x-site.def.fav-icon/>
    {!! (new \App\Helpers\MinifyTools)->MinifyCss('css/bootstrap.min.css',$cssMinifyType,$cssReBuild) !!}

    <link href="https://fonts.googleapis.com/css?family=Outfit:400,400i,500,500i,700,700i&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900&amp;display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link href="https://fonts.googleapis.com/css2?family=Courgette&amp;family=Montserrat:wght@200;300;400;500;600;700;800&amp;family=Nunito:wght@200;300;400;500;600;700;800;900&amp;display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link href="https://fonts.googleapis.com/css2?family=Courgette&amp;family=DM+Sans:opsz,wght@9..40,400;9..40,500;9..40,700;9..40,800&amp;family=Montserrat:wght@200;300;400;500;600;700;800&amp;family=Nunito:wght@200;300;400;500;600;700;800;900&amp;display=swap" rel="stylesheet">
{{--    <link rel="stylesheet" type="text/css" href="{{defPortalAssets('css/font-awesome.css') }}">--}}
    <link rel="stylesheet" type="text/css" href="{{defPortalAssets('css/vendors/icofont.css') }}">
    <link rel="icon" href="{{defPortalAssets('svg/landing-icons.svg') }}">


    <link rel="stylesheet" type="text/css" href="{{defPortalAssets('css/vendors/slick.css') }}">
    <link rel="stylesheet" type="text/css" href="{{defPortalAssets('css/vendors/slick-theme.css') }}">
    <link rel="stylesheet" type="text/css" href="{{defPortalAssets('css/vendors/scrollbar.css') }}">
    <link rel="stylesheet" type="text/css" href="{{defPortalAssets('css/vendors/animate.css') }}">


    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="{{defPortalAssets('css/vendors/bootstrap.css') }}">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="{{defPortalAssets('css/style.css') }}">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="{{defPortalAssets('css/responsive.css') }}">
    <link rel="stylesheet" type="text/css" href="{{defPortalAssets('css/vendors/owlcarousel.css') }}">
    {!! $MinifyTools->setWebAssets('assets/portal/')->MinifyCss('css/style_landing.css','Seo',true) !!}
    @yield('AddStyle')
    @stack('StyleFile')

    @if(thisCurrentLocale() == 'ar')

    @endif
    <x-admin.web.google-tags type="tag_manager_code_header"/>
</head>

<body class="landing-page">
<x-admin.web.google-tags type="tag_manager_code_body"/>
@yield('content')



<script src="{{defPortalAssets('js/jquery-3.5.1.min.js') }}"></script>
<!-- Bootstrap js-->
<script src="{{defPortalAssets('js/bootstrap/bootstrap.bundle.min.js') }}"></script>
<!-- feather icon js-->
<script src="{{defPortalAssets('js/icons/feather-icon/feather.min.js') }}"></script>
<script src="{{defPortalAssets('js/icons/feather-icon/feather-icon.js') }}"></script>
<!-- Plugins JS start-->
<script src="{{defPortalAssets('js/tooltip-init.js') }}"></script>
<script src="{{defPortalAssets('js/animation/wow/wow.min.js') }}"></script>
<script src="{{defPortalAssets('js/landing_sticky.js') }}"></script>
<script src="{{defPortalAssets('js/landing.js') }}"></script>
<script src="{{defPortalAssets('js/jarallax_libs/libs.min.js') }}"></script>
<script src="{{defPortalAssets('js/slick/slick.min.js') }}"></script>
<script src="{{defPortalAssets('js/slick/slick.js') }}"></script>
<script src="{{defPortalAssets('js/landing-slick.js') }}"></script>
<!-- Plugins JS Ends-->
<script src="{{defPortalAssets('js/owlcarousel/owl.carousel.js') }}"></script>
<script src="{{defPortalAssets('js/owlcarousel/owl-custom.js') }}"></script>

{{--{!! (new \App\Helpers\MinifyTools)->MinifyJs('temp/js/jquery-3.5.1.min.js',"Web",false) !!}--}}
@yield('TempScript')


<x-site.js.load-web-font/>
@yield('AddScript')
@stack('ScriptCode')
</body>
</html>
