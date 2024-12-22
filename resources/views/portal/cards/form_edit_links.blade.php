@extends('portal.layouts.app')
@section('StyleFile')
    {!! $MinifyTools->setWebAssets('assets/portal/')->MinifyCss('css/card/edit_menu.css',$cssMinifyType,true) !!}
@endsection

@section('content')
    <x-portal.dash.layouts.breadcrumb :page="$page"/>
    <div class="container-fluid container_body cardAddForm">
        <div class="row justify-content-center">

            <x-portal.card.edit-menu :card="$card" :sel-route="$selRoute"/>

            <div class="row justify-content-center mb-5">

                <div class="col-lg-6">
                    <div class="my-accordion card_addON_container">

                        <div class="accordion-item">
                            <div class="accordion-header active">
                                <span>الموصى بيه</span>
                                <span class="arrow">▼</span>
                            </div>
                            <div class="accordion-content active">
                                <div class="inputTemplateList">
                                    @foreach($CashCardInputVipTemplate as $field )
                                        @php
                                            $count = $groupedData->get($field->id, 0);
                                        @endphp
                                        <div class="text-center inputRow portalCardInputSelect" id="badge_{{$field->id}}">
                                            @if($count > 0)
                                                <span class="badge_count bg-primary">{{ $count }}</span>
                                            @endif
                                            <div class="modalCardDataAddBut" data-card-id="{{$card->id}}" data-temp-id="{{$field->id}}" data-card-data-id="0">
                                                <div class="input_color_box {{ $field->name_key }}"><i class="{!! $field->icon_i !!}"></i></div>
                                                <h6>{{$field->name}}</h6>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        @foreach($cashCardInputTemplate as $category => $fields)
                            @php
                                $nameId = getDataFromDefCat($DefCat['PortalInputCategory'], $category,'parentCard');
                            @endphp

                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <span>{{getDataFromDefCat($DefCat['PortalInputCategory'], $category,'name')}}</span>
                                    <span class="arrow">▼</span>

                                </div>
                                <div class="accordion-content">
                                    <div class="accordion-body">
                                        <div class="inputTemplateList">
                                            @foreach($fields as $field)
                                                @php
                                                    $count = $groupedData->get($field->id, 0);
                                                @endphp
                                                <div class="text-center inputRow portalCardInputSelect" id="badge_{{$field->id}}">
                                                    @if($count > 0)
                                                        <span class="badge_count bg-primary">{{ $count }}</span>
                                                    @endif
                                                    <div class="modalCardDataAddBut" data-card-id="{{$card->id}}" data-temp-id="{{$field->id}}" data-card-data-id="0">
                                                        <div class="input_color_box {{ $field->name_key }}"><i class="{!! $field->icon_i !!}"></i></div>
                                                        <h6>{{$field->name}}</h6>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach


                    </div>

                </div>
                <div class="col-lg-6" style="display: none">

                    <div class="col-sm-12 col-lg-12">
                        <div class="card card_addON_container">
                            <div class="accordion dark-accordion" id="simpleaccordion">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button class="accordion-button collapsed bg-light-primary font-primary active" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne"
                                                aria-expanded="true" aria-controls="collapseOne">What do web designers do?<i class="svg-color" data-feather="chevron-down"></i></button>
                                    </h2>
                                    <div class="accordion-collapse collapse show" id="collapseOne" aria-labelledby="headingOne" data-bs-parent="#simpleaccordion">
                                        <div class="accordion-body">
                                            <p>
                                                Web design<em class="txt-danger"> identifies the goals</em> of a website or webpage and promotes accessibility for all potential users. This process
                                                involves organizing content and images across a series of pages and integrating applications and other interactive elements.</p>
                                        </div>
                                    </div>
                                </div>

                                @foreach($cashCardInputTemplate as $category => $fields)
                                    @php
                                        $nameId = getDataFromDefCat($DefCat['PortalInputCategory'], $category,'parentCard');
                                    @endphp

                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingTwo{{$category}}">
                                            <button class="accordion-button collapsed bg-light-primary font-primary active" type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#collapseTwo{{$category}}" aria-expanded="false" aria-controls="collapseTwo{{$category}}">
                                                {{getDataFromDefCat($DefCat['PortalInputCategory'], $category,'name')}} <i class="svg-color" data-feather="chevron-down"></i>
                                            </button>
                                        </h2>
                                        <div class="accordion-collapse collapse" id="collapseTwo{{$category}}" aria-labelledby="headingTwo{{$category}}" data-bs-parent="#simpleaccordion">
                                            <div class="accordion-body inputTemplateList">
                                                @foreach($fields as $field)
                                                    @php
                                                        $count = $groupedData->get($field->id, 0);
                                                    @endphp
                                                    <div class="text-center inputRow portalCardInputSelect" id="badge_{{$field->id}}">
                                                        @if($count > 0)
                                                            <span class="badge_count bg-primary">{{ $count }}</span>
                                                        @endif
                                                        <div class="modalCardDataAddBut" data-card-id="{{$card->id}}" data-temp-id="{{$field->id}}" data-card-data-id="0">
                                                            <div class="input_color_box {{ $field->name_key }}"><i class="{!! $field->icon_i !!}"></i></div>
                                                            <h6>{{$field->name}}</h6>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{--                    <div class="card card_addON_container">--}}
                    {{--                        @foreach($cashCardInputTemplate as $category => $fields)--}}
                    {{--                            @php--}}
                    {{--                                $nameId = getDataFromDefCat($DefCat['PortalInputCategory'], $category,'parentCard');--}}
                    {{--                            @endphp--}}


                    {{--                            <div class="card-body pb-0">--}}
                    {{--                                <div class="row col-12">--}}
                    {{--                                    <div class="h1">{{getDataFromDefCat($DefCat['PortalInputCategory'], $category,'name')}}</div>--}}
                    {{--                                </div>--}}

                    {{--                                <div class="row col-12 inputTemplateList">--}}
                    {{--                                    @foreach($fields as $field)--}}
                    {{--                                        @php--}}
                    {{--                                            $count = $groupedData->get($field->id, 0);--}}
                    {{--                                        @endphp--}}
                    {{--                                        <div class="text-center inputRow portalCardInputSelect" id="badge_{{$field->id}}">--}}
                    {{--                                            @if($count > 0)--}}
                    {{--                                                <span class="badge_count bg-primary">{{ $count }}</span>--}}
                    {{--                                            @endif--}}
                    {{--                                            <div class="modalCardDataAddBut" data-card-id="{{$card->id}}" data-temp-id="{{$field->id}}" data-card-data-id="0">--}}
                    {{--                                                <div class="input_color_box {{ $field->name_key }}"><i class="{!! $field->icon_i !!}"></i></div>--}}
                    {{--                                                <h6>{{$field->name}}</h6>--}}
                    {{--                                            </div>--}}
                    {{--                                        </div>--}}
                    {{--                                    @endforeach--}}
                    {{--                                </div>--}}
                    {{--                            </div>--}}

                    {{--                        @endforeach--}}
                    {{--                    </div>--}}
                </div>

                <div class="col-lg-6">
                    <x-portal.card.edit-input-view :card="$card"/>
                </div>

            </div>

            <div class="row mt-5"></div>

        </div>
    </div>
    {!! printViewCardTemp($card) !!}
    <x-portal.js.pages.modal-code print="html"/>
@endsection

@section('AddScript')
    <x-portal.js.sweet-alert-soft :r="route('portal.cards.deleteCardData')"/>
    <x-portal.js.pages.modal-code print="js"/>
    <x-portal.js.pages.edit-card/>
    <script>
        const accordionHeaders = document.querySelectorAll('.accordion-header');

        accordionHeaders.forEach(header => {
            header.addEventListener('click', () => {
                // Close all other accordion items
                accordionHeaders.forEach(otherHeader => {
                    if (otherHeader !== header) {
                        otherHeader.classList.remove('active');
                        otherHeader.nextElementSibling.classList.remove('active');
                    }
                });

                // Toggle current accordion item
                header.classList.toggle('active');
                header.nextElementSibling.classList.toggle('active');
            });
        });

        function toggleTheme() {
            document.body.setAttribute('data-theme',
                document.body.getAttribute('data-theme') === 'dark' ? 'light' : 'dark');
        }

        function toggleDirection() {
            document.documentElement.dir =
                document.documentElement.dir === 'rtl' ? 'ltr' : 'rtl';
        }
    </script>
@endsection



