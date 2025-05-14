@extends('layouts.admin')

@section('content')
@php
    $groupedUsers = $users->groupBy('role');
    $currentUserId = auth()->id();
@endphp

@foreach($groupedUsers as $role => $usersGroup)
    <h2 class="mt-5 text-capitalize">{{ __('admin.role_' . $role) }}</h2>
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
        @foreach ($usersGroup as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role }}</td>
                <td>
                    <a href="{{ route('admin.user.edit', $user->id) }}"
                       class="border-5 rounded btn btn-outline-primary btn-sm">{{ __('admin.edit') }}</a>

                    @if($user->id !== $currentUserId)x
                        <form action="{{ route('admin.user.delete', $user->id) }}"
                              method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="border border-grey-600 rounded btn btn-danger btn-sm">
                                {{ __('admin.delete') }}
                            </button>
                        </form>
                    @else
                        <span class="text-muted">{{ __('admin.cannot_delete_self') }}</span>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endforeach
@endsection
