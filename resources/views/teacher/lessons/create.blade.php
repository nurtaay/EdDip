@extends('layouts.app')

@section('title', __('lesson.add_lesson')) {{-- create.blade --}}

@section('content')
    <div class="container py-5">

        <!-- Заголовок -->
        <div class="mb-4">
            <h2 class="fw-bold">{{ __('lesson.new_lesson') }}</h2>
            <p class="text-muted">{{ __('lesson.fill_form_to_add') }}</p>
        </div>

        <!-- Форма -->
        <form action="{{ route('teacher.lesson.store', $course_id) }}" method="POST" enctype="multipart/form-data" class="bg-white p-4 rounded shadow-sm">
            @csrf

            <div class="mb-3">
                <label class="form-label fw-medium">{{ __('lesson.lesson_title') }}</label>
                <input type="text" name="title" class="form-control" placeholder="{{ __('lesson.title_placeholder') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-medium">{{ __('lesson.lesson_content') }}</label>
                <textarea name="content" class="form-control" rows="4" placeholder="{{ __('lesson.content_placeholder') }}"></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label fw-medium">{{ __('lesson.lesson_video') }}</label>
                <input type="file" name="video" class="form-control" accept="video/*">
                <small class="text-muted">{{ __('lesson.video_format_info') }}</small>
            </div>

            <div class="form-check form-switch mb-4">
                <input class="form-check-input" type="checkbox" name="is_preview" id="is_preview" {{ old('is_preview') ? 'checked' : '' }}>
                <label class="form-check-label" for="is_preview">
                    {{ __('lesson.preview_toggle') }}
                </label>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-success">{{ __('lesson.save_lesson') }}</button>
            </div>
        </form>

    </div>
@endsection
