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
                        <tr>
                            <td>{{ $submission->student->name }}</td>
                            <td>
                                @foreach($submission->files as $file)
                                    <a href="{{ asset('storage/' . $file) }}" target="_blank">Файл</a><br>
                                @endforeach
                            </td>
                            <td>
                                @if($submission->created_at > $assignment->deadline)
                                    <span class="text-danger">Просрочено</span>
                                @else
                                    <span class="text-success">Вовремя</span>
                                @endif
                            </td>
                            <td>
                                <form action="{{ route('assignment.grade', $submission->id) }}" method="POST">
                                    @csrf
                                    <input type="number" name="grade" value="{{ $submission->grade }}" class="form-control" min="0" max="100">
                                    <button class="btn btn-sm btn-success mt-2">Сохранить</button>
                                </form>
                            </td>
                        </tr>
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
