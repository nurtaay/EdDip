@extends('layouts.app')

@section('content')
{{--    <h1>Добро пожаловать, {{ auth()->user()->name }}</h1>--}}
{{--    <p>Ваша роль: {{ auth()->user()->role }}</p>--}}
    <!-- Hero Section -->
    <section id="hero" class="hero section dark-background">

        <img src="{{ asset('layout/assets/img/hero-bg.jpg') }}" alt="" data-aos="fade-in">

        <div class="container">
            <h2 data-aos="fade-up" data-aos-delay="100">Learning Today,<br>Leading Tomorrow</h2>
            <p data-aos="fade-up" data-aos-delay="200">We are team of talented designers making websites with Bootstrap</p>
            <div class="d-flex mt-4" data-aos="fade-up" data-aos-delay="300">
                <a href="#" class="btn-get-started">Get Started</a>
            </div>
        </div>

    </section><!-- /Hero Section -->
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
