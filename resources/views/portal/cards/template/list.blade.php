@extends('portal.layouts.app')
@section('StyleFile')
    {!! $MinifyTools->setWebAssets('assets/portal/')->MinifyCss('css/card/edit_menu.css',$cssMinifyType,true) !!}
    <style>
        .previewTemplate_2{ background-image: url("{{defCardAssets('template2/img/prview-bg.jpg')}}")}

    </style>
@endsection

@section('content')
    <x-portal.dash.layouts.breadcrumb :page="$page"/>
    <div class="container-fluid container_body templateList">
        <div class="row justify-content-center">
            <x-portal.card.edit-menu :card="$card" :sel-route="$selRoute"/>

            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-12">
                        <x-portal.html.form-massage/>
                    </div>
                </div>
                <div class="row mt-2">
                    @foreach ($templateList as $templateOne)
                        <div class="col-lg-3">
                            <x-portal.card-template.view-card :template="$templateOne" :card="$card"/>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
