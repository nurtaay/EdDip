<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    @stack('styles')
    <style>
        body {
            min-height: 100vh;
            background-color: #f8f9fa;
        }
        .sidebar {
            min-height: 100vh;
            background-color: #343a40;
            color: #fff;
        }
        .sidebar a {
            color: #fff;
            text-decoration: none;
        }
        .sidebar a:hover,
        .sidebar a.active {
            background-color: #495057;
        }
        .sidebar .nav-link {
            padding: 10px 15px;
            border-radius: 4px;
        }
    </style>
</head>
<body>
<div class="d-flex">
    <!-- Sidebar -->
    <nav class="sidebar p-3">
        <h2 class="fs-4 mb-4">Admin Panel</h2>
        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item">
                <a href="{{ route('admin.users') }}" class="nav-link">Users</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.admincourses') }}" class="nav-link">Courses</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.adminlessons') }}" class="nav-link">Lessons</a>
            </li>
            <li class="nav-item">
                <a href="" class="nav-link">Tasks</a>
            </li>
        </ul>
        <hr class="text-white">
        <div>
            <a href="{{ route('home') }}" class="d-block mb-2">На главную</a>
            <a href="{{ route('logout') }}" class="d-block">Logout</a>
        </div>
    </nav>
    <!-- Main Content -->
    <main class="flex-grow-1 p-4">
        @yield('content')
    </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
