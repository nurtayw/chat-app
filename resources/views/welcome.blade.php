{{--@extends('layouts.app')--}}

{{--@section('content')--}}
    <head>
        <!-- Required Meta Tags -->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <!-- Page Title -->
        <title>Rescue</title>
        <!-- Bootstrap 5 CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />

        <!-- Bootstrap 5 JS (for dropdown) -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

        <!-- Favicon -->
        <link rel="shortcut icon" href="{{ asset('user/assets/images/logo/favicon.png') }}" type="image/x-icon">

        <!-- CSS Files -->
        <link rel="stylesheet" href="{{ asset('user/assets/css/animate-3.7.0.css') }}">
        <link rel="stylesheet" href="{{ asset('user/assets/css/font-awesome-4.7.0.min.css') }}">
        <link rel="stylesheet" href="{{ asset('user/assets/css/bootstrap-4.1.3.min.css') }}">
        <link rel="stylesheet" href="{{ asset('user/assets/css/owl-carousel.min.css') }}">
        <link rel="stylesheet" href="{{ asset('user/assets/css/jquery.datetimepicker.min.css') }}">
        <link rel="stylesheet" href="{{ asset('user/assets/css/linearicons.css') }}">
        <link rel="stylesheet" href="{{ asset('user/assets/css/style.css') }}">

    </head>
    <body>
{{--    <!-- Preloader Starts -->--}}
{{--    <div class="preloader">--}}
{{--        <div class="spinner"></div>--}}
{{--    </div>--}}
{{--    <!-- Preloader End -->--}}

    <!-- Header Area Starts -->
<header class="header-area">
    <div class="header-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 d-md-flex">
                    <h6 class="mr-3"><span class="mr-2"><i class="fa fa-mobile"></i></span> call us now! +7 707 777 7777</h6>
                    <h6 class="mr-3"><span class="mr-2"><i class="fa fa-envelope-o"></i></span> recue@example.com</h6>
                </div>
            </div>
        </div>
    </div>
    <div id="header" id="home">
        <div class="container">
            <div class="row align-items-center justify-content-between d-flex">
                <div id="logo">
                    <a href=""><img src="{{ asset('user/assets/images/logo/logo.png') }}" alt="" title="" /></a>
                </div>
                <nav id="nav-menu-container">
                    <ul class="nav-menu"  style="margin-left:500px;">
                        <li class="menu-active"><a href="/">Home</a></li>
                        <li><a href="{{ route('chat') }}">departments</a></li>
                        <li><a href="{{ route('contactt.index') }}">Contact</a></li>
                        @auth
                            <li><a href="{{ url('/chat/' . auth()->user()->id) }}">Chats</a></li>
                        @else
                            <!-- Здесь будет ссылка на страницу для авторизации -->
                            <li><a href="{{ route('login') }}">Login</a></li>
                        @endauth

                    @guest
                            @if (Route::has('login'))
                                <li>
                                    <a href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li>
                                    <a href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="menu-has-children">
                                <a href="#" role="button" id="navbarDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ Auth::user()->name }}
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('profile.show') }}">Profile</a>
                                    </li>
                                    @if(auth()->user()->role->name === 'admin')
                                        <li>
                                            <a class="dropdown-item" href="{{ route('users') }}">Admin Panel</a>
                                        </li>
                                    @endif
                                    <li>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                       document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>
                                    </li>
                                </ul>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        @endguest
                    </ul>
                </nav><!-- #nav-menu-container -->
            </div>
        </div>
    </div>
</header>

<!-- Header Area End -->

    <!-- Banner Area Starts -->
<section class="banner-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-5">
                <h4>We’re here to protect lives</h4>
                <h1>Leading the way in emergency response</h1>
                <p>Swift response for every emergency. Ensuring safety and support at every step. Dedicated to saving lives with efficiency and care.</p>
            </div>
        </div>
    </div>
</section>

<!-- Banner Area End -->

    <!-- Feature Area Starts -->
