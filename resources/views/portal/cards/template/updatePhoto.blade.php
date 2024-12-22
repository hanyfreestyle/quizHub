@extends('portal.layouts.app')
@section('StyleFile')
    {!! $MinifyTools->setWebAssets('assets/portal/')->MinifyCss('css/card/edit_menu.css',$cssMinifyType,true) !!}
    <link href="{{defPortalAssets('cropper/cropper.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <x-portal.dash.layouts.breadcrumb :page="$page"/>


    <div class="container-fluid container_body">
        <div class="row  justify-content-center">

            <x-portal.card.edit-menu :card="$card" :sel-route="$selRoute"/>

            <div class="col-lg-7">
                <x-portal.cropper.html-code :t="$page['card']" :p="$page['card_p']" :row="$card" :route="route('portal.cards.editTemplateSettings',$template->uuid)"/>
            </div>
            <div class="col-lg-3 templateEditPhoto">
                <div class="card">
                    <div class="card-body">
                        <div class="templateCard">
                            <h3>{{__('portal/dash.lable_current_photo')}}</h3>
                            <div class="template_img_div">
                                @if($page['imageType'] == 'profile')
                                    <img src="{{getCardPhoto($template->profile,'profile','m')}}">
                                @elseif($page['imageType'] == 'cover')
                                    <img src="{{getCardPhoto($template->cover,'cover','m')}}">
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

{!! printViewCardTemp($card) !!}

@endsection

@section('AddScript')
    <script src="{{defPortalAssets('cropper/cropper.min.js') }}"></script>
    <x-portal.cropper.js-code :route="route('portal.cards.templatePhotoUpload')" :back="route('portal.cards.editTemplateSettings',$template->uuid)"
                              :aspect-ratio="$page['aspectRatio']"
                              :rang="$page['rang']"
                              :image-type="$page['imageType']"
                              :update-id="$template->uuid"/>
@endsection



