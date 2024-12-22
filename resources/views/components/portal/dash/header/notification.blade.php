@if($active)
    <li class="onhover-dropdown">
        <div class="notification-box">
            <svg>
                <use href="{{defPortalAssets('svg/icon-sprite.svg#Bell') }}"></use>
            </svg>
        </div>
        <div class="onhover-show-div notification-dropdown">
            <h6 class="f-18 mb-0 dropdown-title">Notifications</h6>
            <div class="notification-card">
                <ul>
                    @for ($i = 1; $i <= 4; $i++)
                        <li>
                            <div class="user-notification">
                                <div><img src="{{defPortalAssets('images/avtar-45.jpg') }}" alt="avatar"></div>
                                <div class="user-description">
                                    <a href="#">
                                        <h4>You have new finical page design.</h4>
                                    </a>
                                    <span>Today 11:45pm</span>
                                </div>
                            </div>
                            <div class="notification-btn">
                                <button class="btn btn-pill btn-primary" type="button" title="btn btn-pill btn-primary">Accpet</button>
                                <button class="btn btn-pill btn-secondary" type="button" title="btn btn-pill btn-primary">Decline</button>
                            </div>
                            <div class="show-btn"><a href="#"> <span>Show</span></a></div>
                        </li>
                    @endfor
                    <li><a class="f-w-700" href="#">Check all </a></li>
                </ul>
            </div>
        </div>
    </li>
@endif
