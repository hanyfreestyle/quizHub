@if($type == 'D')
    @if($active)
        <form class="col-sm-4 form-inline search-full d-none d-xl-block" action="#" method="get">
            <div class="form-group">
                <div class="Typeahead Typeahead--twitterUsers">
                    <div class="u-posRelative">
                        <input class="demo-input Typeahead-input form-control-plaintext w-100" type="text" placeholder="Type to Search .." name="q" title="" autofocus>
                        <svg class="search-bg svg-color">
                            <use href="{{defPortalAssets('svg/icon-sprite.svg#search') }}"></use>
                        </svg>
                    </div>
                </div>
            </div>
        </form>
    @else
        <div class="col-sm-4 form-inline search-full d-none d-xl-block"></div>
    @endif
@elseif($type == 'Mobile')
    @if($active)
        <li class="serchinput">
            <div class="serchbox">
                <svg>
                    <use href="{{defPortalAssets('svg/icon-sprite.svg#search') }}"></use>
                </svg>
            </div>
            <div class="form-group search-form">
                <input type="text" placeholder="Search here...">
            </div>
        </li>
    @endif
@endif


