@extends('layouts.app')

@section('title', 'Мой профиль')

@section('content')
    <div class="container mt-5">

        <!-- Заголовок -->
        <div class="mb-5 text-center">
            <h2 class="fw-bold text-dark">Личный кабинет</h2>
            <p class="text-muted">Управляйте своей информацией, подпиской и безопасностью</p>
        </div>

        <!-- Карточка профиля -->
        <div class="card border-0 shadow-sm rounded mb-4">
            <div class="card-body d-flex align-items-center gap-4 py-4 px-5 bg-light rounded-top">
                <img src="{{ $user->image ? asset('storage/' . $user->image) : asset('default-avatar.png') }}" class="rounded-circle border" width="90" height="90" alt="Аватар">
                <div>
                    <h4 class="mb-1">{{ $user->name }}</h4>
                    <p class="mb-0 text-muted">{{ $user->email }}</p>
                </div>
            </div>
        </div>

        <!-- Статус подписки -->
        <div class="card mb-4 border-0 shadow-sm">
            <div class="card-body d-flex justify-content-between align-items-center py-3 px-4">
                <div>
                    <strong>Подписка:</strong>
                    @if($activeSub)
                        <span class="text-success fw-medium">{{ ucfirst($activeSub->type) }} (до {{ $activeSub->end_date->format('d.m.Y') }})</span>
                    @else
                        <span class="text-muted">отсутствует</span>
                    @endif
                </div>
                <a href="{{ route('subscription.plans') }}"
                   class="btn btn-{{ $activeSub ? 'outline-success' : 'primary' }} btn-sm">
                    {{ $activeSub ? 'Продлить' : 'Оформить' }}
                </a>
            </div>
        </div>

        <!-- Уведомление -->
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Управление профилем -->
        <div class="row g-4">
            <div class="col-md-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <h5 class="mb-3">Редактирование данных</h5>
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
                            <button class="btn btn-primary w-100">Сохранить изменения</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Смена пароля -->
            <div class="col-md-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <h5 class="mb-3">Сменить пароль</h5>
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
                            <button class="btn btn-warning w-100">Изменить пароль</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- История подписок -->
        @if($allSubs->count())
            <div class="card mt-5 border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="mb-3">История подписок</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered align-middle mb-0">
                            <thead class="table-light">
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
                                            <span class="badge bg-success">Активна</span>
                                        @elseif($sub->status === 'expired')
                                            <span class="badge bg-danger">Истекла</span>
                                        @else
                                            <span class="badge bg-secondary">{{ $sub->status }}</span>
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
