<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Index - Mentor Bootstrap Template</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link href="{{ asset('layout/assets/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('layout/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('layout/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('layout/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('layout/assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('layout/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('layout/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="{{ asset('layout/assets/css/main.css') }}" rel="stylesheet">

</head>

<body class="index-page">

<header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

        <a href="{{ route('home') }}" class="logo d-flex align-items-center me-auto">
            <!-- Uncomment the line below if you also wish to use an image logo -->
            <!-- <img src="assets/img/logo.png" alt=""> -->
            <h1 class="sitename">Mentor</h1>
        </a>

        <nav id="navmenu" class="navmenu">
            <ul>
                <li><a href="#" class="active">Home<br></a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Courses</a></li>
                <li><a href="#">Trainers</a></li>
                <li><a href="#">Pricing</a></li>
                @auth
                <li class="dropdown"><a href="#"><span>{{ auth()->user()->name }} | {{ auth()->user()->role }}</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                    <ul>
                        <li><a href="{{ route('profile.show') }}">Profile</a></li>
                        @if(auth()->user()->isStudent())
                            <li><a href="{{ route('student.courses.my') }}">my courses</a></li>
                        @endif
                        @auth
                            @if(auth()->user()->isAdmin())
                                <li><a href="{{ route('admin.users') }}">Admin Page</a></li>
                            @endif

                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item border-0 bg-transparent p-0" style="color: #000; cursor: pointer;">
                                        Logout
                                    </button>
                                </form>
                            </li>
                        @endauth

                    </ul>
                </li>
                @endauth
            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

        <a class="btn-getstarted" href="#">Get Started</a>

    </div>
</header>

<main class="main" style="min-height: 600px">
    <div class="mt-4">
        @yield('content')
    </div>

    @auth
        @if(auth()->user()->role === 'user')
            <div class="container mt-4">
                @yield('about')
            </div>
            <div class="container mt-4">
                @yield('us')
            </div>
            <div class="container mt-4">
                @yield('card')
            </div>
            <div class="container mt-4">
                @yield('tech')
            </div>
        @elseif(auth()->user()->role === 'teacher')
            <div class="container mt-4">
                @yield('teacher')
            </div>
        @endif
    @endauth
</main>
<footer id="footer" class="footer position-relative light-background">

    <div class="container footer-top">
        <div class="row gy-4">
            <div class="col-lg-4 col-md-6 footer-about">
                <a href="#" class="logo d-flex align-items-center">
                    <span class="sitename">Mentor</span>
                </a>
                <div class="footer-contact pt-3">
                    <p>Zhandosova 55</p>
                    <p>Almaty, ALM 550000</p>
                    <p class="mt-3"><strong>Phone:</strong> <span>8700 700 70 70</span></p>
                    <p><strong>Email:</strong> <span>info@gmail.com</span></p>
                </div>
                <div class="social-links d-flex mt-4">
                    <a href=""><i class="bi bi-twitter-x"></i></a>
                    <a href=""><i class="bi bi-facebook"></i></a>
                    <a href=""><i class="bi bi-instagram"></i></a>
                    <a href=""><i class="bi bi-linkedin"></i></a>
                </div>
            </div>

            <div class="col-lg-2 col-md-3 footer-links">
                <h4>Useful Links</h4>
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">About us</a></li>
                    <li><a href="#">Services</a></li>
                    <li><a href="#">Terms of service</a></li>
                    <li><a href="#">Privacy policy</a></li>
                </ul>
            </div>

            <div class="col-lg-2 col-md-3 footer-links">
                <h4>Our Services</h4>
                <ul>
                    <li><a href="#">Web Design</a></li>
                    <li><a href="#">Web Development</a></li>
                    <li><a href="#">Product Management</a></li>
                    <li><a href="#">Marketing</a></li>
                    <li><a href="#">Graphic Design</a></li>
                </ul>
            </div>

            <div class="col-lg-4 col-md-12 footer-newsletter">
                <h4>Our Newsletter</h4>
                <p>Subscribe to our newsletter and receive the latest news about our products and services!</p>
                <form action="forms/newsletter.php" method="post" class="php-email-form">
                    <div class="newsletter-form"><input type="email" name="email"><input type="submit" value="Subscribe"></div>
                    <div class="loading">Loading</div>
                    <div class="error-message"></div>
                    <div class="sent-message">Your subscription request has been sent. Thank you!</div>
                </form>
            </div>

        </div>
    </div>

    <div class="container copyright text-center mt-4">
        <p>© <span>Copyright</span> <strong class="px-1 sitename">Mentor</strong> <span>All Rights Reserved</span></p>
        <div class="credits">
            <!-- All the links in the footer should remain intact. -->
            <!-- You can delete the links only if you've purchased the pro version. -->
            <!-- Licensing information: https://bootstrapmade.com/license/ -->
            <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
{{--            Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>--}}
        </div>
    </div>

</footer>

<!-- Scroll Top -->
<a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Preloader -->
<div id="preloader"></div>

<!-- Vendor JS Files -->
<script src="{{ asset('layout/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('layout/assets/vendor/php-email-form/validate.js') }}"></script>
<script src="{{ asset('layout/assets/vendor/aos/aos.js') }}"></script>
<script src="{{ asset('layout/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
<script src="{{ asset('layout/assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
<script src="{{ asset('layout/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>

<!-- Main JS File -->
<script src="{{ asset('layout/assets/js/main.js') }}"></script>

</body>

</html>
