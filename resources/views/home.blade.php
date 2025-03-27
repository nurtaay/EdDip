@extends('layouts.app')

@section('content')
{{--    <h1>Добро пожаловать, {{ auth()->user()->name }}</h1>--}}
{{--    <p>Ваша роль: {{ auth()->user()->role }}</p>--}}
    <!-- Hero Section -->
<section id="hero" class="hero section bg-gray-900 text-white py-20 relative">

    <img src="{{ asset('layout/assets/img/hero-bg.jpg') }}" alt="Образование для будущего" class="absolute inset-0 w-full h-full object-cover opacity-30" data-aos="fade-in">

    <div class="container position-relative z-10 text-center">
        <h2 class="text-4xl font-bold leading-tight mb-4" data-aos="fade-up" data-aos-delay="100">
            Учитесь сегодня,<br>Лидируйте завтра
        </h2>
        <p class="text-lg text-gray-200 max-w-2xl mx-auto" data-aos="fade-up" data-aos-delay="200">
            Мы — команда, создающая современные образовательные решения с применением цифровых технологий.
        </p>
        <div class="d-flex justify-content-center mt-6" data-aos="fade-up" data-aos-delay="300">
{{--            <a href="#" class="px-6 py-3 bg-white text-gray-900 rounded-xl shadow hover:bg-gray-100 transition">--}}
{{--                Начать обучение--}}
{{--            </a>--}}
        </div>
    </div>

</section>
<!-- /Hero Section -->
@endsection


@section('about')
    @include('about')
@endsection

@section('us')
    @include('us')
@endsection

@section('card')
    @include('student.courses.index')
@endsection

@section('tech')
    @include('tech')
@endsection

@section('teacher')
    @include('teacher.courses.index')
@endsection
