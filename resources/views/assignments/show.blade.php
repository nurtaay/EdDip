@extends('layouts.app')

@section('content')
    <h1>Домашнее задание: {{ $assignment->description }}</h1>

    <h2>Отправленные задания</h2>

    @if($submissions->count())
        <table class="table">
            <thead>
            <tr>
                <th>Студент</th>
                <th>Файл</th>
                <th>Дата отправки</th>
                <th>Действия</th>
            </tr>
            </thead>
            <tbody>
            @foreach($submissions as $submission)
                <tr>
                    <td>{{ $submission->student->name }}</td>
                    <td>{{ $submission->video }}</td>
                    <td>{{ $submission->created_at->format('d.m.Y H:i') }}</td>
                    <td>
                        <a href="{{ asset('storage/' . $submission->video) }}" class="btn btn-primary" download>Скачать</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <p>Нет отправленных заданий.</p>
    @endif
@endsection
