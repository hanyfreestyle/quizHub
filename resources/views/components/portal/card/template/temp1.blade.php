@push('tempStyle')
    {!! $MinifyTools->setWebAssets('assets/card/')->MinifyCss('template1/style.css',"Seo",true) !!}
@endpush
<div class="container">
    <div class="containerBoxed">

        @if($card->template->cover)
            <div class="coverDiv">
                <img src="{{getCardPhoto($card->template->cover,'cover','m')}}" alt="Banner Image" class="banner-img">
                <div class="profile">
                    <img src="{{getCardPhoto($card->template->profile,'profile','m')}}" alt="Profile Image" class="profile-img">
                </div>
            </div>
        @else
            <div class="coverDiv profileNoCover">
                <div class="profile">
                    <img src="{{getCardPhoto($card->template->profile,'profile','m')}}" alt="Profile Image" class="profile-img">
                </div>
            </div>
        @endif

        <div class="userInfo">
            <h1 class="name">{{$card->first_name}} {{$card->middle_name}} <span>{{$card->last_name}}</span></h1>
            @if($card->job_title)
                <h2 class="job">{{$card->job_title}}</h2>
            @endif
            @if($card->department)
                <h3 class="department">{{$card->department}}</h3>
            @endif
            @if($card->company_name)
                <h4 class="company">{{$card->company_name}}</h4>
            @endif
        </div>

        @if($card->bio)
            <div class="userBio mb-3">
                <p>{{$card->bio}}</p>
            </div>
        @endif


        <div class="buttonSave">
            <a href="{{route('web.card.downloadVcf',$card->slug)}}"><i class="fa-solid fa-floppy-disk"></i> {{__('portal/them.but_download_csv')}}</a>
        </div>


        <div class="containerIconBoxed">
            <x-portal.card-them.icons :card="$card"/>
        </div>

        <div class="buttonSaveFooter">
            <a href="{{route('web.card.downloadVcf',$card->slug)}}"><i class="fa-solid fa-floppy-disk"></i> {{__('portal/them.but_download_csv')}}</a>
        </div>
    </div>
</div>
