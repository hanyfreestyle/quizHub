@extends('portal.layouts.app')
@section('StyleFile')
    <link href="{{defPortalAssets('cropper/cropper.min.css') }}" rel="stylesheet">

@endsection
@section('content')
    <x-portal.dash.layouts.breadcrumb :page="$page"/>

    <div class="container-fluid container_body">
        <div class="row">
            <div class="col-lg-3">
                <div class="card current_image">
                    <div class="card-header pb-0">
                        <h4>{{__('portal/cropper.text_current_image')}}</h4>
                    </div>
                    <div class="card-body main-custom-form input-group-wrapper">
                        <div class="img-container">
                            <img src="{{getUserPhoto($authUser,$page['imageType'],'l')}}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 ">
                <div class="card height-equal cropperHtmlCard">
                    <div class="card-header pb-0">
                        <h4>{{$page['title']}}</h4>
                        <p class="f-m-light mt-1">{{$page['title_p']}}</p>
                    </div>
                    <div class="card-body main-custom-form input-group-wrapper ">
                        <div class="img-container" id="imageContainer">
                            <img id="image" src="">
                        </div>
                        <div class="input-group">
                            <label class="input-group-text">Upload</label>
                            <input class="form-control" id="inputImage" type="file">

                            <x-portal.form.button type="button" bg="se" id="resetButton" n="reload"/>
                        </div>
                        <p id="errorMessage" class="error"></p>

                        <x-portal.form.button type="button" id="cropButton" n="crop" :back="route('portal.profile.editProfile')"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



@section('AddScript')
    <script src="{{defPortalAssets('cropper/cropper.min.js') }}"></script>
    <x-portal.js.cropper :route="route('portal.profile.uploadImage')" :back="route('portal.profile.editProfile')"
                         :rang="$page['rang']" :aspect-ratio="$page['aspectRatio']" :image-type="$page['imageType']"/>
@endsection



