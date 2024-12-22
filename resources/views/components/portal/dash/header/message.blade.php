@if($active)
    <li class="onhover-dropdown">
        <div class="message position-relative">
            <svg>
                <use href="{{defPortalAssets('svg/icon-sprite.svg#Message') }}"></use>
            </svg>
            <span class="rounded-pill badge-danger"></span>
        </div>
        <div class="onhover-show-div message-dropdown">
            <h6 class="f-18 mb-0 dropdown-title">Message</h6>
            <ul>

                @for ($i = 1; $i <= 3; $i++)
                    <li>
                        <div class="d-flex align-items-start">
                            <div class="message-img bg-light-primary"><img src="{{defPortalAssets('images/avtar-45.jpg') }}" alt=""></div>
                            <div class="flex-grow-1">
                                <h5><a href="#">Emay Walter</a></h5>
                                <p>Do you want to go see movie?</p>
                            </div>
                            <div class="notification-right"><i data-feather="x"></i></div>
                        </div>
                    </li>

                @endfor

                <li><a class="f-w-700" href="#">Check all</a></li>
            </ul>
        </div>
    </li>
@endif

