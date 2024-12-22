@extends('portal.layouts.app')
@section('StyleFile')
    {!! $MinifyTools->setWebAssets('assets/portal/')->MinifyCss('css/card/edit_menu.css',$cssMinifyType,true) !!}
@endsection


@section('content')
    <x-portal.dash.layouts.breadcrumb :page="$page"/>
    <div class="container-fluid container_body cardAddForm">
        <div class="row justify-content-center">

            <x-portal.card.edit-menu :card="$card" :sel-route="$selRoute"/>

            <div class="col-lg-3 order-1 order-lg-0 templateEditPhoto">
                <x-portal.card-template.view-photo :template="$template" :card="$card" :template-list="$templateList"/>
            </div>

            <div class="col-lg-6 order-0 order-lg-1">
                <x-portal.card-template.config-form :template="$template" :form-data="$formData" />
            </div>

            <div class="col-lg-3 order-2 order-lg-2 templateEdit">
                <x-portal.card-template.view-card :template="$template" :card="$card" view-type="edit"/>
            </div>
        </div>
    </div>

    {!! printViewCardTemp($card) !!}
@endsection

@section('AddScript')


@endsection



