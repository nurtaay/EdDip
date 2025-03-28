@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>{{ __('admin.list_users') }}</h1>
        <a href="{{ route('admin.user.create') }}" class="btn btn-primary mb-3">{{ __('admin.add_user') }}</a>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>{{ __('admin.id') }}</th>
                <th>{{ __('admin.name') }}</th>
                <th>{{ __('admin.email') }}</th>
                <th>{{ __('admin.role') }}</th>
                <th>{{ __('admin.actions') }}</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role }}</td>
                    <td>
                        <a href="{{ route('admin.user.edit', $user->id) }}" class="btn btn-warning btn-sm">{{ __('admin.edit') }}</a>
                        <form action="{{ route('admin.user.delete', $user->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">{{ __('admin.delete') }}</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
