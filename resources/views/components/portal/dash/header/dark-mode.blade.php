@if($active)
    <li>
        <div class="mode darkModeBut">
            <svg class="for-dark">
                <use href="{{defPortalAssets('svg/icon-sprite.svg#moon') }}"></use>
            </svg>
            <svg class="for-light">
                <use href="{{defPortalAssets('svg/icon-sprite.svg#Sun') }}"></use>
            </svg>
        </div>
    </li>
@endif
