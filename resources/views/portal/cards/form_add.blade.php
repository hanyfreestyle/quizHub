@extends('portal.layouts.app')
@section('content')
    @php
        $p ="portal/cards.";
    @endphp
    <x-portal.dash.layouts.breadcrumb :page="$page"/>
    <div class="container-fluid container_bodyX cardAddFormX">
        <div class="row justify-content-center">
            <x-portal.html.card col="col-lg-9">
                <x-portal.html.form :route="route('portal.cards.cardCreate')">
                    @include('portal.cards.form_inc', ['formType' => 'add'])
                    <x-portal.form.button n="save"/>
                </x-portal.html.form>
            </x-portal.html.card>
        </div>
    </div>
@endsection

@section('AddScript')

@endsection
