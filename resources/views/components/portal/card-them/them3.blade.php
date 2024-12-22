@push('tempStyle')
    {{--    {!! $MinifyTools->setWebAssets('assets/card/')->MinifyCss('_vendor/fungi/css/style.css',"Seo",true) !!}--}}
{{--    {!! $MinifyTools->setWebAssets('assets/card/')->MinifyCss('them3/style.css',"Seo",true) !!}--}}
    {!! $MinifyTools->setWebAssets('assets/card/')->MinifyCss('them3/style_update.css',"Seo",true) !!}
@endpush

<div class="container">
    <div class="box-wrapper">
        <section class="hero-area" id="hero-area">
            <div class="row d-flex align-items-center justify-content-center">
                <div class="col-lg-12 content-block">
                    <div class="image-wrapper">
                        <img class="img-fluid" src="{{getCardPhoto($card->profile,'profile','m')}}" alt="">
                    </div>
                    <h1 class="hero-head">
                        {{$card->first_name}} <strong>{{$card->last_name}}</strong>
                    </h1>
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
        </section>


        <x-portal.card-them.icons :card="$card"/>


    </div>
</div>
