<!DOCTYPE html>
<html lang="en" {!! getThemLang($card) !!} >
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta name="robots" content="index, follow">
    <x-admin.web.google-tags type="web_master_meta"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <x-site.def.fav-icon/>
    <title>Profile Hub </title>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
{{--    <link rel="preconnect" href="https://fonts.googleapis.com/">--}}
{{--    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>--}}
{{--    @if($card->lang == 'en')--}}
{{--        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,700;1,400;1,700&amp;family=Poppins:wght@700;900&amp;display=swap" rel="stylesheet">--}}
{{--    @endif--}}


    <link rel="stylesheet" type="text/css" href="{{defCardAssets('_main/css/bootstrap.min.css') }}">
    <style>
        :root {
            --def-template-color: {{$card->template->color}} ;
            --them-link-color: #fff;
            --white: 255, 255, 255;
            --icon-radius: {{ IsThem($themVar,'iRadius')}};
        }
    </style>
    {!! $MinifyTools->setWebAssets('assets/card/')->MinifyCss('_main/color.css',"Seo",true) !!}
    {!! $MinifyTools->setWebAssets('assets/card/')->MinifyCss('_main/style.css',"Seo",true) !!}
    @stack('tempStyle')
    @yield('AddStyle')



</head>


<body class="home-main {{ IsThem($themVar,'mode') }}">


@yield('content')


@yield('TempScript')


<x-site.js.load-web-font/>
@yield('AddScript')


<script src="{{defCardAssets('_vendor/fungi/js/jquery.js') }}"></script>
<script src="{{defCardAssets('_vendor/fungi/js/popper.min.js') }}"></script>
<script src="{{defCardAssets('_vendor/fungi/js/bootstrap.min.js') }}"></script>
@stack('pushScript')
{{--<script src="{{defCardAssets('js/imagesloaded.pkgd.min.js') }}"></script>--}}
{{--<script src="{{defCardAssets('js/isotope.pkgd.min.js') }}"></script>--}}
{{--<script src="{{defCardAssets('js/swiper-bundle.min.js') }}"></script>--}}
{{--<script src="{{defCardAssets('js/leaflet.js') }}"></script>--}}
{{--<script src="{{defCardAssets('js/jquery.waypoints.min.js') }}"></script>--}}
{{--<script src="{{defCardAssets('js/jquery.counterup.min.js') }}"></script>--}}
{{--<script src="{{defCardAssets('js/aos.js') }}"></script>--}}
{{--<script src="{{defCardAssets('js/jquery.preloadinator.min.js') }}"></script>--}}
{{--<script src="{{defCardAssets('js/vanilla-tilt.min.js') }}"></script>--}}
{{--<script src="{{defCardAssets('_vendor/fungi/js/parallax.min.js') }}"></script>--}}
{{--<script src="{{defCardAssets('_vendor/fungi/js/script.js') }}"></script>--}}


<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Get reference to both buttons
        const mainButton = document.querySelector('.buttonSave');
        const footerButton = document.querySelector('.buttonSaveFooter');

        // Initial state
        footerButton.style.display = 'none';

        // Function to check if an element is in viewport
        function isInViewport(element) {
            const rect = element.getBoundingClientRect();
            return (
                rect.top >= 0 &&
                rect.left >= 0 &&
                rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
                rect.right <= (window.innerWidth || document.documentElement.clientWidth)
            );
        }

        // Handle scroll event
        function handleScroll() {
            if (!isInViewport(mainButton)) {
                footerButton.style.position = 'fixed';
                footerButton.style.top = '0'; // Show from the top
                footerButton.style.left = '50%'; // Optionally center it horizontally
                footerButton.style.transform = 'translateX(-50%)'; // Centering using transform
                footerButton.style.display = 'block';
            } else {
                footerButton.style.display = 'none';
            }
        }

        // Add scroll event listener
        window.addEventListener('scroll', handleScroll);

        // Initial check
        handleScroll();
    });
</script>


{{--<script>--}}
{{--    document.addEventListener('DOMContentLoaded', function () {--}}
{{--        // Get reference to both buttons--}}
{{--        const mainButton = document.querySelector('.buttonSave');--}}
{{--        const footerButton = document.querySelector('.buttonSaveFooter');--}}

{{--        // Initial state--}}
{{--        footerButton.style.display = 'none';--}}

{{--        // Function to check if an element is in viewport--}}
{{--        function isInViewport(element) {--}}
{{--            const rect = element.getBoundingClientRect();--}}
{{--            return (--}}
{{--                rect.top >= 0 &&--}}
{{--                rect.left >= 0 &&--}}
{{--                rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&--}}
{{--                rect.right <= (window.innerWidth || document.documentElement.clientWidth)--}}
{{--            );--}}
{{--        }--}}

{{--        // Handle scroll event--}}
{{--        function handleScroll() {--}}
{{--            if (!isInViewport(mainButton)) {--}}
{{--                footerButton.style.display = 'block';--}}
{{--            } else {--}}
{{--                footerButton.style.display = 'none';--}}
{{--            }--}}
{{--        }--}}

{{--        // Add scroll event listener--}}
{{--        window.addEventListener('scroll', handleScroll);--}}

{{--        // Initial check--}}
{{--        handleScroll();--}}
{{--    });--}}
{{--</script>--}}
</body>

</html>