<section class="feature-area section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="single-feature text-center item-padding">
                    <img src="{{ asset('user/assets/images/feature1.png') }}" alt="">
                    <h3>Advanced Equipment</h3>
                    <p class="pt-3">Equipped with state-of-the-art tools to handle any emergency situation efficiently and effectively.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="single-feature text-center item-padding mt-4 mt-md-0">
                    <img src="{{ asset('user/assets/images/feature2.png') }}" alt="">
                    <h3>Rapid Response</h3>
                    <p class="pt-3">Our team responds quickly to ensure help is available whenever and wherever it’s needed most.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="single-feature text-center item-padding mt-4 mt-lg-0">
                    <img src="{{ asset('user/assets/images/feature3.png') }}" alt="">
                    <h3>Expert Team</h3>
                    <p class="pt-3">Highly trained professionals ready to handle emergencies with expertise and dedication.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="single-feature text-center item-padding mt-4 mt-lg-0">
                    <img src="{{ asset('user/assets/images/feature4.png') }}" alt="">
                    <h3>24/7 Availability</h3>
                    <p class="pt-3">We’re available around the clock, ready to assist and provide immediate response services.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Feature Area End -->

<!-- Welcome Area Starts -->
<section class="welcome-area section-padding3">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 align-self-center">
                <div class="welcome-img">
                    <img src="{{ asset('user/assets/images/33.jpg') }}" alt="">
                </div>
            </div>
            <div class="col-lg-7">
                <div class="welcome-text mt-5 mt-lg-0">
                    <h2>Welcome to Our Rescue Service</h2>
                    <p class="pt-3">Dedicated to providing prompt and effective emergency response, our team is ready to support you in critical situations, bringing expertise and care when it’s needed most.</p>
                    <p>With our advanced equipment and trained professionals, we’re committed to ensuring safety and timely assistance in every rescue operation.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Welcome Area End -->
<!-- Testimonial Area Ends -->

<!-- Specialist Area Starts -->
<section class="specialist-area section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <div class="section-top text-center">
                    <h2>Our Specialists</h2>
                    <p>Meet our team of highly trained professionals, skilled in various fields of emergency response to handle critical situations with care and expertise.</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-sm-6">
                <div class="single-specialist mb-4 mb-lg-0">
                    <div class="specialist-img">
                        <img src="{{ asset('user/assets/images/specialist1.jpg') }}" alt="" class="img-fluid">
                    </div>
                    <div class="content-area">
                        <div class="specialist-name text-center">
                            <h3>Dr. Ethel Davis</h3>
                            <h6>Emergency Medicine</h6>
                        </div>
                        <div class="specialist-text text-center">
                            <p>Dr. Davis brings extensive experience in emergency care and rapid response medical support.</p>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="single-specialist mb-4 mb-lg-0">
                    <div class="specialist-img">
                        <img src="{{ asset('user/assets/images/specialist2.jpg') }}" alt="" class="img-fluid">
                    </div>
                    <div class="content-area">
                        <div class="specialist-name text-center">
                            <h3>Mark Spencer</h3>
                            <h6>Search & Rescue Operations</h6>
                        </div>
                        <div class="specialist-text text-center">
                            <p>Mark specializes in high-risk search and rescue, ensuring precision in every mission.</p>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="single-specialist mb-4 mb-sm-0">
                    <div class="specialist-img">
                        <img src="{{ asset('user/assets/images/specialist3.jpg') }}" alt="" class="img-fluid">
                    </div>
                    <div class="content-area">
                        <div class="specialist-name text-center">
                            <h3>Sarah Johnson</h3>
                            <h6>Fire & Safety Specialist</h6>
                        </div>
                        <div class="specialist-text text-center">
                            <p>Sarah is a fire safety expert with years of experience in handling fire-related emergencies.</p>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="single-specialist">
                    <div class="specialist-img">
                        <img src="{{ asset('user/assets/images/specialist4.jpg') }}" alt="" class="img-fluid">
                    </div>
                    <div class="content-area">
                        <div class="specialist-name text-center">
                            <h3>Jason Lee</h3>
                            <h6>Disaster Response Coordinator</h6>
                        </div>
                        <div class="specialist-text text-center">
                            <p>Jason coordinates complex rescue missions during natural disasters, ensuring timely response and organization.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Specialist Area Ends -->

