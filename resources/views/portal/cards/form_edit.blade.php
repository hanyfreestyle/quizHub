@extends('portal.layouts.app')
@section('StyleFile')
    {!! $MinifyTools->setWebAssets('assets/portal/')->MinifyCss('css/card/edit_menu.css',$cssMinifyType,true) !!}
@endsection

@section('content')
    <x-portal.dash.layouts.breadcrumb :page="$page"/>
    <div class="container-fluid container_body cardAddForm">
        <div class="row justify-content-center">

            <x-portal.card.edit-menu :card="$card" :sel-route="$selRoute"/>

            <div class="row">
                <div class="col-lg-9">
                    <div class="card">
                        <div class="card-body">
                            <x-portal.html.form :route="route('portal.cards.cardUpdate')">
                                @include('portal.cards.form_inc', ['formType' => 'edit'])
                                <x-portal.form.button n="edit"/>
                            </x-portal.html.form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="qrCodeImg qrCodeImgEdit">
                                {!! $qrCode !!}
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

@endsection



