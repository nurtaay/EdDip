@extends('layouts.app')

@section('content')
    <div class="container py-5">

        <!-- Заголовок урока -->
        <div class="mb-4">
            <h2 class="fw-bold">{{ $lesson->title }}</h2>
            <p class="text-muted">{{ $lesson->content }}</p>
        </div>

        {{-- === Преподаватель === --}}
        @if(auth()->user()->isTeacher())
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body">
                    @if($assignment)
                        <h5 class="fw-semibold mb-3">📚 Домашнее задание уже создано</h5>
                        <p class="mb-3">{{ $assignment->description }}</p>

                        <a href="{{ route('assignments.show', $assignment->id) }}" class="btn btn-outline-primary">
                            Просмотреть отправленные работы
                        </a>
                    @else
                        <h5 class="fw-semibold mb-3">📌 Создать домашнее задание</h5>

                        <form action="{{ route('assignments.store', $lesson->id) }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Описание задания</label>
                                <textarea name="description" class="form-control" rows="4" required></textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Дедлайн</label>
                                <input type="datetime-local" name="deadline" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Максимальный балл</label>
                                <input type="number" name="max_score" class="form-control" value="100" min="1" max="100">
                            </div>

                            <button type="submit" class="btn btn-success">Создать задание</button>
                        </form>
                    @endif
                </div>
            </div>

            {{-- === Студент === --}}
        @else
            @if($submission)
                <div class="alert alert-success mb-3">
                    ✅ Вы уже отправили задание.
                </div>

                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <h6 class="fw-medium">📎 Прикреплённые файлы:</h6>
                        <ul class="mb-3">
                            @foreach($submission->files ?? [] as $file)
                                <li>
                                    <a href="{{ asset('storage/' . $file) }}" target="_blank">
                                        {{ basename($file) }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>

                        <p><strong>📅 Дата отправки:</strong> {{ $submission->created_at->format('d.m.Y H:i') }}</p>

                        @if($submission->grade)
                            <p class="text-primary mt-2">💯 Оценка: <strong>{{ $submission->grade }} / {{ $assignment->max_score }}</strong></p>
                        @endif

                        @if($submission->comment)
                            <p class="text-muted fst-italic">📝 Комментарий преподавателя: {{ $submission->comment }}</p>
                        @endif
                    </div>
                </div>
            @else
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="fw-semibold mb-3">📤 Отправка домашнего задания</h5>
                        <form action="{{ route('submissions.store', $assignment->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Прикрепите файл(ы)</label>
                                <input type="file" name="files[]" multiple class="form-control">
                            </div>
                            <button class="btn btn-primary">Отправить</button>
                        </form>
                    </div>
                </div>
            @endif
        @endif

    </div>
@endsection
