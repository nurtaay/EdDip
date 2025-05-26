<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

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
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

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
                <li><a href="{{ route('home') }}" class="active">{{ __('main.home') }}<br></a></li>

                <div class="dropdown">
                    <button class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        🌐 {{ strtoupper(app()->getLocale()) }}
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item {{ app()->getLocale() === 'ru' ? 'active' : '' }}" href="{{ route('lang.switch', 'ru') }}">🇷🇺 {{ __('main.russian') }}</a></li>
                        <li><a class="dropdown-item {{ app()->getLocale() === 'kz' ? 'active' : '' }}" href="{{ route('lang.switch', 'kz') }}">🇰🇿 {{ __('main.kazakh') }}</a></li>
                    </ul>
                </div>


                @auth
                    @php
                        $unread = auth()->user()->unreadNotifications->take(2); // ← только 2 последних
                    @endphp

                    <li class="nav-item dropdown">
                        <a class="nav-link position-relative" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                            🔔
                            @if(auth()->user()->unreadNotifications->count())
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    {{ auth()->user()->unreadNotifications->count() }}
                </span>
                            @endif
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end shadow" style="min-width: 250px; max-width: 320px;">
                            <li class="dropdown-header small fw-bold">
                                {{ __('main.notifications') }}
                            </li>

                            @forelse ($unread as $notification)
                                <li class="px-2 py-1">
                                    <a class="dropdown-item text-wrap text-break p-2 rounded small" href="{{ $notification->data['url'] ?? '#' }}" style="line-height: 1.25;">
                                        <div class="fw-semibold mb-1">{{ $notification->data['title'] }}</div>
                                        <div class="text-muted" style="font-size: 0.85rem;">
                                            {{ \Illuminate\Support\Str::limit($notification->data['message'], 150) }}
                                        </div>
                                    </a>
                                </li>
                            @empty
                                <li><span class="dropdown-item text-muted small">{{ __('main.no_notifications') }}</span></li>
                            @endforelse

                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item text-center small text-primary" href="{{ route('notifications.all') }}">
                                    {{ __('main.view_all_notifications') }}
                                </a>
                            </li>
                        </ul>
                    </li>
                @endauth





            @auth
                    <li class="dropdown">
                        <a href="#"><span>{{ auth()->user()->name }} | {{ auth()->user()->role }}</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                        <ul>
                            <li>
                                <a href="{{ route('profile.show') }}">{{ __('main.profile') }}</a>
                            </li>

                            @if(auth()->user()->isStudent())
                                <li>
                                    <a href="{{ route('student.courses.my') }}">{{ __('main.my_courses') }}</a>
                                </li>
                            @endif

                            @if(auth()->user()->isAdmin())
                                <li>
                                    <a href="{{ route('admin.users') }}">{{ __('main.admin') }}</a>
                                </li>
                            @endif

                            <li>
                                <form method="POST" action="{{ route('logout') }}" class="m-0 p-0">
                                    @csrf
                                    <button type="submit"
                                            class="w-100 text-start bg-transparent border-0 dropdown-item"
                                            style="padding: 8px 16px; font-size: 14px; color: #ec1212;">
                                        {{ __('main.logout') }}
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @endauth

            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>
    </div>
</header>

<main class="main" style="min-height: 600px">
    {{-- Блок уведомлений --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="mt-4">
{{--        @include('components.breadcrumbs')--}}
        @yield('content')

        @yield('scripts')
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
                    {{ __('main.educenter') }}
                </a>
                <div class="footer-contact text-sm text-gray-700 pt-3 leading-relaxed">
                    <p>{{ __('main.address_line1') }}</p>
                    <p>{{ __('main.address_line2') }}</p>
                    <p class="mt-3"><strong>{{ __('main.phone') }}:</strong> <span>+7 700 700 70 70</span></p>
                    <p><strong>{{ __('main.email') }}:</strong>
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
        <p>© {{ date('Y') }} <strong class="font-semibold">{{ __('main.educenter') }}</strong>. {{ __('main.all_rights') }}</p>
    </div>

</footer>

<!-- Scroll Top -->
<a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
@stack('scripts')
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
