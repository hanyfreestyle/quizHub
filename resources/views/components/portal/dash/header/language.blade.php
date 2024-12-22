@if($active)
    @if(count($langfile) > 2)
        <li class="language-nav">
            <div class="translate_wrapper">
                <div class="current_lang">
                    <div class="lang"><i class="flag-icon flag-icon-gb"></i><span class="lang-txt box-col-none">EN            </span></div>
                </div>
                <div class="more_lang">
                    <div class="lang selected" data-value="en"><i class="flag-icon flag-icon-us"></i><span class="lang-txt">English<span> (US)</span></span></div>
                    <div class="lang" data-value="de"><i class="flag-icon flag-icon-de"></i><span class="lang-txt">Deutsch</span></div>
                    <div class="lang" data-value="es"><i class="flag-icon flag-icon-es"></i><span class="lang-txt">Español</span></div>
                    <div class="lang" data-value="fr"><i class="flag-icon flag-icon-fr"></i><span class="lang-txt">Français</span></div>
                    <div class="lang" data-value="pt"><i class="flag-icon flag-icon-pt"></i><span class="lang-txt">Português<span> (BR)</span></span></div>
                    <div class="lang" data-value="cn"><i class="flag-icon flag-icon-cn"></i><span class="lang-txt">简体中文</span></div>
                    <div class="lang" data-value="ae"><i class="flag-icon flag-icon-ae"></i><span class="lang-txt">لعربية <span> (ae)</span></span></div>
                </div>
            </div>
        </li>
    @else
        <li class="language-nav">
            <a href="{{ LaravelLocalization::getLocalizedURL(portalChangeLangKey(), null, [], true) }}">
                <img class="b-r-10 " src="{{flagAssets(portalChangeLangKey().'.png') }}">
            </a>
        </li>
    @endif

@endif
