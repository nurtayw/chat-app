<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <!-- Required Meta Tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Page Title -->
    <title>Contact Us</title>

    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>

    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>


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
                    <ul class="nav-menu"  style="margin-left:700px;">
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
<section class="banner-area other-page">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1>Contact Us</h1>
                <a href="/">Home</a> <span>|</span> <a href="">Contact Us</a>
            </div>
        </div>
    </div>
</section>
<!-- Banner Area End -->
<!-- Map Area Starts -->
<section class="map-area section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div id="mapBox" class="mapBox" style="height: 400px;"></div>
            </div>
        </div>
    </div>
</section>
<!-- Map Area End -->




<!-- Contact Form Starts -->
<section class="contact-form section-padding3">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 mb-5 mb-lg-0">
                <div class="d-flex">
                    <div class="into-icon">
                        <i class="fa fa-home"></i>
                    </div>
                    <div class="info-text">
                        <h3>Almaty, Kazakhstan</h3>
                        <p>Almaty city</p>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="into-icon">
                        <i class="fa fa-phone"></i>
                    </div>
                    <div class="info-text">
                        <h3>7 777 777 777</h3>
                        <p>Mon to Fri  9 to 18 </p>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="into-icon">
                        <i class="fa fa-envelope-o"></i>
                    </div>
                    <div class="info-text">
                        <h3>support@rescue.com</h3>
                        <p>Send us your query anytime!</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <form action="{{ route('contact.store') }}" method="POST">
                    @csrf
                    <div class="left">
                        <input type="text" name="name" placeholder="Enter your name" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter your name'" required>
                        <input type="email" name="email" placeholder="Enter email address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter email address'" required>
                    </div>
                    <div class="right">
                        <textarea name="message" cols="20" rows="7"  placeholder="Enter Message" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Message'" required></textarea>
                    </div>
                    <button type="submit" class="template-btn">Send</button>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- Contact Form End -->


<!-- Footer Area Starts -->
<footer class="footer-area section-padding">
    <div class="footer-widget">
        <div class="container">
            <div class="row">
                <div class="col-xl-2 col-lg-3">
                    <div class="single-widget-home mb-5 mb-lg-0">
                        <h3 class="mb-4">top products</h3>
                        <ul>
                            <li class="mb-2"><a href="#">managed website</a></li>
                            <li class="mb-2"><a href="#">managed reputation</a></li>
                            <li class="mb-2"><a href="#">power tools</a></li>
                            <li><a href="#">marketing service</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-5 offset-xl-1 col-lg-6">
                    <div class="single-widget-home mb-5 mb-lg-0">
                        <h3 class="mb-4">newsletter</h3>
                        <p class="mb-4">You can trust us. we only send promo offers, not a single.</p>
                        <form action="#">
                            <input type="email" placeholder="Your email here" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Your email here'" required>
                            <button type="submit" class="template-btn">subscribe now</button>
                        </form>
                    </div>
                </div>
                <div class="col-xl-3 offset-xl-1 col-lg-3">
                    <div class="single-widge-home">
                        <h3 class="mb-4">instagram feed</h3>
                        <div class="feed">
                            <img src="{{ asset('user/assets/images/feed1.jpg') }}" alt="feed">
                            <img src="{{ asset('user/assets/images/feed2.jpg') }}" alt="feed">
                            <img src="{{ asset('user/assets/images/feed3.jpg') }}" alt="feed">
                            <img src="{{ asset('user/assets/images/feed4.jpg') }}" alt="feed">
                            <img src="{{ asset('user/assets/images/feed5.jpg') }}" alt="feed">
                            <img src="{{ asset('user/assets/images/feed6.jpg') }}" alt="feed">
                            <img src="{{ asset('user/assets/images/feed7.jpg') }}" alt="feed">
                            <img src="{{ asset('user/assets/images/feed8.jpg') }}" alt="feed">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-copyright">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-6">

                </div>
                <div class="col-lg-4 col-md-6">

                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Footer Area End -->

<!-- Javascript -->
<script src="{{ asset('user/assets/js/vendor/jquery-2.2.4.min.js') }}"></script>
<script src="{{ asset('user/assets/js/vendor/bootstrap-4.1.3.min.js') }}"></script>
<script src="{{ asset('user/assets/js/vendor/wow.min.js') }}"></script>
<script src="{{ asset('user/assets/js/vendor/owl-carousel.min.js') }}"></script>
<script src="{{ asset('user/assets/js/vendor/jquery.datetimepicker.full.min.js') }}"></script>
<script src="{{ asset('user/assets/js/vendor/jquery.nice-select.min.js') }}"></script>
<script src="{{ asset('user/assets/js/vendor/superfish.min.js') }}"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDpfS1oRGreGSBU5HHjMmQ3o5NLw7VdJ6I"></script>
<script src="{{ asset('user/assets/js/vendor/gmaps.min.js') }}"></script>
<script src="{{ asset('user/assets/js/main.js') }}">
</script>

<script>
    // JavaScript code to initialize OpenStreetMap (Leaflet)
    document.addEventListener("DOMContentLoaded", function () {
        var map = L.map('mapBox').setView([43.2455, 76.9471], 13); // Coordinates for Алматы, ул. Жандосова 55

        // Set the tile layer from OpenStreetMap
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        // Add a marker at the specified location
        L.marker([43.2455, 76.9471]).addTo(map)
            .bindPopup('<b>Almaty, ул. Жандосова 55</b>')
            .openPopup();
    });

</script>


</body>
</html>