<!-- Specialist Area Starts -->

<!-- Hotline Area Starts -->
<section class="hotline-area text-center section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2>Emergency hotline</h2>
                <span>(+8) 777 777 7777 – </span>
                <p class="pt-3">We provide 24/7 customer support. Please feel free to contact us <br>for emergency case.</p>
            </div>
        </div>
    </div>
</section>
<!-- Hotline Area End -->

<!-- News Area Starts -->
<section class="news-area section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <div class="section-top text-center">
                    <h2>Latest Rescue Service News</h2>
                    <p>Stay updated with our latest news and developments in rescue operations, tools, and community support.</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="single-news">
                    <div class="news-img">
                        <img src="{{ asset('user/assets/images/news1.jpg') }}" alt="News Image" class="img-fluid">
                    </div>
                    <div class="news-text">
                        <div class="news-date">
                            July 22, 2023
                        </div>
                        <h3><a href="">Technology Supporting Rescue Teams</a></h3>
                        <p>New tools and technologies are helping rescue teams respond faster and more effectively, saving lives in critical situations.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="single-news mt-5 mt-md-0">
                    <div class="news-img">
                        <img src="{{ asset('user/assets/images/news2.jpg') }}" alt="News Image" class="img-fluid">
                    </div>
                    <div class="news-text">
                        <div class="news-date">
                            October 22, 2023
                        </div>
                        <h3><a href="">Improving Community Emergency Response</a></h3>
                        <p>Community initiatives and training programs are strengthening our response to emergency situations and enhancing public safety.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="single-news mt-5 mt-lg-0">
                    <div class="news-img">
                        <img src="{{ asset('user/assets/images/news3.jpg') }}" alt="News Image" class="img-fluid">
                    </div>
                    <div class="news-text">
                        <div class="news-date">
                            September 22, 2023
                        </div>
                        <h3><a href="">New Equipment for Faster Rescues</a></h3>
                        <p>Latest rescue equipment provides greater efficiency and safety for teams responding to various emergencies.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- News Area Ends -->

<!-- Footer Area Starts -->
<footer class="footer-area section-padding">
    <div class="footer-widget">
        <div class="container">
            <div class="row">
                <div class="col-xl-2 col-lg-3">
                    <div class="single-widget-home mb-5 mb-lg-0">
                        <h3 class="mb-4">Our Services</h3>
                        <ul>
                            <li class="mb-2"><a href="#">24/7 Emergency Hotline</a></li>
                            <li class="mb-2"><a href="#">Disaster Response</a></li>
                            <li class="mb-2"><a href="#">Community Safety</a></li>
                            <li><a href="#">Rescue Training</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-5 offset-xl-1 col-lg-6">
                    <!-- Additional content or links can be added here -->
                </div>
                <div class="col-xl-3 offset-xl-1 col-lg-3">
                    <!-- Contact information or other widgets can be added here -->
                </div>
            </div>
        </div>
    </div>
    <div class="footer-copyright">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-6">
                    <p>&copy; 2024 Rescue Service. All Rights Reserved.</p>
                </div>
                <!-- Uncomment to add social media icons -->
                <!-- <div class="col-lg-4 col-md-6">
                    <div class="social-icons">
                        <ul>
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                        </ul>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</footer>
<!-- Footer Area Ends -->

    <!-- Footer Area End -->


    <!-- Javascript -->
    <script src="{{ asset('user/assets/js/vendor/jquery-2.2.4.min.js') }}"></script>
    <script src="{{ asset('user/assets/js/vendor/bootstrap-4.1.3.min.js') }}"></script>
    <script src="{{ asset('user/assets/js/vendor/wow.min.js') }}"></script>
    <script src="{{ asset('user/assets/js/vendor/owl-carousel.min.js') }}"></script>
    <script src="{{ asset('user/assets/js/vendor/jquery.datetimepicker.full.min.js') }}"></script>
    <script src="{{ asset('user/assets/js/vendor/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('user/assets/js/vendor/superfish.min.js') }}"></script>
    <script src="{{ asset('user/assets/js/main.js') }}"></script>
    </body>
{{--@endsection--}}
