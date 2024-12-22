@push('tempStyle')

{{--    {!! $MinifyTools->setWebAssets('assets/card/')->MinifyCss('_vendor/fungi/css/style.css',"Seo",true) !!}--}}

    {!! $MinifyTools->setWebAssets('assets/card/')->MinifyCss('them2/style.css',"Seo",true) !!}

    <style>
        .dark-mode .hero-area {
            background: url({{defCardAssets('them2/img/hero-bg-dark.jpg') }}) center center;
        }
    </style>
@endpush

@push('pushScript')
    <script src="{{defCardAssets('_vendor/fungi/js/parallax.min.js') }}"></script>
    <script>
        (function ($) {
            "use strict";
            var scene = document.getElementById('scene');
            var parallaxInstance = new Parallax(scene);
        })(jQuery);

    </script>
@endpush

<section class="hero-area" id="hero-area"  >
    <div class="container">
        <div class="hero-content d-flex justify-content-center">
            <div class="row d-flex align-items-center justify-content-center">


                <div class="col-xl-8 text-center">
                    <img class="img-fluid hero-main-image" src="image/hero_main_image.png" alt="hero main image">
                    <h1 class="hero-head"><small>Hello, My name is</small>Steve <strong>Rogers</strong></h1>
                    <p>
                        A passionate <strong>freelancer</strong> who works on
                    </p>

                    <div class="link-group">
                        <a class="btn-main" href="#">Hire Me</a>
                        <a class="btn-ghost" href="#">About Me</a>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div id="scene" class="hero-parallax">
        <div data-depth="0.2"><img class="img-fluid" src="{{defCardAssets('them2/img/hero-bg/hero-parallax-envato.png') }}" alt="hero parallax adobe envato"></div>
        <div data-depth="0.1"><img class="img-fluid" src="{{defCardAssets('them2/img/hero-bg/hero-parallax-ai.png') }}" alt="hero parallax adobe illustrator"></div>
        <div data-depth="0.3"><img class="img-fluid" src="{{defCardAssets('them2/img/hero-bg/hero-parallax-figma.png') }}" alt="hero parallax adobe figma"></div>
        <div data-depth="0.2"><img class="img-fluid" src="{{defCardAssets('them2/img/hero-bg/hero-parallax-fiverr.png') }}" alt="hero parallax adobe fiverr"></div>
        <div data-depth="0.3"><img class="img-fluid" src="{{defCardAssets('them2/img/hero-bg/hero-parallax-joomla.png') }}" alt="hero parallax adobe joomla"></div>
        <div data-depth="0.2"><img class="img-fluid" src="{{defCardAssets('them2/img/hero-bg/hero-parallax-ps.png') }}" alt="hero parallax adobe photoshop"></div>
        <div data-depth="0.3"><img class="img-fluid" src="{{defCardAssets('them2/img/hero-bg/hero-parallax-upwork.png') }}" alt="hero parallax adobe upwork"></div>
        <div data-depth="0.1"><img class="img-fluid" src="{{defCardAssets('them2/img/hero-bg/hero-parallax-wp.png') }}" alt="hero parallax adobe WordPress"></div>
    </div>
</section>
