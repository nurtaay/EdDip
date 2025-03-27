@extends('layouts.app')

@section('title', 'Добавить урок')

@section('content')
    <div class="container py-5">

        <!-- Заголовок -->
        <div class="mb-4">
            <h2 class="fw-bold">Новый урок</h2>
            <p class="text-muted">Заполните форму ниже, чтобы добавить новый урок в курс</p>
        </div>

        <!-- Форма -->
        <form action="{{ route('teacher.lesson.store', $course_id) }}" method="POST" enctype="multipart/form-data" class="bg-white p-4 rounded shadow-sm">
            @csrf

            <div class="mb-3">
                <label class="form-label fw-medium">Название урока</label>
                <input type="text" name="title" class="form-control" placeholder="Например: Введение в тему" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-medium">Описание / содержание</label>
                <textarea name="content" class="form-control" rows="4" placeholder="Краткое содержание или план урока..."></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label fw-medium">Видео (MP4, MOV, AVI, WMV)</label>
                <input type="file" name="video" class="form-control" accept="video/*">
                <small class="text-muted">Рекомендуемый формат: MP4. Размер до 500 МБ.</small>
            </div>

            <div class="form-check form-switch mb-4">
                <input class="form-check-input" type="checkbox" name="is_preview" id="is_preview" {{ old('is_preview') ? 'checked' : '' }}>
                <label class="form-check-label" for="is_preview">
                    Сделать урок доступным для всех (превью)
                </label>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-success">Сохранить урок</button>
            </div>
        </form>

    </div>
@endsection
