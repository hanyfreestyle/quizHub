@push('tempStyle')
    {!! $MinifyTools->setWebAssets('assets/card/')->MinifyCss('them1/style.css',"Web",true) !!}
    {!! $MinifyTools->setWebAssets('assets/card/')->MinifyCss('them1/style_update.css',"Seo",true) !!}
@endpush


<section class="hero-area" id="hero-area">
    <div class="container">
        <div class="hero-content d-flex justify-content-center">
            <div class="row d-flex align-items-center justify-content-center">

                <div class="col-xl-6 order-xl-last image-block">
                    <div class="image-wrapper" data-tilt data-tilt-max="10">
                        {{--                        <img class="img-fluid" src="{{defCardAssets('them1/image/hero_main_image.png') }}" alt="hero main image">--}}

                        <img class="img-fluid" src="{{getCardPhoto($card->cover,'profile','m')}}" alt="hero main image">
                    </div>
                </div>


                <div class="col-xl-6 order-xl-first content-block">
                    <h1 class="hero-head">
                        {{$card->first_name}}
                        <strong>{{$card->last_name}}</strong></h1>
                    <p>
                        <strong>{{$card->job_title}}</strong>
                        @if($card->company_name)
                            {{__('portal/them.text_in')}} <strong>{{$card->company_name}}</strong>
                        @endif
                    </p>
                    <div class="link-group">
                        <a class="btn-main" href="#"><i class="fa-solid fa-floppy-disk"></i> {{__('portal/them.but_download_csv')}}</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="design-elements">
        <img class="de-hero-1 elem-updown" src="{{defCardAssets('them1/image/design-elements/hero-element-1.png') }}" alt="hero element 1">
        <img class="de-hero-2 elem-move" src="{{defCardAssets('them1/image/design-elements/hero-element-2.png') }}" alt="hero element 2">
        <img class="de-hero-3 elem-updown" src="{{defCardAssets('them1/image/design-elements/hero-element-3.png') }}" alt="hero element 3">
        <img class="de-hero-4 elem-updown" src="{{defCardAssets('them1/image/design-elements/hero-element-4.png') }}" alt="hero element 4">
        <img class="de-hero-5 elem-move" src="{{defCardAssets('them1/image/design-elements/hero-element-5.png') }}" alt="hero element 5">
    </div>
</section>

<section>
    <div class="containerIconBoxed">
        <x-portal.card-them.icons :card="$card"/>
    </div>

</section>
