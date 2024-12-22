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
                <button class="apply" type="button" id="sub" style="display: none;">
                    <i class="fa-solid fa-caret-right"></i> إرسال النتيجة
                </button>

                @foreach($questions as $index => $question)
                    <fieldset id="step{{ $index + 1 }}">

                        <h1 class="question">{{ $question->question }}</h1>
                        <div class="hanyErr" id="error"></div>

                        <div class="options d-flex flex-wrap justify-content-between">
                            @foreach($question->answers as $answer)
                                <div class="option animate">
                                    <input type="radio" name="op{{ $index + 1 }}" value="{{ $answer->answer }}" class="answer-option" data-correct="{{ $answer->is_correct }}"/>
                                    <label>{{ $answer->answer }}</label>
                                </div>
                            @endforeach
                        </div>

                        <div class="nextPrev">
                            <button class="prev" type="button">
                                <i class="fa-solid fa-caret-left"></i>
                            </button>
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
{{--<div class="result_page">--}}
{{--    <div class="container">--}}
{{--        <div class="result_inner">--}}
{{--            <!-- header -->--}}
{{--            <header class="resultheader">--}}
{{--                Your Result is there--}}
{{--                <div class="h-border"></div>--}}
{{--            </header>--}}

{{--            <div class="result_content">--}}
{{--                <div class="result_msg">--}}
{{--                    <img src="{{defQuizAssets('quiz5/images/check.png') }}" alt="check"/>--}}
{{--                    Wow! You are Brilliant!--}}
{{--                </div>--}}
{{--                <span>your overall score</span>--}}
{{--                <div class="u_prcnt">70%</div>--}}
{{--                <div class="prcnt_bar">--}}
{{--                    <div class="fill"></div>--}}
{{--                </div>--}}
{{--                <div class="prcnt_bar_lvl">Medium</div>--}}
{{--                <div class="lvl_overview">--}}
{{--                    <div class="lvl-single">--}}
{{--                        <div class="lvl-color low"></div>--}}
{{--                        <div class="lvl-name">Low</div>--}}
{{--                        <div class="lvl-line"></div>--}}
{{--                    </div>--}}
{{--                    <div class="lvl-single">--}}
{{--                        <div class="lvl-color medium"></div>--}}
{{--                        <div class="lvl-name">Medium</div>--}}
{{--                        <div class="lvl-line"></div>--}}
{{--                    </div>--}}
{{--                    <div class="lvl-single">--}}
{{--                        <div class="lvl-color high"></div>--}}
{{--                        <div class="lvl-name">High</div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <footer class="resultfooter"></footer>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}




@push('TempScript')
    <script src="{{defQuizAssets('quiz5/result.js') }}"></script>
    <script src="{{defQuizAssets('quiz5/custom.js') }}"></script>
    <script>
        var divs = $(".show-section fieldset");
        var now = 0; // currently shown div
        divs.hide().first().show(); // hide all divs except the first one
        var wrongAttempts = 0; // Initialize the wrong attempts counter

        // Function to go to the next question
        function next() {
            divs.eq(now).hide();
            now = now + 1 < divs.length ? now + 1 : divs.length - 1; // Prevent going out of bounds
            divs.eq(now).show(); // Show the next question
            console.log(now);

            // If it's the last question, change the next button to submit the result
            if (now === divs.length - 1) {
                $(".next").hide(); // Hide the next button
                $("#sub").show();  // Show the submit button for the final question
            } else {
                $(".next").show(); // Show next button for other questions
                $("#sub").hide();  // Hide submit button for other questions
            }
        }


        $(".prev").on("click", function () {
            divs.eq(now).hide();
            now = now > 0 ? now - 1 : divs.length - 1; // Go to the previous question
            divs.eq(now).show(); // Show previous question
            console.log(now);

            $(".option").addClass("animate");
            $(".option").removeClass("animateReverse");

            // When navigating back, show the next button and hide the submit button
            $(".next").show();
            $("#sub").hide();
        });

        // Validate the selected radio button for each step
        var checkedradio = false;

        function radiovalidate(stepnumber) {
            var checkradio = $("#step" + stepnumber + " input")
                .map(function () {
                    if ($(this).is(":checked")) {
                        return true;
                    } else {
                        return false;
                    }
                })
                .get();

            checkedradio = checkradio.some(Boolean);
        }

        // Check if the selected answer is correct
        function checkAnswer(stepnumber) {
            var selectedOption = $("#step" + stepnumber + " input:checked");
            var isCorrect = selectedOption.data("correct") == 1;
            if (isCorrect) {
                selectedOption.closest(".option").addClass("correct");
                return true; // Correct answer
            } else {
                $(".hanyErr").append(
                    '<div class="reveal alert alert-danger">الاجابة غلط يا زين</div>'
                );
                selectedOption.closest(".option").addClass("incorrect");
                wrongAttempts++; // Increment wrong attempts if the answer is incorrect
                return false; // Incorrect answer
            }
        }


        $(document).ready(function () {
            // Iterate through each step dynamically
            $(".next").on("click", function () {
                $(".hanyErr").html('');
                var stepNumber = $(this).closest("fieldset").attr("id").replace("step", "");
                radiovalidate(stepNumber);

                if (checkedradio == false) {
                    $(".hanyErr").append(
                        '<div class="reveal alert alert-danger">اختار اجابة يا زين </div>'
                    );
                } else {
                    var isCorrect = checkAnswer(stepNumber); // Check if the answer is correct

                    if (isCorrect) {
                        $("#step" + stepNumber + " .option").removeClass("animate");
                        $("#step" + stepNumber + " .option").addClass("animateReverse");

                        setTimeout(function () {
                            next(); // Go to the next step if the answer is correct
                        }, 900);
                        countresult(stepNumber); // Update the result count
                    } else {
                        // Don't go to the next step if the answer is incorrect
                        return false;
                    }
                }
            });

            // Handle the final step (submit)
            $("#sub").on("click", function () {
                $(".hanyErr").html('');
                var stepNumber = divs.length; // Last step
                radiovalidate(stepNumber);

                if (checkedradio == false) {
                    $(".hanyErr").append(
                        '<div class="reveal alert alert-danger">اختار اجابة يا زين</div>'
                    );
                } else {
                    var isCorrect = checkAnswer(stepNumber);

                    if (isCorrect) {
                        countresult(stepNumber);
                        showresult(); // Show the results after all steps
                    }
                }
            });
        });
   </script>
@endpush

