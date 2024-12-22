@push('tempStyle')
    {!! $MinifyTools->setWebAssets('assets/card/')->MinifyCss('template3/style.css',"Seo",true) !!}
@endpush

<div class="container">
    <div class="containerWidth">
        <div class="containerIconWidth">
            <x-portal.card-them.icons :card="$card"/>
        </div>
    </div>
</div>

