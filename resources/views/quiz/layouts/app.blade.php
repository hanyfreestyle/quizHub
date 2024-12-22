<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta name="robots" content="index, follow">
    <x-admin.web.google-tags type="web_master_meta"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <x-site.def.fav-icon/>
    <title>Quiz</title>
    {!! $MinifyTools->setWebAssets('assets/quiz/')->MinifyCss('_vendor/quiza/css/bootstrap.min.css',"Seo",true) !!}
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">

    {!! $MinifyTools->setWebAssets('assets/quiz/')->MinifyCss('quiz8/css/style.css',"Seo",true) !!}
    {!! $MinifyTools->setWebAssets('assets/quiz/')->MinifyCss('quiz8/css/animation.css',"Seo",true) !!}
    {!! $MinifyTools->setWebAssets('assets/quiz/')->MinifyCss('quiz8/css/responsive.css',"Seo",true) !!}
    {!! $MinifyTools->setWebAssets('assets/quiz/')->MinifyCss('quiz8/css/thankyou.css',"Seo",true) !!}

    {{--    {!! $MinifyTools->setWebAssets('assets/card/')->MinifyCss('_main/color.css',"Seo",true) !!}--}}
    {{--    {!! $MinifyTools->setWebAssets('assets/card/')->MinifyCss('_main/style.css',"Seo",true) !!}--}}
    @stack('tempStyle')
    @yield('AddStyle')

</head>

<body>


@yield('content')


@yield('TempScript')


<x-site.js.load-web-font/>
@yield('AddScript')

<script src="{{defQuizAssets('_vendor/quiza/js/bootstrap.min.js') }}"></script>
<script src="{{defQuizAssets('_vendor/quiza/js/jquery-3.7.1.min.js') }}"></script>
<script src="{{defQuizAssets('quiz8/thankyou.js') }}"></script>
<script src="{{defQuizAssets('quiz8/custom.js') }}"></script>
@stack('pushScript')

</body>

</html>
