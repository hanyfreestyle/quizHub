@extends('card.layouts.app')

@section('content')
    @if($layout_id == 1)
        <x-portal.card.template.temp1 :card="$card"/>

    @elseif($layout_id == 2)
        <x-portal.card.template.temp2 :card="$card"/>

    @elseif($layout_id == 3)
        <x-portal.card.template.temp3 :card="$card"/>


    @endif
{{--    <x-portal.card-them.them2 :card="$card"/>--}}
{{--    <x-portal.card-them.them1 :card="$card"/>--}}

    {{--    <x-portal.card-them.icons :card="$card"/>--}}
    {{--    <div class="container">--}}
    {{--        <div class="box-wrapper">--}}

    {{--            <footer class="site-footer" id="site-footer">--}}
    {{--                <div class="row footer-bottom">--}}
    {{--                    <div class="col-md-6">--}}
    {{--                        <p>All rights reserved &copy; 2023 <strong>eThemeStudio</strong></p>--}}
    {{--                    </div>--}}
    {{--                    <div class="col-md-6">--}}
    {{--                        <ul class="list-inline text-md-end">--}}
    {{--                            <li class="list-inline-item"><a href="#">Terms &amp; Condition</a></li>--}}
    {{--                            <li class="list-inline-item"><a href="#">Privacy Policy</a></li>--}}
    {{--                        </ul>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--            </footer>--}}
    {{--        </div>--}}
    {{--    </div>--}}




@endsection
