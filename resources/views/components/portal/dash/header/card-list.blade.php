@if($active and count($cards) > 0)
    <li class="onhover-dropdown">
        <div class="notification-box">
            <svg>
                <use href="{{defPortalAssets('svg/icon-sprite.svg#Work') }}"></use>
            </svg>
        </div>
        <div class="onhover-show-div notification-dropdown notificationCardList">
            <h6 class="f-18 mb-0 dropdown-title">{{__('portal/cards.app_menu')}}</h6>
            <div class="notification-card">

                @foreach($cards as $card)
                    <div class="notification_CardList">
                        <div class="card_img">
                            <a href="{{route('portal.cards.cardEdit',$card->uuid)}}">
                                <img src="{{  getCardPhoto($card->template->profile,'profile','m')}}" alt="avatar">
                            </a>


                        </div>
                        <div class="card_name">
                            <a href="{{route('portal.cards.cardEdit',$card->uuid)}}">
                                <h2>{{$card->card_name}} </h2>
                                <h3>{{$card->first_name }} {{$card->last_name}} </h3>
                            </a>
                        </div>
                        <div class="card_action">
{{--                            <a href="{{route('portal.cards.cardEdit',$card->uuid)}}" class="edit-icon">--}}
{{--                                <i class="fas fa-edit font-info"></i>--}}
{{--                            </a>--}}

                            <a href="{{route('portal.cards.cardEditTemplate',$card->uuid)}}" class="template-icon">
                                <i class="fas fa-paint-brush font-secondary"></i>
                            </a>

                            <a href="{{route('web.card.cardView',$card->slug)}}" target="_blank" class="view-icon">
                                <i class="fas fa-eye font-success"></i>
                            </a>

                        </div>
                    </div>
                @endforeach

                @if(count($cards)>5)
                    <ul>
                        <li><a class="f-w-700" href="{{route('portal.cards.cardsList')}}">{{__('portal/dash.but_show_all')}}</a></li>
                    </ul>
                @endif

            </div>
        </div>
    </li>
@endif
