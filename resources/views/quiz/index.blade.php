@extends('quiz.layouts.app')

@section('content')
    <main class="overflow-hidden">
        <header>

            <div class="stepsBar">
                <div class="stepSingle">
                    <span>1</span>
                    <div class="bar">
                        <div class="fill"></div>
                    </div>
                </div>
                <div class="stepSingle">
                    <span>2</span>
                    <div class="bar">
                        <div class="fill"></div>
                    </div>
                </div>
                <div class="stepSingle">
                    <span>3</span>
                    <div class="bar">
                        <div class="fill"></div>
                    </div>
                </div>
                <div class="stepSingle">
                    <span>4</span>
                    <div class="bar">
                        <div class="fill"></div>
                    </div>
                </div>
                <div class="stepSingle">
                    <span>5</span>
                    <div class="bar">
                        <div class="fill"></div>
                    </div>
                </div>
            </div>
        </header>


        <section class="steps">
            <div class="row align-items-center">

                <div class="col-md-5 tab-none">
                    <div class="sideImg">
                        <img src="assets/images/avatar.jpg" alt="Avatar"/>
                    </div>
                </div>
                <div class="col-md-7">

                    <form
                        novalidate
                        onsubmit="return false"
                        class="show-section"
                        id="stepForm"
                    >
                        <!-- Step 1 -->
                        <fieldset id="step1">
                            <!-- QUestion -->
                            <h1 class="question">
                                Which former British colony was given back to China in 1997?
                            </h1>

                            <!-- Options -->
                            <div class="options">
                                <div class="option animate">
                                    <input type="radio" name="op1" value="Russia"/>
                                    <label>Russia</label>
                                </div>
                                <div class="option animate delay-100">
                                    <input type="radio" name="op1" value="America"/>
                                    <label>America</label>
                                </div>
                                <div class="option animate delay-200">
                                    <input type="radio" name="op1" value="Australia"/>
                                    <label>Australia</label>
                                </div>
                                <div class="option animate delay-300">
                                    <input type="radio" name="op1" value="Hong Kong"/>
                                    <label>Hong Kong</label>
                                </div>
                            </div>
                        </fieldset>

                        <!-- Step 2 -->
                        <fieldset id="step2">
                            <!-- QUestion -->
                            <h1 class="question">What is the capital of France?</h1>

                            <!-- Options -->
                            <div class="options">
                                <div class="option animate">
                                    <input type="radio" name="op2" value="London"/>
                                    <label>London</label>
                                </div>
                                <div class="option animate delay-100">
                                    <input type="radio" name="op2" value="London"/>
                                    <label>London</label>
                                </div>
                                <div class="option animate delay-200">
                                    <input type="radio" name="op2" value="Berlin"/>
                                    <label>Berlin</label>
                                </div>
                                <div class="option animate delay-300">
                                    <input type="radio" name="op2" value="Madrid"/>
                                    <label>Madrid</label>
                                </div>
                            </div>
                        </fieldset>
                        <!-- Step 3 -->
                        <fieldset id="step3">
                            <!-- QUestion -->
                            <h1 class="question">
                                Which former British colony was given back to China in 1997?
                            </h1>

                            <!-- Options -->
                            <div class="options">
                                <div class="option animate">
                                    <input type="radio" name="op3" value="Russia"/>
                                    <label>Russia</label>
                                </div>
                                <div class="option animate delay-100">
                                    <input type="radio" name="op3" value="America"/>
                                    <label>America</label>
                                </div>
                                <div class="option animate delay-200">
                                    <input type="radio" name="op3" value="Australia"/>
                                    <label>Australia</label>
                                </div>
                                <div class="option animate delay-300">
                                    <input type="radio" name="op3" value="Hong Kong"/>
                                    <label>Hong Kong</label>
                                </div>
                            </div>
                        </fieldset>

                        <!-- Step 4 -->
                        <fieldset id="step4">
                            <!-- QUestion -->
                            <h1 class="question">What is the capital of France?</h1>

                            <!-- Options -->
                            <div class="options">
                                <div class="option animate">
                                    <input type="radio" name="op4" value="London"/>
                                    <label>London</label>
                                </div>
                                <div class="option animate delay-100">
                                    <input type="radio" name="op4" value="London"/>
                                    <label>London</label>
                                </div>
                                <div class="option animate delay-200">
                                    <input type="radio" name="op4" value="Berlin"/>
                                    <label>Berlin</label>
                                </div>
                                <div class="option animate delay-300">
                                    <input type="radio" name="op4" value="Madrid"/>
                                    <label>Madrid</label>
                                </div>
                            </div>
                        </fieldset>
                        <!-- Step 5 -->
                        <fieldset id="step5">
                            <!-- QUestion -->
                            <h1 class="question">
                                Which former British colony was given back to China in 1997?
                            </h1>

                            <!-- Options -->
                            <div class="options">
                                <div class="option animate">
                                    <input type="radio" name="op5" value="Russia"/>
                                    <label>Russia</label>
                                </div>
                                <div class="option animate delay-100">
                                    <input type="radio" name="op5" value="America"/>
                                    <label>America</label>
                                </div>
                                <div class="option animate delay-200">
                                    <input type="radio" name="op5" value="Australia"/>
                                    <label>Australia</label>
                                </div>
                                <div class="option animate delay-300">
                                    <input type="radio" name="op5" value="Hong Kong"/>
                                    <label>Hong Kong</label>
                                </div>
                            </div>
                        </fieldset>


                    </form>
                </div>
            </div>
        </section>


        <footer>
            <!-- Step 1 Next Prev -->
            <div class="nextPrev">
                <button type="button" class="next" id="step1btn">next QUESTION<i class="fa-solid fa-arrow-right"></i></button>
            </div>
            <!-- Step 2 Next Prev -->
            <div class="nextPrev">
                <button type="button" class="prev">
                    <i class="fa-solid fa-arrow-left"></i>LAST QUESTION
                </button>
                <button type="button" class="next" id="step2btn">
                    next QUESTION<i class="fa-solid fa-arrow-right"></i>
                </button>
            </div>
            <!-- Step 3 Next Prev -->
            <div class="nextPrev">
                <button type="button" class="prev">
                    <i class="fa-solid fa-arrow-left"></i>LAST QUESTION
                </button>
                <button type="button" class="next" id="step3btn">
                    next QUESTION<i class="fa-solid fa-arrow-right"></i>
                </button>
            </div>
            <!-- Step 4 Next Prev -->
            <div class="nextPrev">
                <button type="button" class="prev">
                    <i class="fa-solid fa-arrow-left"></i>LAST QUESTION
                </button>
                <button type="button" class="next" id="step4btn">
                    next QUESTION<i class="fa-solid fa-arrow-right"></i>
                </button>
            </div>
            <!-- Step 5 Next Prev -->
            <div class="nextPrev">
                <button type="button" class="prev">
                    <i class="fa-solid fa-arrow-left"></i>LAST QUESTION
                </button>
                <button type="button" class="next" id="sub">
                    Submit<i class="fa-solid fa-arrow-right"></i>
                </button>
            </div>
        </footer>
    </main>


@endsection
