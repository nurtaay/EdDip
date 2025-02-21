@extends('layouts.app')

@section('title', 'Мои курсы')

@section('content')
    <h1 class="mb-4">Мои курсы</h1>
    <a href="{{ route('teacher.courses.create') }}" class="btn btn-success mb-3">Добавить курс</a>

    <div class="row">
        @foreach($courses as $course)
            <div class="col-md-4">
                <div class="card mb-4">
                    <img src="{{ asset('storage/' . $course->image) }}" class="card-img-top" alt="Курс">
                    <div class="card-body">
                        <h5 class="card-title">{{ $course->title }}</h5>
                        <p class="card-text">{{ $course->description }}</p>
                        <a href="{{ route('teacher.courses.show', $course->id) }}" class="btn btn-primary">Подробнее</a>
                        <a href="{{ route('teacher.lesson.create', $course->id) }}" class="btn btn-primary">Добавить урок</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
