@extends('layouts.app')

@section('title', __('profile.my_profile'))

@section('content')
    <div class="container mt-5">

        <!-- Заголовок -->
        <div class="mb-5 text-center">
            <h2 class="fw-bold text-dark">{{ __('profile.profile_title') }}</h2>
            <p class="text-muted">{{ __('profile.profile_description') }}</p>
        </div>

        <!-- Карточка профиля -->
        <div class="card border-0 shadow-sm rounded mb-4">
            <div class="card-body d-flex align-items-center gap-4 py-4 px-5 bg-light rounded-top">
                <img src="{{ $user->image ? asset('storage/' . $user->image) : asset('default-avatar.png') }}" class="rounded-circle border" width="90" height="90" alt="{{ __('profile.avatar') }}">
                <div>
                    <h4 class="mb-1">{{ $user->name }}</h4>
                    <p class="mb-0 text-muted">{{ $user->email }}</p>
                </div>
            </div>
        </div>

        <!-- Статус подписки -->
{{--        <div class="card mb-4 border-0 shadow-sm">--}}
{{--            <div class="card-body d-flex justify-content-between align-items-center py-3 px-4">--}}
{{--                <div>--}}
{{--                    <strong>{{ __('profile.subscription') }}:</strong>--}}
{{--                    @if($activeSub)--}}
{{--                        <span class="text-success fw-medium">{{ ucfirst($activeSub->type) }} ({{ __('profile.until_date', ['date' => $activeSub->end_date->format('d.m.Y')]) }})</span>--}}
{{--                    @else--}}
{{--                        <span class="text-muted">{{ __('profile.no_subscription') }}</span>--}}
{{--                    @endif--}}
{{--                </div>--}}
{{--                <a href="{{ route('subscription.plans') }}"--}}
{{--                   class="btn btn-{{ $activeSub ? 'outline-success' : 'primary' }} btn-sm">--}}
{{--                    {{ $activeSub ? __('profile.renew') : __('profile.subscribe') }}--}}
{{--                </a>--}}
{{--            </div>--}}
{{--        </div>--}}

        <!-- Управление профилем -->
        <div class="row g-4">
            <div class="col-md-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <h5 class="mb-3">{{ __('profile.edit_info') }}</h5>
                        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">{{ __('profile.name') }}</label>
                                <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">{{ __('profile.email') }}</label>
                                <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">{{ __('profile.profile_picture') }}</label>
                                <input type="file" name="image" class="form-control">
                            </div>
                            <button class="btn btn-primary w-100">{{ __('profile.save_changes') }}</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Смена пароля -->
            <div class="col-md-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <h5 class="mb-3">{{ __('profile.change_password') }}</h5>
                        <form method="POST" action="{{ route('profile.password') }}">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">{{ __('profile.current_password') }}</label>
                                <input type="password" name="current_password" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">{{ __('profile.new_password') }}</label>
                                <input type="password" name="new_password" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">{{ __('profile.confirm_password') }}</label>
                                <input type="password" name="new_password_confirmation" class="form-control">
                            </div>
                            <button class="btn btn-warning w-100">{{ __('profile.change_btn') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- История подписок -->
{{--        @if($allSubs->count())--}}
{{--            <div class="card mt-5 border-0 shadow-sm">--}}
{{--                <div class="card-body">--}}
{{--                    <h5 class="mb-3">{{ __('profile.subscription_history') }}</h5>--}}
{{--                    <div class="table-responsive">--}}
{{--                        <table class="table table-bordered align-middle mb-0">--}}
{{--                            <thead class="table-light">--}}
{{--                            <tr>--}}
{{--                                <th>{{ __('profile.type') }}</th>--}}
{{--                                <th>{{ __('profile.start_date') }}</th>--}}
{{--                                <th>{{ __('profile.end_date') }}</th>--}}
{{--                                <th>{{ __('profile.status') }}</th>--}}
{{--                            </tr>--}}
{{--                            </thead>--}}
{{--                            <tbody>--}}
{{--                            @foreach($allSubs as $sub)--}}
{{--                                <tr>--}}
{{--                                    <td>{{ ucfirst($sub->type) }}</td>--}}
{{--                                    <td>{{ \Carbon\Carbon::parse($sub->start_date)->format('d.m.Y') }}</td>--}}
{{--                                    <td>{{ \Carbon\Carbon::parse($sub->end_date)->format('d.m.Y') }}</td>--}}
{{--                                    <td>--}}
{{--                                        @if($sub->status === 'active')--}}
{{--                                            <span class="badge bg-success">{{ __('profile.active') }}</span>--}}
{{--                                        @elseif($sub->status === 'expired')--}}
{{--                                            <span class="badge bg-danger">{{ __('profile.expired') }}</span>--}}
{{--                                        @else--}}
{{--                                            <span class="badge bg-secondary">{{ $sub->status }}</span>--}}
{{--                                        @endif--}}
{{--                                    </td>--}}
{{--                                </tr>--}}
{{--                            @endforeach--}}
{{--                            </tbody>--}}
{{--                        </table>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        @endif--}}

    </div>
@endsection
