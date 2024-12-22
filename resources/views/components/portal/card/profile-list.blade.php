@foreach($row as $card)
    <div class="{{$col}}">
        <div class="card social-profile  profile-card" data-card-id="{{$card->uuid}}">
            <div class="card-body">
                <div class="topBar">
                    <div class="card_color">
                        <div class="back_box" style="background-color:{{$card->template->color ?? null}} !important;"></div>
                    </div>
                    <div class="card_name">
                        <a href="{{route('portal.cards.editTemplateSettings',$card->template->uuid)}}"> <span>{{ getNameFromCollect($templateList,$card->template->layout_id,'name')}}</span></a>
                    </div>
                </div>
                <div class="social-img-wrap">
                    <div class="social-img"><img src="{{  getCardPhoto($card->template->profile,'profile','m')}}" alt="profile"></div>
                    <div class="edit-icon status-toggle" data-id="{{ $card->uuid }}" data-status="{{ $card->is_active }}">
                        <svg>
                            <use href="{{ $card->is_active ? svgIcon('profile-check') : svgIcon('profile-disabled') }}"></use>
                        </svg>
                    </div>
                </div>

                <div class="social-details">
                    <div class="user_card_name mb-1">{{ getCardName($card) }}</div>
                    <x-portal.dynamic.html-text :row="$card" field-name="job_title" :no-data="__('portal/cards.mass_no_job_title')"/>

                    <ul class="card-social">
                        <li><a href="#" target="_blank"><i class="fa-solid fa-link"></i></a></li>
                        <li><a href="#" target="_blank"><i class="fa-solid fa-envelope-circle-check"></i></a></li>
                        <li><a href="{{generateWhatsappLink($card->slug)}}" target="_blank"><i class="fa-brands fa-whatsapp"></i></a></li>
                        <li><a href="#" target="_blank"><i class="fa-brands fa-telegram"></i></a></li>
                        <li><a href="#" class="modalOpenQrCode" data-card-id="{{$card->uuid}}"><i class="fa-solid fa-qrcode"></i></a></li>
{{--                        <li><span class="modalOpenQrCode" data-card-id="{{$card->uuid}}"><i class="fa-solid fa-qrcode"></i></span></li>--}}
                    </ul>
                    <ul class="social-follow">
                        <li><a href="{{route('portal.cards.cardEdit',$card->uuid)}}"><h5 class="mb-0"><i class="fa-solid fa-pen-to-square font-secondary"></i></h5></a></li>
                        <li><a href="{{route('web.card.cardView',$card->slug)}}" target="_blank" ><h5 class="mb-0"><i class="fa-solid fa-eye font-info"></i></h5></a></li>
                        <li><a href="#" onclick="deleteItem(this)"><h5 class="mb-0"><i class="fa-solid fa-trash font-danger"></i></h5></a></li>

                    </ul>

                </div>
            </div>
        </div>
    </div>
@endforeach


