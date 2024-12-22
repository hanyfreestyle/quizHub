@extends('portal.layouts.appAuth')

@section('content')
    <div class="container-fluid authPage container_body">
        <div class="row">
            <div class="col-xl-5 img_bg">
                <img class="bg-img-cover bg-center" src="{{defPortalAssets('img/sign-up.jpg')}}" alt="logo">
            </div>
            <div class="col-xl-7 p-0">
                <div class="login-card login-dark login-bg">
                    <div>
                        <div class="selLang">
                            <a href="{{ LaravelLocalization::getLocalizedURL(portalChangeLangKey(), null, [], true) }}">
                                <img class="b-r-10 " width="30px" src="{{flagAssets(portalChangeLangKey().'.png') }}">
                            </a>
                        </div>
                        <div>
                            <a class="logoAuth" href="{{route('web.index')}}">
                                <img class="img-fluid for-dark" src="{{getDefPhotoPath($DefPhotoList,'logo_dark')}}" alt="logo">
                            </a>
                        </div>
                        <div class="login-main">
                            <form class="theme-form needs-validation custom-input customForm" action="{{route('portal.signUpCreate')}}" method="post" novalidate="" data-parsley-validate="">
                                @csrf
                                <h4>{!! __('portal/auth.h1_sign_up') !!}</h4>
                                <p class="h4_p">{!! __('portal/auth.h1_sign_up_p') !!}</p>

                                <x-site.html.confirm-massage/>

                                <x-portal.form.input col="12|12" name="name" :l="__('portal/auth.form_name')" i="fas fa-user"/>
                                <x-portal.form.input col="12|12" name="email" :l="__('portal/auth.form_email')" i="fa-regular fa-envelope" type="email" dir="en" req-type="email" add-style="lang_en"/>
                                <x-portal.form.input col="12|12" name="password" type="password" :l="__('portal/auth.form_pass')" i="fa-solid fa-lock" type="password" dir="en" req-type="len[8,40]"/>
                                <x-portal.form.input col="12|12" name="password_confirmation" type="password" :l="__('portal/auth.form_pass_confirm')" i="fas fa-redo-alt" type="password" dir="en"
                                                     req-type="len[8,40]|equal[#password]"/>

                                <div class="remember-forgot mt-3 formControl">
                                    <label class="remember-me">
                                        <input name="terms" @if (old('terms')) checked @endif type="checkbox" required>
                                        {{ __('portal/auth.form_terms_agree_with') }}
                                        <span> <a href="#" data-bs-toggle="modal" data-bs-target=".bd-example-modal-fullscreen">{{__('portal/auth.form_terms')}}</a></span>
                                    </label>
                                    @error("terms")
                                    <div class="invalid-feedback" role="alert">{{ \App\Helpers\AdminHelper::error($message,"terms","hhhh") }}</div>
                                    @enderror
                                </div>


                                <div class="form-group mb-0">
                                    <button class="btn btn-primary btn-block w-100 submit_form" type="submit">{{__('portal/auth.form_text_sign_up')}}</button>
                                </div>

                                <h6 class="text-muted mt-4 or">{!! __('portal/auth.form_text_social_account') !!}</h6>
                                <div class="social mt-4">
                                    <div class="btn-showcase">

                                        <a class="btn btn-light" href="#">
                                            <i class="fab fa-google"></i> Google
                                        </a>
                                        <a class="btn btn-light" href="#">
                                            <i class="fab fa-facebook-square"></i> Facebook
                                        </a>
                                    </div>
                                </div>
                                <p class="mt-4 mb-0 text-center footer_form_text">
                                    {!!__('portal/auth.form_text_have') !!}
                                    <a class="ms-2" href="{{route('portal.login')}}">{{__('portal/auth.form_h1_login')}}</a>
                                </p>
                            </form>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade bd-example-modal-fullscreen" tabindex="-1" role="dialog" aria-labelledby="myFullLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myFullLargeModalLabel">{{__('portal/auth.form_terms')}}</h4>
                    <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body dark-modal">
                    <div class="PrivacyList">
                        @foreach($Terms as $Term)
                            <h2>{!! $Term->h1 !!}</h2>
                            <h3>{!! $Term->h2 !!}</h3>
                            <p>{!! ChangeText($Term->des) !!}</p>
                            @if($Term->lists)
                                <ul>
                                    @foreach(explode(PHP_EOL, $Term->lists) as $list)
                                        <li>{{$list}}</li>
                                    @endforeach
                                </ul>
                            @endif
                        @endforeach
                    </div>


                    {{--                    <div class="large-modal-header"><i data-feather="chevrons-right"></i>--}}
                    {{--                        <h6>Web design </h6>--}}
                    {{--                    </div>--}}
                    {{--                    <p class="modal-padding-space">We build specialised websites for companies, list them on digital directories, and set up a sales funnel to boost ROI.</p>--}}
                    {{--                    <div class="large-modal-header"><i data-feather="chevrons-right"></i>--}}
                    {{--                        <h6>Content marketing </h6>--}}
                    {{--                    </div>--}}
                    {{--                    <p class="modal-padding-space">Through better opportunities and knowledgeable marketing strategies, we aid business funnel. We won't only hit the target; instead, we'll aim higher and surpass the objectives.</p>--}}
                    {{--                    <div class="large-modal-header"><i data-feather="chevrons-right"></i>--}}
                    {{--                        <h6>PPC </h6>--}}
                    {{--                    </div>--}}
                    {{--                    <p class="modal-padding-space">Customized advertising to increase visitors and improve conversion. To increase retention, identify the correct audience and remarket to them.</p>--}}
                    {{--                    <div class="large-modal-header"><i data-feather="chevrons-right"></i>--}}
                    {{--                        <h6>UX designer </h6>--}}
                    {{--                    </div>--}}
                    {{--                    <p class="modal-padding-space">The capacity to comprehend and experience other people's feelings is known as empathy. A positive consumer experience is prioritised by UX. The finest UX designers spend time studying individuals and their tendencies because of this. Designers may produce goods that genuinely engage and excite customers by having a thorough understanding of the end consumers.</p>--}}
                    {{--                    --}}


                </div>
            </div>
        </div>
    </div>


@endsection





