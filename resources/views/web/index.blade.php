@extends('web.layouts.app')
@section('content')
    <!-- tap on top starts-->
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <!-- tap on tap ends-->
    <!-- page-wrapper Start-->
    <div class="landing-page">
        <!-- Page Body Start-->
        <header class="landing-header">
            <div class="custom-container">
                <div class="row">
                    <div class="col-12 p-0">
                        <nav class="navbar navbar-light p-0" id="navbar-example2">
                            <a class="navbar-brand" href="javascript:void(0)">
                                <img class="img-fluid"  src="{{getDefPhotoPath($DefPhotoList,'logo_dark')}}" alt="">
                            </a>
                            <ul class="landing-menu nav nav-pills">
                                <li class="nav-item menu-back">back<i class="fa fa-angle-right"></i></li>
                                <li class="nav-item"><a class="nav-link" href="#home">Home</a></li>
                                <li class="nav-item"><a class="nav-link" href="#framework">Frameworks </a></li>
                                <li class="nav-item"><a class="nav-link" href="#corefeature">Core Feature</a></li>
                                <li class="nav-item"><a class="nav-link" href="#Applications">Applications</a></li>
                                <li class="nav-item"><a class="nav-link" href="#" target="_blank">Documentation</a></li>
                                <li class="nav-item"><a class="nav-link" href="#" target="_blank">Hire us</a></li>
                            </ul>
                            <div class="buy-block"><a class="btn-landing bg-secondary text-white" href="{{route('portal.login')}}">
                                   Log in
                                </a>
                                <div class="toggle-menu"><i class="fa fa-bars"></i></div>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </header>


        <div class="landing-home section-py-space pb-0">
            <div class="home-bg" id="home">
                <ul class="bg-icon-images">
                    <li><img src="{{defPortalAssets('images/landing/landing-home/vector/3.png') }}" alt=""></li>
                    <li> <img src="{{defPortalAssets('images/landing/landing-home/vector/2.png') }}" alt=""></li>
                    <li><img src="{{defPortalAssets('images/landing/landing-home/vector/4.png') }}" alt=""></li>
                    <li><img src="{{defPortalAssets('images/landing/landing-home/vector/1.png') }}" alt=""></li>
                </ul>
                <div class="row align-items-center justify-content-center">
                    <div class="col-lg-6 col-md-7">
                        <div class="home-text">
                            <div class="main-title">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="d-flex gap-2 align-items-center"><img class="img-fluid" src="{{defPortalAssets('images/landing/landing-home/vector/rocket.png') }}" alt="rocket">
                                        <p class="m-0 project-name">Kick Start Your Project Using</p>
                                    </div>
                                </div>
                            </div>
                            <h2>Zono Developer Friendly Admin Dashboard For Your Business<img class="line-text img-fluid" src="{{defPortalAssets('images/landing/landing-home/vector/line.png') }}" alt="line"></h2>
                            <p class="description-name">Zono is perfect admin template for any business. it has all features and modules to create your amazing C- panel. this template for selling default, ecommerce.</p>
                            <div class="docutment-button"> <a class="btn bg-secondary" href="index.html" target="_blank">View Demo</a><a class="btn bg-light txt-dark" href="#" target="_blank">Documentation</a></div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-5">
                        <div class="home-screen"> <a href="index.html"><img class="img-fluid dashboard-img img-fluid" src="{{defPortalAssets('images/landing/landing-home/dashboard.png') }}" alt=""></a>
                            <div class="charts-card">
                                <ul class="dashboard-card">
                                    <li><img class="img-fluid" src="{{defPortalAssets('images/landing/landing-home/vector/5.png') }}" alt=""></li>
                                    <li><img class="img-fluid" src="{{defPortalAssets('images/landing/landing-home/vector/6.png') }}" alt=""></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="wave-vibe">
                <div class="wave-img"><img src="{{defPortalAssets('images/landing/landing-home/vector/7.png') }}" alt=""></div>
            </div>
        </div>





        <section class="framework section-py-space light-bg" id="framework">
            <div class="container-lg container-fluid">
                <div class="row">
                    <div class="col-sm-12 wow pulse">
                        <div class="title text-center mt-0">
                            <h5>10+ Frameworks available</h5>
                            <h2 class="mb-lg-2 mb-0">Top Frameworks</h2>
                        </div>
                    </div>
                    <div class="col-sm-12 framworks">
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                <ul class="framworks-list">
                                    <li class="box wow fadeInUp">
                                        <div><img src="{{defPortalAssets('images/landing/icon/html/bootstrap.png') }}" alt=""></div>
                                        <h5 class="mb-0 f-w-600">Bootstrap 5</h5>
                                    </li>
                                    <li class="box wow fadeInUp">
                                        <div><img src="{{defPortalAssets('images/landing/icon/html/css.png') }}" alt=""></div>
                                        <h5 class="mb-0 f-w-600">CSS</h5>
                                    </li>
                                    <li class="box wow fadeInUp">
                                        <div><img src="{{defPortalAssets('images/landing/icon/html/sass.png') }}" alt=""></div>
                                        <h5 class="mb-0 f-w-600">Sass</h5>
                                    </li>
                                    <li class="box wow fadeInUp">
                                        <div><img src="{{defPortalAssets('images/landing/icon/html/pug.png') }}" alt=""></div>
                                        <h5 class="mb-0 f-w-600">Pug</h5>
                                    </li>
                                    <li class="box wow fadeInUp">
                                        <div><img src="{{defPortalAssets('images/landing/icon/html/npm.png') }}" alt=""></div>
                                        <h5 class="mb-0 f-w-600">NPM</h5>
                                    </li>
                                    <li class="box wow fadeInUp">
                                        <div><img src="{{defPortalAssets('images/landing/icon/html/charts.png') }}" alt=""></div>
                                        <h5 class="mb-0 f-w-600">Charts</h5>
                                    </li>
                                    <li class="box wow fadeInUp">
                                        <div><img src="{{defPortalAssets('images/landing/icon/html/webpack.png') }}" alt=""></div>
                                        <h5 class="mb-0 f-w-600">webpack</h5>
                                    </li>
                                    <li class="box wow bounceIn">
                                        <div><img src="{{defPortalAssets('images/landing/icon/html/kit.png') }}" alt=""></div>
                                        <h5 class="mb-0 f-w-600">Starter Kit</h5>
                                    </li>
                                    <li class="box wow bounceIn">
                                        <div><img src="{{defPortalAssets('images/landing/icon/html/uikits.png') }}" alt=""></div>
                                        <h5 class="mb-0 f-w-600">40+ UI Kits</h5>
                                    </li>
                                    <li class="box wow bounceIn">
                                        <div><img src="{{defPortalAssets('images/landing/icon/html/layout.png') }}" alt=""></div>
                                        <h5 class="mb-0 f-w-600">8+ Layout</h5>
                                    </li>
                                    <li class="box wow bounceIn">
                                        <div><img src="{{defPortalAssets('images/landing/icon/html/builders.png') }}" alt=""></div>
                                        <h5 class="mb-0 f-w-600">Builders</h5>
                                    </li>
                                    <li class="box wow bounceIn">
                                        <div><img src="{{defPortalAssets('images/landing/icon/html/iconset.png') }}" alt=""></div>
                                        <h5 class="mb-0 f-w-600">11 Icon Sets</h5>
                                    </li>
                                    <li class="box wow bounceIn">
                                        <div><img src="{{defPortalAssets('images/landing/icon/html/forms.png') }}" alt=""></div>
                                        <h5 class="mb-0 f-w-600">Forms</h5>
                                    </li>
                                    <li class="box wow bounceIn">
                                        <div><img src="{{defPortalAssets('images/landing/icon/html/table.png') }}" alt=""></div>
                                        <h5 class="mb-0 f-w-600">Tables</h5>
                                    </li>
                                    <li class="box wow bounceIn">
                                        <div><img src="{{defPortalAssets('images/landing/icon/html/apps.png') }}" alt=""></div>
                                        <h5 class="mb-0 f-w-600">17+ Apps</h5>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>



