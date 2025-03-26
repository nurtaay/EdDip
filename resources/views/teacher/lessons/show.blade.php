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

                            <div class="mb-3">
                                <label for="deadline" class="form-label">Дедлайн</label>
                                <input type="datetime-local" name="deadline" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="max_score" class="form-label">Максимальный балл</label>
                                <input type="number" name="max_score" class="form-control" value="100" min="1" max="100">
                            </div>

                            <button type="submit" class="btn btn-primary">Создать</button>
                        </form>
                    @endif
                </div>
            </div>
        @else
            {{-- Студент --}}
            @if($submission)
                <div class="alert alert-success mb-3">
                    <strong>✅ Вы уже отправили задание.</strong>
                </div>

                <p><strong>Файлы:</strong><br>
                    @foreach($submission->files ?? [] as $file)
                        <a href="{{ asset('storage/' . $file) }}" target="_blank">
                            {{ basename($file) }}
                        </a><br>
                    @endforeach
                </p>

                <p><strong>Дата отправки:</strong> {{ $submission->created_at->format('d.m.Y H:i') }}</p>

                @if($submission->grade)
                    <p class="mt-2 text-primary">💯 Ваша оценка: <strong>{{ $submission->grade }} / {{ $assignment->max_score }}</strong></p>
                @endif

                @if($submission->comment)
                    <p class="text-muted fst-italic">📝 Комментарий преподавателя: {{ $submission->comment }}</p>
                @endif
            @else
                <form action="{{ route('submissions.store', $assignment->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <label class="form-label">Прикрепите файл(ы)</label>
                    <input type="file" name="files[]" multiple class="form-control mb-3">
                    <button class="btn btn-primary">Отправить</button>
                </form>
            @endif

        @endif {{-- ← это закрытие блока @if(auth()->user()->isTeacher()) --}}
    </div>
@endsection
