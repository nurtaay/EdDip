<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>

    </title>
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
            <h1 class="sitename">
                @if($text = \App\Models\Setting::get('site_name'))
                    <div class="text-center mb-0 py-2">
                        {{ $text }}
                    </div>
                @endif
            </h1>
        </a>

        <nav id="navmenu" class="navmenu">
            <ul>
                <li><a href="#" class="active">Главная<br></a></li>
{{--                <li><a href="#">About</a></li>--}}
{{--                <li><a href="#">Courses</a></li>--}}
{{--                <li><a href="#">Trainers</a></li>--}}
{{--                <li><a href="#">Pricing</a></li>--}}
                <div class="dropdown">
                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        🌐 {{ strtoupper(app()->getLocale()) }}
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item {{ app()->getLocale() === 'ru' ? 'active' : '' }}" href="{{ route('lang.switch', 'ru') }}">🇷🇺 Русский</a></li>
                        <li><a class="dropdown-item {{ app()->getLocale() === 'kz' ? 'active' : '' }}" href="{{ route('lang.switch', 'kz') }}">🇰🇿 Қазақша</a></li>
                    </ul>
                </div>


            @auth
                <li class="dropdown"><a href="#"><span>{{ auth()->user()->name }} | {{ auth()->user()->role }}</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                    <ul>
                        <li><a href="{{ route('profile.show') }}">Профиль</a></li>
                        @if(auth()->user()->isStudent())
                            <li><a href="{{ route('student.courses.my') }}">Мои курсы</a></li>
                        @endif
                        @auth
                            @if(auth()->user()->isAdmin())
                                <li><a href="{{ route('admin.users') }}">Админ</a></li>
                            @endif

                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item border-0 bg-transparent p-0" style="color: #000; cursor: pointer;">
                                        Выйти
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
<footer id="footer" class="footer position-relative bg-gray-100 pt-5 pb-4">

    <div class="container footer-top">
        <div class="row gy-4">
            <div class="col-lg-4 col-md-6 footer-about">
                <a href="#" class="text-2xl font-semibold text-gray-800 mb-2 inline-block">
                    EduCenter
                </a>
                <div class="footer-contact text-sm text-gray-700 pt-3 leading-relaxed">
                    <p>ул. Жандосова, 55</p>
                    <p>г. Алматы, 050000</p>
                    <p class="mt-3"><strong>Телефон:</strong> <span>+7 700 700 70 70</span></p>
                    <p><strong>Email:</strong>
                    @if($text = \App\Models\Setting::get('support_email'))
                        <div class="mb-0 py-1">
                            {{ $text }}
                        </div>
                        @endif
                        </p>
                </div>
            </div>
        </div>
    </div>

    <div class="container text-center mt-6 text-sm text-gray-500 border-t pt-4">
        <p>© {{ date('Y') }} <strong class="font-semibold">EduCenter</strong>. Все права защищены.</p>
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
