@extends('layouts.app')

@section('title', 'Добавить задание')

@section('content')
    <h1 class="mb-4">Добавить задание</h1>
    <form action="{{ route('teacher.task.store', $lesson_id) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Текст задания</label>
            <textarea name="task_text" class="form-control" required></textarea>
        </div>

        <button type="submit" class="btn btn-success">Добавить</button>
    </form>
@endsection
