@extends('layouts.app')

@section('title', 'Мой профиль')

@section('content')
    <div class="container mt-4">
        <h2 class="mb-4">Профиль пользователя</h2>

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
    </div>
@endsection
