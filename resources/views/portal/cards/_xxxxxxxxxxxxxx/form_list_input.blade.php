@extends('portal.layouts.app')
@section('BeforStrap')

@endsection
@section('content')
    <x-portal.dash.layouts.breadcrumb :page="$page"/>
    <div class="container-fluid container_body cardAddForm">
        <div class="row">
            <div class="col-xl-4">
                <x-portal.card.card-preview/>
            </div>


            <div class="col-xl-8">

                @include('portal.cards.inc_menu_edit')

                <div class="card mt-3">
                    <div class="card-header pb-0">
                        <h4>{{ $page['groupName'] }}</h4>
                        <hr>
                    </div>
                    <div class="card-body">
                        <div class="row col-12 fieldsList">
                            @foreach($cardInputs as $field)

                                <div class="text-center fildrow ">
                                    <a href="#" class="{{ $field->name_key }}">
                                        <div class="quick_box"><i class="{!! $field->icon_i !!}  "></i></div>
                                        <h6>{{$field->name}}</h6>
                                    </a>
                                </div>
                            @endforeach
                        </div>

                        <hr>

                    </div>
                </div>



            </div>


        </div>
    </div>

@endsection



@section('AddScript')

@endsection



