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
    <link rel="stylesheet" type="text/css" href="{{defPortalAssets('css/all.css') }}">
    @yield('BeforStrap')
    {!! $MinifyTools->setWebAssets('assets/portal/')->MinifyCss('css/vendors/bootstrap.css',$cssMinifyType,true) !!}
    {!! $MinifyTools->setWebAssets('assets/portal/')->MinifyCss('css/style.css',$cssMinifyType,true) !!}
    {!! $MinifyTools->setWebAssets('assets/portal/')->MinifyCss('css/style_auth.css',$cssMinifyType,true) !!}
    {!! $MinifyTools->setWebAssets('assets/portal/')->MinifyCss('css/style_color.css',$cssMinifyType,true) !!}
    {!! $MinifyTools->setWebAssets('assets/portal/')->MinifyCss('css/style_form.css',$cssMinifyType,true) !!}
    {!! $MinifyTools->setWebAssets('assets/portal/')->MinifyCss('css/style_update.css',$cssMinifyType,true) !!}
    {!! $MinifyTools->setWebAssets('assets/portal/')->MinifyCss('css/style_update_work.css',$cssMinifyType,true) !!}
    @yield('AddStyle')
    @yield('StyleFile')
    {!! $MinifyTools->setWebAssets('assets/portal/')->MinifyCss('css/style_lang_'.thisCurrentLocale().'.css',$cssMinifyType,true) !!}
</head>
<body class="{{ session('theme', 'dark dark-only') }}" {!! bodyDir() !!} >
{!!  loaderWrapper(config('appPortal.Body.loading')) !!}

@yield('content')

<script src="{{defPortalAssets('js/jquery.min.js') }}"></script>
<script src="{{defPortalAssets('js/bootstrap/bootstrap.bundle.min.js') }}"></script>
<script src="{{defPortalAssets('js/config.js') }}"></script>
<script src="{{defPortalAssets('js/parsley/parsley.js') }}"></script>
<script src="{{defPortalAssets('js/parsley/i18n/'.thisCurrentLocale().'.js') }}"></script>
<script src="{{defPortalAssets('js/form-validation-custom.js') }}"></script>
<script src="{{defPortalAssets('js/script.js') }}"></script>
<x-site.js.load-web-font/>
@yield('AddScript')
@stack('JsCode')
<script>
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
