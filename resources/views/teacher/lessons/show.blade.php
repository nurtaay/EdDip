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
                        <h5 class="fw-semibold mb-3">📚 {{ __('lesson.assignment_already_created') }}</h5>
                        <p class="mb-3">{{ $assignment->description }}</p>

                        <a href="{{ route('assignments.show', $assignment->id) }}" class="btn btn-outline-primary">
                            {{ __('lesson.view_submissions') }}
                        </a>
                    @else
                        <h5 class="fw-semibold mb-3">📌 {{ __('lesson.create_assignment') }}</h5>

                        <form action="{{ route('assignments.store', $lesson->id) }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">{{ __('lesson.assignment_description') }}</label>
                                <textarea name="description" class="form-control" rows="4" required></textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">{{ __('lesson.deadline') }}</label>
                                <input type="datetime-local" name="deadline" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">{{ __('lesson.max_score') }}</label>
                                <input type="number" name="max_score" class="form-control" value="100" min="1" max="100">
                            </div>

                            <button type="submit" class="btn btn-success">{{ __('lesson.create_assignment_btn') }}</button>
                        </form>
                    @endif
                </div>
            </div>
        @endif

        {{-- === Студент === --}}
        @if(!auth()->user()->isTeacher())
            @if($submission)
                <div class="alert alert-success mb-3">
                    ✅ {{ __('lesson.assignment_already_submitted') }}
                </div>

                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <h6 class="fw-medium">📎 {{ __('lesson.attached_files') }}</h6>
                        <ul class="mb-3">
                            @foreach($submission->files ?? [] as $file)
                                <li>
                                    <a href="{{ asset('storage/' . $file) }}" target="_blank">
                                        {{ basename($file) }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>

                        <p><strong>📅 {{ __('lesson.submission_date') }}:</strong> {{ $submission->created_at->format('d.m.Y H:i') }}</p>

                        @if($submission->grade)
                            <p class="text-primary mt-2">💯 {{ __('lesson.grade') }}: <strong>{{ $submission->grade }} / {{ $assignment->max_score }}</strong></p>
                        @endif

                        @if($submission->comment)
                            <p class="text-muted fst-italic">📝 {{ __('lesson.teacher_comment') }}: {{ $submission->comment }}</p>
                        @endif
                    </div>
                </div>
            @elseif($assignment)
                {{-- Если задание существует, но студент не отправил задание --}}
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="fw-semibold mb-3">📤 {{ __('lesson.submit_assignment') }}</h5>
                        <form action="{{ route('submissions.store', $assignment->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">{{ __('lesson.attach_files') }}</label>
                                <input type="file" name="files[]" multiple class="form-control">
                            </div>
                            <button class="btn btn-primary">{{ __('lesson.submit_btn') }}</button>
                        </form>
                    </div>
                </div>
            @else
                {{-- Если нет созданного задания --}}
                <div class="alert alert-info">
                    📚 {{ __('lesson.no_assignment_yet') }}
                </div>
            @endif
        @endif

    </div>
@endsection
