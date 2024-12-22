@push('tempStyle')
    {!! $MinifyTools->setWebAssets('assets/quiz/')->MinifyCss('quiz5/css/style.css',"Seo",true) !!}
    {!! $MinifyTools->setWebAssets('assets/quiz/')->MinifyCss('quiz5/css/animation.css',"Seo",true) !!}
    {!! $MinifyTools->setWebAssets('assets/quiz/')->MinifyCss('quiz5/css/responsive.css',"Seo",true) !!}
    {!! $MinifyTools->setWebAssets('assets/quiz/')->MinifyCss('quiz5/css/result_style.css',"Seo",true) !!}
    {!! $MinifyTools->setWebAssets('assets/quiz/')->MinifyCss('quiz5/css/style_update.css',"Seo",true) !!}
    <style>
        main {
            background-image: url({{defQuizAssets('quiz5/images/bg.png') }});
        }
    </style>
@endpush
<main class="overflow-hidden">
    <div class="container">


        <section class="steps">
            <form novalidate onsubmit="return false" class="show-section" id="stepForm">
                <div class="row">
                    <div style="width: 100%" id="error"></div>
                </div>


                <button class="apply" type="button" id="sub" style="display: none;">
                    <i class="fa-solid fa-caret-right"></i> إرسال النتيجة
                </button>

                @foreach($questions as $index => $question)
                    <fieldset id="step{{ $index + 1 }}">
                        <!-- Question -->
                        <h1 class="question">{{ $question->question }}</h1>

                        <!-- Options -->
                        <div class="options d-flex flex-wrap justify-content-between">
                            @foreach($question->answers as $answer)
                                <div class="option animate">
                                    <input type="radio" name="op{{ $index + 1 }}" value="{{ $answer->answer }}" class="answer-option" data-correct="{{ $answer->is_correct }}"/>
                                    <label>{{ $answer->answer }}</label>
                                </div>
                            @endforeach
                        </div>

                        <!-- Next Prev Button -->
                        <div class="nextPrev">
                            <button class="prev" type="button">
                                <i class="fa-solid fa-caret-left"></i>
                            </button>

                            <!-- Counter -->
                            <div class="stepCount"><span>{{ $index + 1 }}</span>/{{ $questions->count() }}</div>

                            <button class="next" type="button" id="step{{ $index + 1 }}btn">
                                <i class="fa-solid fa-caret-right"></i>
                            </button>
                        </div>
                    </fieldset>
                @endforeach



            </form>

            <img class="avatar" src="{{defQuizAssets('quiz5/images/avatar.png') }}" alt="Avatar"/>
            <div class="backgroundSlab"></div>
        </section>


    </div>
</main>
{{--<div class="loadingresult">--}}
{{--    <img src="{{defQuizAssets('quiz5/images/loading.gif') }}" alt="loading"/>--}}
{{--</div>--}}
<div class="result_page">
    <div class="container">
        <div class="result_inner">
            <!-- header -->
            <header class="resultheader">
                Your Result is there
                <div class="h-border"></div>
            </header>

            <div class="result_content">
                <div class="result_msg">
                    <img src="{{defQuizAssets('quiz5/images/check.png') }}" alt="check"/>
                    Wow! You are Brilliant!
                </div>
                <span>your overall score</span>
                <div class="u_prcnt">70%</div>
                <div class="prcnt_bar">
                    <div class="fill"></div>
                </div>
                <div class="prcnt_bar_lvl">Medium</div>
                <div class="lvl_overview">
                    <div class="lvl-single">
                        <div class="lvl-color low"></div>
                        <div class="lvl-name">Low</div>
                        <div class="lvl-line"></div>
                    </div>
                    <div class="lvl-single">
                        <div class="lvl-color medium"></div>
                        <div class="lvl-name">Medium</div>
                        <div class="lvl-line"></div>
                    </div>
                    <div class="lvl-single">
                        <div class="lvl-color high"></div>
                        <div class="lvl-name">High</div>
                    </div>
                </div>
            </div>

            <footer class="resultfooter"></footer>
        </div>
    </div>
</div>




@push('TempScript')
    <script src="{{defQuizAssets('quiz5/result.js') }}"></script>
    <script src="{{defQuizAssets('quiz5/custom.js') }}"></script>
    <script>

   </script>
@endpush

