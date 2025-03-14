@extends('layouts.app')

@section('content')
    <h1>{{ $lesson->title }}</h1>
    <p>{{ $lesson->content }}</p>

    @if(auth()->user()->isTeacher())
        @if($assignment)
            <h2>Созданное домашнее задание</h2>
            <form action="{{ route('assignments.store', $lesson->id) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="description">Описание задания</label>
                    <textarea name="description" id="description" class="form-control" rows="4"></textarea>
                </div>
                <button type="submit" class="btn btn-primary mt-2">Создать задание</button>
            </form>
            <p>{{ $assignment->description }}</p>
            <a href="{{ route('assignments.show', $assignment->id) }}" class="btn btn-info">Просмотреть отправленные задания</a>
        @else
            <h2>Создать домашнее задание</h2>
            <form action="{{ route('assignments.store', $lesson->id) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="description">Описание задания</label>
                    <textarea name="description" id="description" class="form-control" rows="4"></textarea>
                </div>
                <button type="submit" class="btn btn-primary mt-2">Создать задание</button>
            </form>
        @endif
    @else
        @if($assignment)
            <h2>Домашнее задание</h2>
            <p>{{ $assignment->description }}</p>
            <form action="{{ route('submissions.store', $assignment->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="video">Загрузите выполненное задание (поддерживаются видео, документы, презентации и текстовые файлы)</label>
                    <input type="file" name="video" id="video" class="form-control">
                </div>
                <button type="submit" class="btn btn-success mt-2">Отправить задание</button>
            </form>
        @else
            <p>Домашнее задание пока не создано.</p>
        @endif
    @endif
@endsection
