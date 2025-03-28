@extends('layouts.app')

@section('content')
    {{--    <h1>{{ __('main.welcome_user', ['name' => auth()->user()->name]) }}</h1>--}}
    {{--    <p>{{ __('main.your_role') }}: {{ auth()->user()->role }}</p>--}}
    <!-- Hero Section -->
    <section id="hero" class="hero section bg-gray-900 text-white py-20 relative">

        <img src="{{ asset('layout/assets/img/hero-bg.jpg') }}" alt="{{ __('main.hero_alt') }}" class="absolute inset-0 w-full h-full object-cover opacity-30" data-aos="fade-in">

        <div class="container position-relative z-10 text-center">
            <h2 class="text-4xl font-bold leading-tight mb-4" data-aos="fade-up" data-aos-delay="100">
                {{ __('main.learn_today') }}
            </h2>
            <p class="text-lg text-gray-200 max-w-2xl mx-auto" data-aos="fade-up" data-aos-delay="200">
                {{ __('main.our_mission') }}
            </p>
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
