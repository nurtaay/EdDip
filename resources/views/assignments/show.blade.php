@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="mb-5">
            <h2 class="fw-bold">{{ $assignment->title ?? 'Домашнее задание' }}</h2>
            <p class="text-muted fs-5">{{ $assignment->description }}</p>
        </div>

        <div class="bg-white p-4 rounded shadow-sm">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="mb-0">Отправленные работы</h4>
                <span class="text-muted small">{{ $submissions->count() }} {{ Str::plural('запись', $submissions->count()) }}</span>
            </div>

            @if($submissions->count())
                <ul class="list-group list-group-flush">
                    @foreach($submissions as $submission)
                        <li class="list-group-item py-3 px-0">
                            <div class="d-flex justify-content-between align-items-start flex-wrap">
                                <div>
                                    <strong>{{ $submission->student->name }}</strong>
                                    <p class="mb-1 small text-muted">
                                        Отправлено: {{ $submission->created_at->format('d.m.Y H:i') }}
                                    </p>
                                    <a href="{{ asset('storage/' . $submission->video) }}" target="_blank" class="text-decoration-none">
                                        {{ basename($submission->video) }}
                                    </a>
                                </div>
                                <div>
                                    <a href="{{ asset('storage/' . $submission->video) }}" class="btn btn-outline-primary btn-sm" download>
                                        Скачать
                                    </a>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @else
                <div class="alert alert-info mb-0">
                    На данный момент нет отправленных заданий.
                </div>
            @endif
        </div>
    </div>
@endsection
