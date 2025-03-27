@extends('layouts.app')

@section('title', 'Добавить курс')

@section('content')
    <div class="container py-5">
        <div class="mb-4">
            <h2 class="fw-bold">Создание нового курса</h2>
            <p class="text-muted">Заполните форму ниже, чтобы опубликовать свой курс</p>
        </div>

        <form action="{{ route('teacher.courses.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-4 rounded shadow-sm">
            @csrf

            <div class="mb-3">
                <label class="form-label fw-medium">Название курса</label>
                <input type="text" name="title" class="form-control" placeholder="Например: Введение в Python" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-medium">Описание</label>
                <textarea name="description" class="form-control" rows="4" placeholder="Опишите, чему научится студент..."></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label fw-medium">Цена (₸)</label>
                <input type="number" step="0.01" name="price" class="form-control" placeholder="Например: 4900" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-medium">Категория курса</label>
                <select name="cat_id" class="form-select" required>
                    <option value="" disabled selected>-- Выберите категорию --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="form-label fw-medium">Обложка курса</label>
                <input type="file" name="image" class="form-control" accept="image/*">
                <small class="text-muted">Формат: JPG, PNG. Рекомендуемый размер: 800x600</small>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-success">Создать курс</button>
            </div>
        </form>
    </div>
@endsection
