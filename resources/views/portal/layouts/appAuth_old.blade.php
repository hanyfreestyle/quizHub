<!DOCTYPE html>
<html lang="en" {!!htmlArDir()!!}>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profile Hub </title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <x-site.def.fav-icon/>
    {!! $MinifyTools->setWebAssets('assets/portal/')->MinifyCss('css/auth/auth.css',$cssMinifyType,$reBuild) !!}
    {!! $MinifyTools->setWebAssets('assets/portal/')->MinifyCss('css/auth/auth_'.thisCurrentLocale().'.css',$cssMinifyType,$reBuild) !!}
    @yield('AddStyle')
    @stack('StyleFile')
</head>

<body data-theme="{{ session('theme', 'dark') }}">
@yield('content')
<script src="{{defAdminAssets('plugins/jquery/jquery.min.js')}}"></script>
<x-site.js.load-web-font/>
@yield('AddScript')
@stack('ScriptCode')
<script>
    function toggleTheme() {
        const body = document.body;
        const currentTheme = body.getAttribute('data-theme');
        const themeIcon = document.querySelector('.theme-toggle i');
        if (currentTheme === 'dark') {
            body.removeAttribute('data-theme');
            themeIcon.classList.remove('fa-sun');
            themeIcon.classList.add('fa-moon');
            saveThemePreference('light');
        } else {
            body.setAttribute('data-theme', 'dark');
            themeIcon.classList.remove('fa-moon');
            themeIcon.classList.add('fa-sun');
            saveThemePreference('dark');
        }
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
