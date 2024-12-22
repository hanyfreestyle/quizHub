@if($active)
    <li class="onhover-dropdown">
        <svg>
            <use href="{{defPortalAssets('svg/icon-sprite.svg#Bookmark') }}"></use>
        </svg>
        <div class="onhover-show-div bookmark-flip">
            <div class="flip-card">
                <div class="flip-card-inner">
                    <div class="front">
                        <h6 class="f-18 mb-0 dropdown-title">Bookmark</h6>
                        <ul class="bookmark-dropdown">
                            <li>
                                <div class="row">
                                    <div class="col-4 text-center">
                                        <a href="form-validation.html">
                                            <div class="bookmark-content">
                                                <div class="bookmark-icon bg-light-primary"><i data-feather="file-text"></i></div>
                                                <span>Forms</span>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-4 text-center">
                                        <a href="user-profile.html">
                                            <div class="bookmark-content">
                                                <div class="bookmark-icon bg-light-secondary"><i data-feather="user"></i></div>
                                                <span>Profile</span>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-4 text-center">
                                        <a href="bootstrap-basic-table.html">
                                            <div class="bookmark-content">
                                                <div class="bookmark-icon bg-light-warning"><i data-feather="server"> </i></div>
                                                <span>Tables </span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </li>
                            <li class="text-centermedia-body"><a class="flip-btn f-w-700" id="flip-btn" href="javascript:void(0)">Add New Bookmark</a></li>
                        </ul>
                    </div>
                    <div class="back">
                        <ul>
                            <li>
                                <div class="bookmark-dropdown flip-back-content">
                                    <input type="text" placeholder="search...">
                                </div>
                            </li>
                            <li><a class="f-w-700 d-block flip-back" id="flip-back" href="javascript:void(0)">Back</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </li>
@endif

