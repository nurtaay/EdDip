@extends('layouts.app')

@section('title', $course->title)

@section('content')
    <!-- Заголовок курса -->
    <div class="page-title py-5 border-bottom" data-aos="fade">
        <div class="container">
            <div class="row d-flex justify-content-center text-center">
                <div class="col-lg-8">
                    <h1 class="fw-bold">{{ $course->title }}</h1>
                    <p class="mb-0 text-muted">{{ Str::limit($course->description, 150) }}</p>
                </div>
            </div>
        </div>
        <nav class="breadcrumbs mt-3">
            <div class="container">
                <ol class="breadcrumb bg-transparent p-0">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Главная</a></li>
                    <li class="breadcrumb-item active">Курс преподавателя</li>
                </ol>
            </div>
        </nav>
    </div>

    <!-- Кнопка перехода к студентам -->
    <div class="container mt-4 text-end">
        <a href="{{ route('teacher.courses.students', $course->id) }}" class="btn btn-outline-secondary btn-sm">
            👥 Студенты курса
        </a>
    </div>

    <!-- Основная информация -->
    <section class="courses-course-details section mt-4">
        <div class="container" data-aos="fade-up">
            <div class="row">
                <div class="col-lg-8">
                    <img src="{{ asset('storage/' . $course->image) }}" class="img-fluid rounded shadow-sm mb-3" alt="{{ $course->title }}">
                    <h3 class="fw-semibold">{{ $course->title }}</h3>
                    <p>{{ $course->description }}</p>
                </div>

                <div class="col-lg-4">
                    <div class="bg-light p-3 rounded shadow-sm">
                        <div class="mb-2 d-flex justify-content-between">
                            <span class="fw-medium">Преподаватель:</span>
                            <span>{{ $course->user->name ?? 'Без имени' }}</span>
                        </div>
                        <div class="mb-2 d-flex justify-content-between">
                            <span class="fw-medium">Категория:</span>
                            <span>{{ $course->category->name ?? 'Без категории' }}</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="fw-medium">Стоимость:</span>
                            <span class="text-success fw-bold">{{ $course->price }} ₸</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Уроки в табах -->
    <section id="tabs" class="tabs section py-5 bg-light">
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row">
                <!-- Навигация -->
                <div class="col-lg-3">
                    <ul class="nav nav-tabs flex-column shadow-sm" role="tablist">
                        @foreach($course->lessons as $index => $lesson)
                            <li class="nav-item" role="presentation">
                                <button class="nav-link {{ $index === 0 ? 'active' : '' }}" data-bs-toggle="tab"
                                        data-bs-target="#lesson-{{ $lesson->id }}" type="button" role="tab">
                                    {{ $lesson->title }}
                                </button>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Контент урока -->
                <div class="col-lg-9 mt-4 mt-lg-0">
                    <div class="tab-content">
                        @foreach($course->lessons as $index => $lesson)
                            <div class="tab-pane fade {{ $index === 0 ? 'show active' : '' }}"
                                 id="lesson-{{ $lesson->id }}" role="tabpanel">
                                <div class="row g-4 align-items-start">
                                    {{-- Видео --}}
                                    @if ($lesson->video)
                                        <div class="col-md-5">
                                            <video controls class="rounded shadow-sm w-100">
                                                <source src="{{ asset('storage/' . $lesson->video) }}" type="video/mp4">
                                                Ваш браузер не поддерживает видео.
                                            </video>
                                        </div>
                                    @endif

                                    {{-- Контент --}}
                                    <div class="{{ $lesson->video ? 'col-md-7' : 'col-12' }}">
                                        <h5 class="fw-bold">{{ $lesson->title }}</h5>
                                        <p class="text-muted fst-italic mb-2">{{ Str::limit(strip_tags($lesson->content), 100) }}</p>
                                        <div class="lesson-content mb-3">
                                            {!! nl2br(e($lesson->content)) !!}
                                        </div>

                                        <a href="{{ route('lessons.show', $lesson->id) }}"
                                           class="btn btn-outline-primary btn-sm">
                                            ✏️ Добавить/изменить задание
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
