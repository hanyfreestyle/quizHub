<div class="header">
    <div class="logo auth_logo">
{{--        @if(session('theme') == 'dark')--}}
{{--            <img src="{{getDefPhotoPath($DefPhotoList,'logo_dark')}}" alt="image" class="">--}}
{{--        @else--}}
{{--            <img src="{{getDefPhotoPath($DefPhotoList,'logo_light')}}" alt="image" class="">--}}
{{--        @endif--}}
        <img src="{{getDefPhotoPath($DefPhotoList,'logo_dark')}}" alt="image" class="">
    </div>
    <div class="header-actions">
{{--        <button class="theme-toggle" onclick="toggleTheme()" title="Toggle theme">--}}
{{--            @if(session('theme') == 'dark')--}}
{{--                <i class="fa-solid fa-sun"></i>--}}
{{--            @else--}}
{{--                <i class="fa-solid fa-moon"></i>--}}
{{--            @endif--}}
{{--        </button>--}}
        <a class="lang-toggle" href="{{ LaravelLocalization::getLocalizedURL(portalChangeLangKey(), null, [], true) }}">{{portalChangeLangText()}}</a>
    </div>
</div>
