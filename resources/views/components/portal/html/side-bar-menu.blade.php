<li class="sidebar-list">
    @if($pin)
        <i class="fas fa-thumb-tack"></i>
    @endif
    <a class="sidebar-link sidebar-title fix_mobile_ar {{$linkNav}}" href="{{$r}}">
        @if($i)
            <svg class="stroke-icon">
                <use href="{{defPortalAssets('svg/icon-sprite.svg#stroke-'.$i) }}"></use>
            </svg>
            <svg class="fill-icon">
                <use href="{{defPortalAssets('svg/icon-sprite.svg#fill-'.$i) }}"></use>
            </svg>
        @endif
        <span>{{$t}}</span>
    </a>
    {{$slot}}
</li>
