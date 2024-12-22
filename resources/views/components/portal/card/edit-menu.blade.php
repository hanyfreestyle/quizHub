<div class="col-lg-12">
    <div class="row">
        <div class="menu__cardMenuEdit">
            <div class="menu_item {{cardEditMenu($selRoute, 'cardEdit')}}">
                <a href="{{route('portal.cards.cardEdit',$card->uuid)}}">
                    <i class="fas fa-edit"></i> <span class="menu-text"> {{__('portal/cards.page_menu_info')}}</span>
                </a>
            </div>
            <div class="menu_item {{cardEditMenu($selRoute, 'cardEditLinks')}}">
                <a href="{{route('portal.cards.cardEditLinks',$card->uuid)}}">
                    <i class="fa-solid fa-puzzle-piece"></i> <span class="menu-text"> {{__('portal/cards.page_menu_links')}}</span>
                </a>
            </div>
            <div class="menu_item {{cardEditMenu($selRoute, 'cardEditSort')}}">
                <a href="{{route('portal.cards.cardEditSort',$card->uuid)}}">
                    <i class="fa-solid fa-arrow-down-wide-short"></i> <span class="menu-text"> {{__('portal/cards.page_menu_sort')}}</span>
                </a>
            </div>
            <div class="menu_item {{cardEditMenu($selRoute, 'cardEditTemplate')}}">
                <a href="{{route('portal.cards.cardEditTemplate',$card->uuid)}}">
                    <i class="fas fa-paint-brush"></i> <span class="menu-text"> {{__('portal/cards.page_menu_them')}}</span>
                </a>
            </div>
            <div class="menu_item">
                <a href="{{route('web.card.cardView',$card->slug)}}" target="_blank">
                    <i class="fa-solid fa-eye"></i> <span class="menu-text"> {{__('portal/cards.page_menu_view')}}</span>
                </a>
            </div>
        </div>

        <div class="menu__cardMenuEditFixed">
            <div class="menu-container">
                <a href="{{route('portal.cards.cardEdit',$card->uuid)}}" class="menu-item {{cardEditMenu($selRoute, 'cardEdit')}}">
                    <i class="fas fa-edit"></i>
                    <span> {{__('portal/cards.page_menu_info_m')}}</span>
                </a>
                <a href="{{route('portal.cards.cardEditLinks',$card->uuid)}}" class="menu-item {{cardEditMenu($selRoute, 'cardEditLinks')}}">
                    <i class="fa-solid fa-puzzle-piece"></i>
                    <span> {{__('portal/cards.page_menu_links')}}</span>
                </a>

                <a href="{{route('portal.cards.cardEditSort',$card->uuid)}}" class="menu-item {{cardEditMenu($selRoute, 'cardEditSort')}}">
                    <i class="fa-solid fa-arrow-down-wide-short"></i>
                    <span>{{__('portal/cards.page_menu_sort')}}</span>
                </a>

                <a href="{{route('portal.cards.cardEditTemplate',$card->uuid)}}" class="menu-item {{cardEditMenu($selRoute, 'cardEditTemplate')}}">
                    <i class="fas fa-paint-brush"></i>
                    <span> {{__('portal/cards.page_menu_them_m')}}</span>
                </a>
            </div>
        </div>




    </div>
</div>




