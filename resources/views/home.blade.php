@extends('layouts.app')

@section('content')
    {{--    <h1>{{ __('main.welcome_user', ['name' => auth()->user()->name]) }}</h1>--}}
    {{--    <p>{{ __('main.your_role') }}: {{ auth()->user()->role }}</p>--}}
    <!-- Hero Section -->
        <div class="py-5" style="background-color: var(--background-color); color: var(--default-color); width: 1100px; margin-left: 200px">
            <div class="container">
                <div class="row align-items-center">
                    {{-- Левая часть --}}
                    <div class="col-lg-6 text-center text-lg-start mb-4 mb-lg-0">
                        <h1 class="display-5 fw-bold mb-3" style="color: var(--heading-color);">
                            {{ __('main.intro_title') ?? 'Введение в программирование' }}
                        </h1>
                        <p class="lead mb-4">
                            {{ __('main.intro_subtitle') ?? 'Бесплатный курс по выбору IT-направления. Попробуй профессии, пройди тест и выбери свой путь в IT.' }}
                        </p>
                    </div>

                    {{-- Правая часть — изображение --}}
                    <div class="col-lg-6 text-center">
                        <img src="{{ asset('layout/assets/img/111.png') }}"
                             class="img-fluid rounded shadow" alt="Курс по программированию" style="max-height: 320px;">
                    </div>
                </div>

                {{-- Карточки --}}
                <div class="row text-center mt-5 g-4">
                    @php
                        $cards = [
                            ['title' => '7 IT-профессий', 'text' => 'Поймешь, кто чем занимается в IT'],
                            ['title' => 'Практика', 'text' => 'Попробуешь профессии на практике'],
                            ['title' => 'Тест', 'text' => 'Узнаешь, что тебе подходит'],
                            ['title' => 'Бесплатно', 'text' => 'Полный доступ без оплаты']
                        ];
                    @endphp

                    @foreach([1, 2, 3, 4] as $i)
                        <div class="col-6 col-lg-3">
                            <div class="card h-100 shadow"
                                 style="background-color: var(--surface-color); color: var(--default-color); border: none;">
                                <div class="card-body">
                                    <h5 class="card-title fw-bold" style="color: var(--heading-color);">
                                        {{ __('main.card_'.$i.'_title') }}
                                    </h5>
                                    <p class="card-text small">{{ __('main.card_'.$i.'_text') }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>


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

