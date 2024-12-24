@extends('web.layouts.app')
@section('content')
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>

    <div class="landing-page">
        @foreach($questions as $one)
            <section class="section-py-space feature-section" id="corefeature">
                <div class="container">
                    <div class="row g-4">
                        <div class="col-sm-12 wow pulse">
                            <div class="title text-center">
                                <h5>{{$one['name']}} ({{$one['count']}}) </h5>
                            </div>
                        </div>
                        @foreach($one['sectionList'] as $key => $section)
                            <div class="col-xxl-3 col-lg-4 mt-0 col-sm-6 wow flipInX">
                                <a href="{{route('web.quiz.quizView',['unitId'=>$one['unit_id'],'sectionId'=>$key,])}}">
                                    <div class="feature-box common-card bg-feature">
                                        <div class="feature-icon bg-white">
                                            <div><img src="{{defPortalAssets('images/section/'.$key.'.png') }}" alt="feature-icon"></div>
                                        </div>
                                        <h5 class="text-center">
                                            {{ getNameFromCollect($quizCat['sections'],$key,'name') }}
                                            ({{count($section)}})
                                        </h5>
                                        <p class="mb-0 f-light">{{$section->first()->question}}</p>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endforeach

        {{--        <footer class="footer-bg">--}}
        {{--            <div class="container-fluid">--}}
        {{--                <div class="sub-footer row g-md-2 g-3">--}}
        {{--                    <div class="col-md-6">--}}
        {{--                        <div class="left-subfooter"><img class="img-fluid" src="{{getDefPhotoPath($DefPhotoList,'logo_dark')}}" alt="logo">--}}
        {{--                            <p class="mb-0">Copyright 2024 © Profile Hub </p>--}}
        {{--                        </div>--}}
        {{--                    </div>--}}
        {{--                    <div class="col-md-6">--}}
        {{--                        <div class="right-subfooter">--}}
        {{--                            <h3 class="text-end">If You Like Our Theme So Please Rate Us</h3>--}}
        {{--                            <ul>--}}
        {{--                                <li><a href="#" target="_blank">Get Support</a></li>--}}
        {{--                                <li><a href="#" target="_blank">Documentation</a></li>--}}
        {{--                                <li><a href="#" target="_blank">Hire Us</a></li>--}}
        {{--                            </ul>--}}
        {{--                        </div>--}}
        {{--                    </div>--}}
        {{--                </div>--}}
        {{--            </div>--}}
        {{--        </footer>--}}
    </div>
@endsection
