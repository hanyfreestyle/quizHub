<div class="card text-center userHtmlProfile">
    <div class="photosDiv">
        @if($imageType != 'cover')
            <a href="{{route('portal.cards.cardEditCover',$card->uuid)}}">
                <div class="iconBanner"><i class="far fa-edit"></i></div>
            </a>
        @endif
        <div class="cardHeader" style="background-image: url('{{getCardPhoto($card->cover_photo,'banner','m')}}')"></div>
        <div class="userImage">
            <div class="userAvatar">
                @if($imageType != 'profile')
                    <a href="{{route('portal.cards.cardEditProfile',$card->uuid)}}">
                        <div class="iconAvatar"><i class="far fa-edit"></i></div>
                    </a>
                @endif
                <img src="{{getCardPhoto($card->profile,'profile','m')}}">
            </div>
        </div>
    </div>
    @if( $viewPage != 'sort')
        <div class="cardInformation">
            <div class="userName">
                {{$card->first_name}} {{$card->middle_name ?? ''}} {{$card->last_name ?? ''}}
            </div>
            <div class="jop_title">
                {{$card->job_title ?? ''}}
            </div>
            <div class="company">
                <div class="name">
                    {{$card->company_name ?? '' }}
                </div>
                <div class="department">
                    {{$card->department ?? '' }}
                </div>
            </div>
        </div>
    @endif

    @if($viewPage == 'edit' or $viewPage == 'sort')
        <div class="row">
            <div id="MyCardPreview" class="inputRow">
                @include('portal.cards.modal.card_preview')
            </div>
        </div>
    @endif

    @if($viewPage == 'photo' )
        <div class="row">
            <div class="col-12 col-lg-12">
                <div class="social_card_preview_photo">
                    <div class="row">
                        @foreach($card->card_data as $data)
                            <div class="col-lg-3 col-3">
                                <div class="social-item input_color_box {{ $data->input_info->name_key }}">
                                    <div class="social-info">
                                        <i class="{{$data->input_info->icon_i}}"></i>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endif

</div>
