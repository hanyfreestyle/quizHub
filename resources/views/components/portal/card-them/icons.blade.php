<section class="contactSection">
    <div class="container">
        <div class="row contactList {{ IsThem($themVar,'mobile') }} {{ IsThem($themVar,'desk') }}">
            @foreach($card->card_data as $data)
                <a class="listRow {{ IsThem($themVar,'iBorder') }}" target="_blank" href="{{getCardLink($data)}}">
                    <div class="iconBox  {{ getIconColor(IsThem($themVar,'iColor'),$data)}}"><i class="{{$data->input_info->icon_i}}"></i></div>
                    <div class="content-wrapper">
                        {!! getCardLinkInfo($data) !!}
                    </div>
                    @if(IsThem($themVar,'iName'))
                        <div class="contentName">{{$data->input_info->input_id }}</div>
                    @endif
                </a>
            @endforeach
        </div>
    </div>
</section>