{{--        <section class="section-py-space application-section" id="Applications">--}}
{{--            <div class="container-fluid fluid-space">--}}
{{--                <div class="row">--}}
{{--                    <div class="col-sm-12 wow pulse">--}}
{{--                        <div class="title text-center">--}}
{{--                            <h5>Usefull Application</h5>--}}
{{--                            <h2 class="mb-lg-2 mb-0">Fast & Powerful Applications</h2>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-sm-12 application">--}}
{{--                        <div class="row application-block g-5">--}}
{{--                            <div class="col-xl-4 col-lg-4 col-sm-6 col-lg-4 col-sm-6 wow pulse col-lg-4 col-sm-6 wow pulse">--}}
{{--                                <div class="demo-box">--}}
{{--                                    <div class="img-wrraper"><a href="social-app.html" target="_blank"><img class="img-fluid" src="../assets/images/landing/application/1.jpg" alt=""></a></div>--}}
{{--                                    <div class="demo-detail"> <a class="btn btn-primary btn-primary" href="social-app.html" target="_blank">Social App</a></div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="col-xl-4 col-lg-4 col-sm-6 col-lg-4 col-sm-6 wow pulse">--}}
{{--                                <div class="demo-box">--}}
{{--                                    <div class="img-wrraper"> <a href="knowledgebase.html" target="_blank"><img class="img-fluid" src="../assets/images/landing/application/2.jpg" alt=""></a></div>--}}
{{--                                    <div class="demo-detail"><a class="btn btn-primary btn-primary" href="knowledgebase.html" target="_blank">Knowledgebase  </a></div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </section>--}}






        <section class="section-py-space feature-section" id="corefeature">
            <div class="container">
                <div class="row g-4">
                    <div class="col-sm-12 wow pulse">
                        <div class="title text-center">
                            <h5>Why you choose zono</h5>
                            <h2 class="mb-lg-2 mb-0">Unique Features</h2>
                        </div>
                    </div>
                    <div class="col-xxl-3 col-lg-4 mt-0 col-sm-6 wow flipInX">
                        <div class="feature-box common-card bg-feature">
                            <div class="feature-icon bg-white">
                                <div> <img src="{{defPortalAssets('images/landing/icon/html/pug.png') }}" alt="feature-icon"></div>
                            </div>
                            <h5 class="text-center">Quality & Clean Code </h5>
                            <p class="mb-0 f-light">All you need to know of using clean code as a make your team and your software awesome.</p>
                        </div>
                    </div>
                    <div class="col-xxl-3 col-lg-4 mt-0 col-sm-6 wow flipInX">
                        <div class="feature-box common-card bg-feature">
                            <div class="feature-icon bg-white">
                                <div><img src="../assets/images/landing/feature-icon/2.svg" alt="feature-icon"></div>
                            </div>
                            <h5 class="text-center">Bootstrap v5.0 </h5>
                            <p class="mb-0 f-light">Powerful feature-packed frontend toolkit. Build and customize with Sass, utilize prebuilt grid system.</p>
                        </div>
                    </div>
                    <div class="col-xxl-3 col-lg-4 mt-0 col-sm-6 wow flipInX">
                        <div class="feature-box common-card bg-feature">
                            <div class="feature-icon bg-white">
                                <div><img src="../assets/images/landing/feature-icon/3.svg" alt="feature-icon"></div>
                            </div>
                            <h5 class="text-center">Handmade Icons</h5>
                            <p class="mb-0 f-light">let’s learn how to svg icons in zono admin template, handmade icons different materials.</p>
                        </div>
                    </div>
                    <div class="col-xxl-3 col-lg-4 mt-0 col-sm-6 wow flipInX">
                        <div class="feature-box common-card bg-feature">
                            <div class="feature-icon bg-white">
                                <div><img src="../assets/images/landing/feature-icon/4.svg" alt="feature-icon"></div>
                            </div>
                            <h5 class="text-center">Limitless Components</h5>
                            <p class="mb-0 f-light">The limitless layout collection and UI kit biggest collection of layouts for web design.</p>
                        </div>
                    </div>
                    <div class="col-xxl-3 col-lg-4 mt-0 col-sm-6 wow flipInX">
                        <div class="feature-box common-card bg-feature">
                            <div class="feature-icon bg-white">
                                <div><img src="../assets/images/landing/feature-icon/5.svg" alt="feature-icon"></div>
                            </div>
                            <h5 class="text-center">Easy Customizable</h5>
                            <p class="mb-0 f-light">Easy Step-By-Step Guide for Beginners.customize your layout, settings and content.</p>
                        </div>
                    </div>
                    <div class="col-xxl-3 col-lg-4 mt-0 col-sm-6 wow flipInX">
                        <div class="feature-box common-card bg-feature">
                            <div class="feature-icon bg-white">
                                <div><img src="../assets/images/landing/feature-icon/6.svg" alt="feature-icon"></div>
                            </div>
                            <h5 class="text-center">Responsive </h5>
                            <p class="mb-0 f-light">Use Responsive Design to Connect with all Device designing your website for mobile devices.</p>
                        </div>
                    </div>
                    <div class="col-xxl-3 col-lg-4 mt-0 col-sm-6 wow flipInX">
                        <div class="feature-box common-card bg-feature">
                            <div class="feature-icon bg-white">
                                <div><img src="../assets/images/landing/feature-icon/7.svg" alt="feature-icon"></div>
                            </div>
                            <h5 class="text-center">Premium Support </h5>
                            <p class="mb-0 f-light">We are always be their for your support and you are facing some issues you can create ticket.</p>
                        </div>
                    </div>
                    <div class="col-xxl-3 col-lg-4 mt-0 col-sm-6 wow flipInX">
                        <div class="feature-box common-card bg-feature">
                            <div class="feature-icon bg-white">
                                <div><img src="../assets/images/landing/feature-icon/8.svg" alt="feature-icon"></div>
                            </div>
                            <h5 class="text-center">Colors Options </h5>
                            <p class="mb-0 f-light">zono provide unlimited main color option.other colors you can change easily using scss variables.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>





        <section class="section-py-space premium-section">
            <div class="container">
                <div class="row g-md-4 g-3">
                    <div class="col-md-6 wow bounceInLeft mt-0">
                        <div class="premium-img"><img class="img-fluid" src="{{defPortalAssets('images/landing/premium.png') }}" alt="premium"></div>
                    </div>
                    <div class="col-md-6 wow bounceInRight mt-0">
                        <div class="premium-wrapper">
                            <h3 class="sub-title">Our License  </h3>
                            <h2>we give it as we think that excellent support is needed</h2><span>Check our reviews for fast and accurate support to ensure support. we offer premium assistance around-the-clock for any bugs you encounter. and we’ll do best to help you out with any future updates for free.</span><a class="btn link-text btn-primary" href="https://support.pixelstrap.com/" target="_blank">Support</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>




        <footer class="footer-bg">
            <div class="container-fluid">
                <div class="landing-center">
                    <div class="feature-content">
                        <div>
                            <h2>Our Product is Trusted by Clients Worldwide</h2>
                            <div class="footer-rating">
                                <svg class="fill-warning">
                                    <use href="{{defPortalAssets('svg/icon-sprite.svg#fill-star') }}"></use>
                                </svg>
                                <svg class="fill-warning">
                                    <use href="{{defPortalAssets('svg/icon-sprite.svg#fill-star') }}"></use>
                                </svg>
                                <svg class="fill-warning">
                                    <use href="{{defPortalAssets('svg/icon-sprite.svg#fill-star') }}"></use>
                                </svg>
                                <svg class="fill-warning">
                                    <use href="{{defPortalAssets('svg/icon-sprite.svg#fill-star') }}"></use>
                                </svg>
                                <svg class="stroke-warning">
                                    <use href="{{defPortalAssets('svg/icon-sprite.svg#fill-star') }}"></use>
                                </svg>
                            </div>
                        </div><a class="btn bg-primary btn-hover-effect txt-light" href="https://themeforest.net/user/pixelstrap/portfolio" target="_blank">Buy Now</a>
                    </div>
                </div>
                <div class="sub-footer row g-md-2 g-3">
                    <div class="col-md-6">
                        <div class="left-subfooter"> <img class="img-fluid" src="{{getDefPhotoPath($DefPhotoList,'logo_dark')}}" alt="logo">
                            <p class="mb-0">Copyright 2024 © Profile Hub </p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="right-subfooter">
                            <h3 class="text-end">If You Like Our Theme So Please Rate Us</h3>
                            <ul>
                                <li><a href="#" target="_blank">Get Support</a></li>
                                <li><a href="#" target="_blank">Documentation</a></li>
                                <li><a href="#" target="_blank">Hire Us</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
@endsection