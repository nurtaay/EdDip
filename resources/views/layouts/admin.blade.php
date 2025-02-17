<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">Admin Panel</a>
        <a href="{{ route('admin.users') }}" class="mb-3">Users</a>
        <a class="btn btn-light" href="{{ route('home') }}">На главную</a>
    </div>
</nav>
<div class="container mt-5">
    @yield('content')
</div>
</body>
</html>
