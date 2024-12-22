@if($active)
    <li class="cart-nav onhover-dropdown">
        <div class="cart-box">
            <svg>
                <use href="{{defPortalAssets('svg/icon-sprite.svg#Buy') }}"></use>
            </svg>
        </div>
        <div class="cart-dropdown onhover-show-div">
            <h6 class="f-18 mb-0 dropdown-title">Cart</h6>
            <ul>
                @for ($i = 1; $i <= 2; $i++)
                    <li>
                        <div class="d-flex"><img class="img-fluid b-r-5 img-50" src="{{defPortalAssets('images/ecommerce.jpg') }}" alt="">
                            <div class="flex-grow-1"><span>Women's Track Suit dddd</span>
                                <h6 class="font-primary">8 x $65.00</h6>
                            </div>
                            <div class="close-circle"><a class="bg-primary" href="#"><i data-feather="x"></i></a></div>
                        </div>
                    </li>

                @endfor
                <li class="total">
                    <h6 class="mb-0">Order Total :<span class="f-right">$1020.00</span></h6>
                </li>
                <li class="text-center">
                    <a href="#"><button class="btn btn-outline-primary" type="button">View Cart</button></a>
                    <a class="btn btn-primary view-checkout" href="#">Checkout </a>
                </li>
            </ul>
        </div>
    </li>
@endif

