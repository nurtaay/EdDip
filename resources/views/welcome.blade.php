@extends('layouts.app')

@section('content')
    <div class="container py-5 text-center">
        <h1 class="display-4 fw-bold mb-4">Добро пожаловать в EduSphere</h1>
        <p class="lead text-muted mb-5">Обучающая платформа на казахском и русском языках. Курсы, задания, оценивание и подписка — всё в одном месте.</p>

        <div class="d-flex justify-content-center gap-3">
            @auth
                <a href="{{ url('/home') }}" class="btn btn-primary btn-lg">Перейти в кабинет</a>
            @else
                <a href="{{ route('login') }}" class="btn btn-outline-primary btn-lg">Войти</a>
                <a href="{{ route('register') }}" class="btn btn-primary btn-lg">Зарегистрироваться</a>
            @endauth
        </div>

        <div class="mt-5">
{{--            <img src="{{ asset('images/landing-preview.png') }}" class="img-fluid" alt="Preview">--}}
        </div>
    </div>
@endsection
