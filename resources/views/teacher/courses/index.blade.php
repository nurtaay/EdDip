@extends('layouts.app')

@section('title', __('teacher.index.title'))

@section('teacher')
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold" style="color: var(--heading-color);">{{ __('teacher.index.heading') }}</h2>
            <a href="{{ route('teacher.courses.create') }}" class="btn btn-success">
                {{ __('teacher.index.add_course_btn') }}
            </a>
        </div>

        <div class="row g-4">
            @foreach($courses as $course)
                @if($course->teacher_id === auth()->id())
                    <div class="col-md-6 col-lg-4">
                        <div class="theme-surface shadow-sm h-100 rounded overflow-hidden d-flex flex-column">
                            <div class="position-relative">
                                <img src="{{ asset('storage/' . $course->image) }}"
                                     class="w-100"
                                     alt="{{ __('teacher.index.title') }}"
                                     style="height: 200px; object-fit: cover;">

                                <div class="position-absolute top-0 start-0 m-2">
                                    @if($course->status === 'pending')
                                        <span class="badge bg-warning text-dark">{{ __('teacher.index.status.pending') }}</span>
                                    @elseif($course->status === 'approved')
                                        <span class="badge bg-success">{{ __('teacher.index.status.approved') }}</span>
                                    @elseif($course->status === 'rejected')
                                        <span class="badge bg-danger">{{ __('teacher.index.status.rejected') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="p-4 d-flex flex-column flex-grow-1">
                                <h5 class="fw-bold mb-2" style="color: var(--heading-color);">{{ $course->title }}</h5>
                                <p class="text-theme-secondary small mb-3">{{ Str::limit($course->description, 120) }}</p>

                                <div class="mt-auto d-flex gap-2">
                                    <a href="{{ route('teacher.courses.show', $course->id) }}"
                                       class="theme-btn-outline btn-sm w-100">
                                        {{ __('teacher.index.details_btn') }}
                                    </a>
                                    <a href="{{ route('teacher.lesson.create', $course->id) }}"
                                       class="theme-btn-outline btn-sm w-100">
                                        {{ __('teacher.index.add_lesson_btn') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
@endsection
