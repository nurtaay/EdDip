@extends('layouts.app')

@section('title', $course->title)

@section('content')
    <h1 class="mb-4">{{ $course->title }}</h1>
    <p>{{ $course->description }}</p>

    <h3 class="mt-4">Уроки</h3>
    <ul class="list-group">
        @foreach($course->lessons as $lesson)
            <li class="list-group-item">
                <h5>{{ $lesson->title }}</h5>
                <p>{{ $lesson->content }}</p>
                @if ($lesson->video)
                    <video width="100%" controls>
                        <source src="{{ asset('storage/' . $lesson->video) }}" type="video/mp4">
                        Ваш браузер не поддерживает видео.
                    </video>
                @endif
            </li>
        @endforeach
    </ul>
@endsection
