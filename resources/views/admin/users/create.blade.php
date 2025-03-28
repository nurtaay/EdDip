@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>{{ __('admin.new_user') }}</h1>

        <form action="{{ route('admin.user.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">{{ __('admin.name') }}</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">{{ __('admin.email') }}</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">{{ __('admin.password') }}</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="role" class="form-label">{{ __('admin.role') }}</label>
                <select name="role" class="form-control">
                    <option value="user">User</option>
                    <option value="teacher">Teacher</option>
                    <option value="admin">Admin</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">{{ __('admin.save') }}</button>
        </form>
    </div>
@endsection
