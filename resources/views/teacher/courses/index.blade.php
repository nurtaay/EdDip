@extends('layouts.app')

@section('title', 'Мои курсы')

@section('teacher')
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold">Мои курсы</h2>
            <a href="{{ route('teacher.courses.create') }}" class="btn btn-success">
                + Добавить курс
            </a>
        </div>

        <div class="row g-4">
            @foreach($courses as $course)
                <div class="col-md-6 col-lg-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="position-relative">
                            <img src="{{ asset('storage/' . $course->image) }}" class="card-img-top" alt="Курс" style="height: 200px; object-fit: cover;">
                            <div class="position-absolute top-0 start-0 m-2">
                                @if($course->status === 'pending')
                                    <span class="badge bg-warning text-dark">На модерации</span>
                                @elseif($course->status === 'approved')
                                    <span class="badge bg-success">Подтверждён</span>
                                @elseif($course->status === 'rejected')
                                    <span class="badge bg-danger">Отклонён</span>
                                @endif
                            </div>
                        </div>

                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $course->title }}</h5>
                            <p class="text-muted small">{{ Str::limit($course->description, 120) }}</p>
                            <div class="mt-auto d-flex gap-2">
                                <a href="{{ route('teacher.courses.show', $course->id) }}" class="btn btn-outline-primary btn-sm w-100">
                                    Подробнее
                                </a>
                                <a href="{{ route('teacher.lesson.create', $course->id) }}" class="btn btn-outline-secondary btn-sm w-100">
                                    Добавить урок
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
