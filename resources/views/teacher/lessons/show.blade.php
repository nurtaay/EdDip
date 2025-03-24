@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="mb-4">
            <h2 class="fw-bold">{{ $lesson->title }}</h2>
            <p class="text-muted">{{ $lesson->content }}</p>
        </div>

        {{-- Преподаватель --}}
        @if(auth()->user()->isTeacher())
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    @if($assignment)
                        <h5 class="card-title mb-3">Домашнее задание уже создано</h5>
                        <p class="mb-3">{{ $assignment->description }}</p>

                        <a href="{{ route('assignments.show', $assignment->id) }}" class="btn btn-outline-primary">
                            Просмотреть отправленные работы
                        </a>
                    @else
                        <h5 class="card-title mb-3">Создать домашнее задание</h5>
                        <form action="{{ route('assignments.store', $lesson->id) }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="description" class="form-label">Описание задания</label>
                                <textarea name="description" id="description" class="form-control" rows="4" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Создать</button>
                        </form>
                    @endif
                </div>
            </div>
        @else
            {{-- Студент --}}
            @if($assignment)
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <h5 class="card-title mb-3">Домашнее задание</h5>
                        <p class="mb-3">{{ $assignment->description }}</p>

                        @if($submission)
                            <div class="alert alert-success">
                                Вы уже отправили задание.
                            </div>
                            <p><strong>Файл:</strong>
                                <a href="{{ asset('storage/' . $submission->file) }}" target="_blank">
                                    {{ basename($submission->file) }}
                                </a>
                            </p>
                            <p><strong>Дата отправки:</strong> {{ $submission->created_at->format('d.m.Y H:i') }}</p>
                        @else
                            <form action="{{ route('submissions.store', $assignment->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="video" class="form-label">Загрузите выполненное задание</label>
                                    <input type="file" name="video" id="video" class="form-control" required>
                                    <div class="form-text">Поддерживаются видео, документы, презентации, текстовые файлы</div>
                                </div>
                                <button type="submit" class="btn btn-success">Отправить</button>
                            </form>
                        @endif
                    </div>
                </div>
            @else
                <div class="alert alert-info">
                    Домашнее задание пока не создано.
                </div>
            @endif
        @endif {{-- ← это закрытие блока @if(auth()->user()->isTeacher()) --}}
    </div>
@endsection
