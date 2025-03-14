@extends('layouts.app')

@section('styles')
    <style>
        .course {
            border: 1px solid #ccc;
            margin-bottom: 20px;
            padding: 10px;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        .course h2 {
            margin: 0 0 10px;
            font-size: 1.5em;
            color: #333;
        }

        .lessons {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .lessons li {
            padding: 5px 0;
            border-bottom: 1px solid #eee;
        }

        .lessons li:last-child {
            border-bottom: none;
        }
    </style>
@endsection

@section('content')
    <div class="row">
        @foreach($courses as $course)
            <div class="col-md-4">
                <div class="card mb-4">
                    <img src="{{ asset('storage/' . $course->image) }}" class="card-img-top" alt="Курс">
                    <div class="card-body">
                        <h5 class="card-title">{{ $course->title }}</h5>
                        <p class="card-text">{{ $course->description }}</p>
                        <a href="{{ route('teacher.courses.show', $course->id) }}" class="btn btn-primary">Подробнее</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
