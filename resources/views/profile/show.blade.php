@extends('layouts.app')

@section('title', 'Мой профиль')

@section('content')
    <div class="container mt-4">
        <h2 class="mb-4">Профиль пользователя</h2>
        {{-- Статус подписки --}}
        <div class="alert alert-{{ $activeSub ? 'success' : 'secondary' }} mb-4">
            @if($activeSub)
                <strong>Подписка:</strong> {{ ucfirst($activeSub->type) }} — активна до {{ $activeSub->end_date->format('d.m.Y') }}
                <a href="{{ route('subscription.plans') }}" class="btn btn-outline-light btn-sm ms-3">Продлить</a>
            @else
                <strong>Подписка:</strong> отсутствует
                <a href="{{ route('subscription.plans') }}" class="btn btn-outline-primary btn-sm ms-3">Оформить</a>
            @endif
        </div>

    @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        {{-- Информация --}}
        <div class="card mb-4">
            <div class="card-body d-flex align-items-center gap-4">
                <img src="{{ $user->image ? asset('storage/' . $user->image) : asset('default-avatar.png') }}" class="rounded-circle" width="80" height="80" alt="Аватар">
                <div>
                    <h5 class="mb-1">{{ $user->name }}</h5>
                    <p class="mb-0 text-muted">{{ $user->email }}</p>
                </div>
            </div>
        </div>

        {{-- Кнопка: Показать форму редактирования --}}
        <div class="mb-3">
            <button class="btn btn-outline-primary w-100 text-start" data-bs-toggle="collapse" data-bs-target="#editForm" aria-expanded="false">
                ✏️ Редактировать данные
            </button>
        </div>

        {{-- Collapse: Форма редактирования --}}
        <div class="collapse" id="editForm">
            <div class="card card-body mb-4">
                <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Имя</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Фото профиля</label>
                        <input type="file" name="image" class="form-control">
                    </div>
                    <button class="btn btn-primary">Сохранить изменения</button>
                </form>
            </div>
        </div>

        {{-- Кнопка: Показать форму смены пароля --}}
        <div class="mb-3">
            <button class="btn btn-outline-warning w-100 text-start" data-bs-toggle="collapse" data-bs-target="#passwordForm" aria-expanded="false">
                🔒 Сменить пароль
            </button>
        </div>

        {{-- Collapse: Форма смены пароля --}}
        <div class="collapse" id="passwordForm">
            <div class="card card-body">
                <form method="POST" action="{{ route('profile.password') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Текущий пароль</label>
                        <input type="password" name="current_password" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Новый пароль</label>
                        <input type="password" name="new_password" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Подтвердите новый пароль</label>
                        <input type="password" name="new_password_confirmation" class="form-control">
                    </div>
                    <button class="btn btn-warning">Изменить пароль</button>
                </form>
            </div>
        </div>
        @if($allSubs->count())
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="mb-3">История подписок</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered mb-0">
                            <thead>
                            <tr>
                                <th>Тип</th>
                                <th>Начало</th>
                                <th>Окончание</th>
                                <th>Статус</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($allSubs as $sub)
                                <tr>
                                    <td>{{ ucfirst($sub->type) }}</td>
                                    <td>{{ \Carbon\Carbon::parse($sub->start_date)->format('d.m.Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($sub->end_date)->format('d.m.Y') }}</td>
                                    <td>
                                        @if($sub->status === 'active')
                                            <span class="text-success">Активна</span>
                                        @elseif($sub->status === 'expired')
                                            <span class="text-danger">Истекла</span>
                                        @else
                                            <span class="text-muted">{{ $sub->status }}</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif

    </div>
@endsection
