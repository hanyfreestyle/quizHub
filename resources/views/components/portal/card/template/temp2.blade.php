@push('tempStyle')
{{--    {!! $MinifyTools->setWebAssets('assets/card/')->MinifyCss('template2/style_temp.css',"Seo",true) !!}--}}
    {!! $MinifyTools->setWebAssets('assets/card/')->MinifyCss('template2/style.css',"Seo",true) !!}
    <style>
        .hero-area {
            background: url("{{defCardAssets('template2/img/hero-bg.jpg') }}") no-repeat center center;
        }
    </style>
@endpush
<section class="hero-area" id="hero-area">
    <div class="container">
        <div class="hero-content d-flex justify-content-center">
            <div class="row d-flex align-items-center justify-content-center">

                <div class="col-xl-6 order-xl-last image-block">
                    <div class="image-wrapper" data-tilt data-tilt-max="10">
                        <div class="imgCover">
                            <img class="img-fluid" src="{{getCardPhoto($card->template->profile,'profile','m-w')}}" alt="hero main image">
                        </div>
                    </div>
                </div>

                <div class="col-xl-6 order-xl-first content-block">
                    <div class="hello">{!! __('portal/them.text_hello') !!}</div>
                    <h1 class="hero-head">{{$card->first_name}}
                        <br><span>{{$card->last_name}}</span></h1>

                    @if($card->bio)
                        <p class="bio" style="min-height: 200px">{{$card->bio}}</p>
                    @endif

                    <div class="link-group">
                        <a class="btn-main" href="{{route('web.card.downloadVcf',$card->slug)}}"><i class="fa-solid fa-floppy-disk"></i> {{__('portal/them.but_download_csv')}}</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="design-elements">
        <img class="de-hero-1 elem-updown" src="{{defCardAssets('template2/img/hero-element-1.png') }}" alt="hero element 1">
        <img class="de-hero-2 elem-move" src="{{defCardAssets('template2/img/hero-element-2.png') }}" alt="hero element 2">
        <img class="de-hero-3 elem-updown" src="{{defCardAssets('template2/img/hero-element-3.png') }}" alt="hero element 3">
        <img class="de-hero-4 elem-updown" src="{{defCardAssets('template2/img/hero-element-4.png') }}" alt="hero element 4">
        <img class="de-hero-5 elem-move" src="{{defCardAssets('template2/img/hero-element-5.png') }}" alt="hero element 5">
    </div>
</section>


<div class="container">
    <div class="containerWidth">
        <div class="containerIconWidth">
            <x-portal.card-them.icons :card="$card"/>
        </div>
    </div>
</div>
