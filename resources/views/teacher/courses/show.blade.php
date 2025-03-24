@extends('layouts.app')

@section('title', $course->title)

@section('content')

    <!-- Page Title -->
    <div class="page-title" data-aos="fade">
        <div class="heading">
            <div class="container">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-lg-8">
                        <h1>{{ $course->title }}</h1>
                        <p class="mb-0">{{ Str::limit($course->description, 150) }}</p>
                    </div>
                </div>
            </div>
        </div>
        <nav class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li class="current">Course Details</li>
                </ol>
            </div>
        </nav>
    </div><!-- End Page Title -->

    <!-- Courses Course Details Section -->
    <section id="courses-course-details" class="courses-course-details section">
        <div class="container" data-aos="fade-up">
            <div class="row">
                <div class="col-lg-8">
                    <img src="{{ asset('storage/' . $course->image) }}" class="img-fluid rounded" alt="{{ $course->title }}">
                    <h3 class="mt-4">{{ $course->title }}</h3>
                    <p>{{ $course->description }}</p>
                </div>

                <div class="col-lg-4">
                    <div class="course-info d-flex justify-content-between align-items-center">
                        <h5>Trainer</h5>
                        <p><a href="#">{{ $course->user->name ?? 'Unknown' }}</a></p>
                    </div>

                    <div class="course-info d-flex justify-content-between align-items-center">
                        <h5>Course Fee</h5>
                        <p>{{ $course->price }} ₸</p>
                    </div>

                    <div class="course-info d-flex justify-content-between align-items-center">
                        <h5>Category</h5>
                        <p>{{ $course->category->name ?? 'Без категории' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- /Courses Course Details Section -->

    <!-- Tabs Section -->
    <section id="tabs" class="tabs section">
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row">
                <!-- Tab Nav -->
                <div class="col-lg-3">
                    <ul class="nav nav-tabs flex-column" role="tablist">
                        @foreach($course->lessons as $index => $lesson)
                            <li class="nav-item" role="presentation">
                                <button class="nav-link {{ $index === 0 ? 'active' : '' }}" data-bs-toggle="tab"
                                        data-bs-target="#lesson-{{ $lesson->id }}" type="button" role="tab">
                                    {{ $lesson->title }}
                                </button>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Tab Content -->
                <div class="col-lg-9 mt-4 mt-lg-0">
                    <div class="tab-content">
                        @foreach($course->lessons as $index => $lesson)
                            <div class="tab-pane fade {{ $index === 0 ? 'show active' : '' }}" id="lesson-{{ $lesson->id }}" role="tabpanel">
                                <div class="row align-items-start g-4">
                                    <!-- Video -->
                                    @if ($lesson->video)
                                        <div class="col-md-5">
                                            <video width="100%" height="auto" controls class="rounded shadow-sm">
                                                <source src="{{ asset('storage/' . $lesson->video) }}" type="video/mp4">
                                                Ваш браузер не поддерживает видео.
                                            </video>
                                        </div>
                                    @endif

                                    <!-- Content -->
                                    <div class="{{ $lesson->video ? 'col-md-7' : 'col-12' }}">
                                        <h4 class="mb-3">{{ $lesson->title }}</h4>
                                        <p class="fst-italic text-muted">{{ Str::limit(strip_tags($lesson->content), 100) }}</p>
                                        <div class="lesson-content">
                                            {!! nl2br(e($lesson->content)) !!}
                                        </div>
                                    </div>
                                    {{-- Ссылка: Только для преподавателя --}}
{{--                                    @if(auth()->check() && auth()->user()->role === 'teacher')--}}
                                        <a href="{{ route('lessons.show', $lesson->id) }}" class="btn btn-sm btn-outline-secondary mt-3">
                                            create homework
                                        </a>
{{--                                    @endif--}}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </section>


@endsection
