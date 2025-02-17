@extends('layouts.app')

@section('title', 'Добавить урок')

@section('content')
    <h1 class="mb-4">Добавить урок</h1>
    <form action="{{ route('teacher.lesson.store', $course_id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label class="form-label">Название урока</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Описание</label>
            <textarea name="content" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Видео (MP4, MOV, AVI, WMV)</label>
            <input type="file" name="video" class="form-control" accept="video/*">
        </div>

        <button type="submit" class="btn btn-primary">Добавить</button>
    </form>
@endsection
