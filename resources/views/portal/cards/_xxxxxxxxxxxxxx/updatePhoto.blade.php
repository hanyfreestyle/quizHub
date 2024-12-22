@extends('portal.layouts.app')
@section('StyleFile')
    <link href="{{defPortalAssets('cropper/cropper.min.css') }}" rel="stylesheet">

@endsection
@section('content')
    <x-portal.dash.layouts.breadcrumb :page="$page"/>

    <div class="container-fluid container_body">
        <div class="row  justify-content-center">
            <div class="col-lg-7">
                <x-portal.cropper.html-code :t="$page['card']" :p="$page['card_p']" :row="$card" />
            </div>

            <div class="col-lg-4">
                <x-portal.card.card-preview :card="$card" view-page="photo" :image-type="$page['imageType']" />
            </div>
        </div>
    </div>
@endsection



@section('AddScript')
    <script src="{{defPortalAssets('cropper/cropper.min.js') }}"></script>
    <x-portal.cropper.js-code :route="route('portal.cards.photoUpload')" back="self"
                              :aspect-ratio="$page['aspectRatio']"
                              :rang="$page['rang']"
                              :image-type="$page['imageType']"
                              :update-id="$card->uuid"

    />
@endsection



