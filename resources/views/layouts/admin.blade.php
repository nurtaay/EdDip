<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin</title>

    <link href="{{ asset('admin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="{{ asset('admin/css/sb-admin-2.min.css') }}" rel="stylesheet">
</head>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-..." crossorigin="anonymous"></script>

<body id="page-top">
@php
    // Получаем текущий маршрут или URL
    $currentRoute = Route::currentRouteName();

    // Проверяем, к какому разделу он относится
    $isManagementOpen = Str::startsWith($currentRoute, 'admin.users') || Str::startsWith($currentRoute, 'admin.logins.index');
    $isUtilitiesOpen = Str::startsWith($currentRoute, 'admin.admincourses') || Str::startsWith($currentRoute, 'admin.categories') || Str::startsWith($currentRoute, 'admin.activity') || Str::startsWith($currentRoute, 'admin.settings') || Str::startsWith($currentRoute, 'pending') || Str::startsWith($currentRoute, 'admin.statistics.sales') || Str::startsWith($currentRoute, 'teacher-applications.index') || Str::startsWith($currentRoute, 'contacts.index') || Str::startsWith($currentRoute, 'admin.bot.index');
@endphp
<div id="wrapper">
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home') }}">

            <div class="sidebar-brand-text mx-3">
                @if($text = \App\Models\Setting::get('site_name'))
                    <div class="text-center mb-0 py-2">
                        {{ $text }}
                    </div>
                @endif <sup></sup>
            </div>
        </a>
        <hr class="sidebar-divider my-0">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('home') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>{{ __('admin.layout.dashboard') }}</span></a>
        </li>
        <hr class="sidebar-divider">
        <div class="sidebar-heading">
            {{ __('admin.layout.interface') }}
        </div>
        <!-- Управление -->
        <li class="nav-item {{ $isManagementOpen ? 'active' : '' }}">
            <a class="nav-link {{ $isManagementOpen ? '' : 'collapsed' }}" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="{{ $isManagementOpen ? 'true' : 'false' }}" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-cog"></i>
                <span>{{ __('admin.layout.management') }}</span>
            </a>
            <div id="collapseTwo" class="collapse {{ $isManagementOpen ? 'show' : '' }}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item {{ $currentRoute == 'admin.users' ? 'active' : '' }}" href="{{ route('admin.users') }}">{{ __('admin.layout.users') }}</a>
                    <a class="collapse-item {{ $currentRoute == 'admin.logins.index' ? 'active' : '' }}" href="{{ route('admin.logins.index') }}">{{ __('admin.layout.log') }}</a>
                </div>
            </div>
        </li>
        <!-- Утилиты -->
        <li class="nav-item {{ $isUtilitiesOpen ? 'active' : '' }}">
            <a class="nav-link {{ $isUtilitiesOpen ? '' : 'collapsed' }}" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="{{ $isUtilitiesOpen ? 'true' : 'false' }}" aria-controls="collapseUtilities">
                <i class="fas fa-fw fa-wrench"></i>
                <span>{{ __('admin.layout.utilities') }}</span>
            </a>
            <div id="collapseUtilities" class="collapse {{ $isUtilitiesOpen ? 'show' : '' }}" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Custom Utilities:</h6>
                    <a class="collapse-item {{ $currentRoute == 'admin.admincourses' ? 'active' : '' }}" href="{{ route('admin.admincourses') }}">{{ __('admin.layout.courses') }}</a>
                    <a class="collapse-item {{ $currentRoute == 'admin.categories' ? 'active' : '' }}" href="{{ route('admin.categories') }}">{{ __('admin.layout.categories') }}</a>
                    <a class="collapse-item {{ $currentRoute == 'admin.activity' ? 'active' : '' }}" href="{{ route('admin.activity') }}">{{ __('admin.layout.activity') }}</a>
                    <a class="collapse-item {{ $currentRoute == 'admin.settings' ? 'active' : '' }}" href="{{ route('admin.settings') }}">{{ __('admin.layout.settings') }}</a>
                    <a class="collapse-item {{ $currentRoute == 'pending' ? 'active' : '' }}" href="{{ route('pending') }}">{{ __('admin.layout.courses_check') }}</a>
                    <a class="collapse-item {{ $currentRoute == 'admin.statistics.sales' ? 'active' : '' }}" href="{{ route('admin.statistics.sales') }}">{{ __('admin.layout.buy') }}</a>
                    <a class="collapse-item {{ $currentRoute == 'teacher-applications.index' ? 'active' : '' }}" href="{{ route('teacher-applications.index') }}">{{ __('admin.teacher-applications.index') }}</a>
                    <a class="collapse-item {{ $currentRoute == 'contacts.index' ? 'active' : '' }}" href="{{ route('contacts.index') }}">{{ __('admin.contacts') }}</a>
                    <a class="collapse-item {{ $currentRoute == 'admin.bot.index' ? 'active' : '' }}" href="{{ route('admin.bot.index') }}">{{ __('admin.bot') }}</a>
                    <a class="collapse-item {{ $currentRoute == 'admin.bot.index' ? 'active' : '' }}" href="{{ route('chat.index') }}">🗨️ Live Chat
                        @if(!empty($unreadMessages))
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                {{ $unreadMessages }}
                            </span>
                        @endif
                    </a>

                </div>
            </div>
        </li>
    </ul>
    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>
                <form
                    class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                    <div class="input-group">
                        <input type="text" class="form-control bg-light border-0 small" placeholder="{{ __('admin.layout.search_placeholder') }}"
                               aria-label="Search" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>
                <div class="dropdown">
                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        🌐 {{ strtoupper(app()->getLocale()) }}
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item {{ app()->getLocale() === 'ru' ? 'active' : '' }}" href="{{ route('lang.switch', 'ru') }}">🇷🇺 Русский</a></li>
                        <li><a class="dropdown-item {{ app()->getLocale() === 'kz' ? 'active' : '' }}" href="{{ route('lang.switch', 'kz') }}">🇰🇿 Қазақша</a></li>
                    </ul>
                </div>
                <li class="list-group">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ auth()->user()->name }}</span>
{{--                        <img class="img-profile rounded-circle" style="width: 40px"--}}
{{--                             src="img/undraw_profile.svg">--}}
                    </a>

                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                         aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="{{ route('admin.profile') }}">
                            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                            {{ __('admin.layout.profile') }}
                        </a>
{{--                        <a class="dropdown-item" href="#">--}}
{{--                            <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>--}}
{{--                            Settings--}}
{{--                        </a>--}}
{{--                        <a class="dropdown-item" href="#">--}}
{{--                            <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>--}}
{{--                            Activity Log--}}
{{--                        </a>--}}
                        <div class="dropdown-divider"></div>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>

                        <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            {{ __('admin.layout.logout') }}
                        </a>

                    </div>
                </li>
            </nav>
        </div>

        <!-- main -->
        <main class="flex-grow-1 p-4">
{{--            @include('components.breadcrumbs')--}}

            @yield('content')

            @yield('scripts')
        </main>

        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>{{ __('admin.layout.copyright') }}</span>
                </div>
            </div>
        </footer>
    </div>
</div>
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">{{ __('admin.layout.select_logout') }}</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">{{ __('admin.layout.cancel') }}</button>
                <a class="btn btn-primary" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    {{ __('admin.layout.logout') }}
                </a>

            </div>
        </div>
    </div>
</div>

<script src="{{ asset('admin/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
<script src="{{ asset('admin/js/sb-admin-2.min.js') }}"></script>
@vite('resources/js/app.js')

@stack('scripts')
</body>
</html>
