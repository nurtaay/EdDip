@extends('layouts.app')

@section('title', __('teacher.create.title'))

@section('content')
    <div class="container py-5">
        <div class="mb-4">
            <h2 class="fw-bold" style="color: var(--heading-color);">{{ __('teacher.create.heading') }}</h2>
            <p class="text-theme-secondary">{{ __('teacher.create.description') }}</p>
        </div>

        <form action="{{ route('teacher.courses.store') }}"
              method="POST"
              enctype="multipart/form-data"
              class="theme-surface p-4 rounded shadow-sm">
            @csrf

            <div class="mb-3">
                <label class="form-label fw-medium">{{ __('teacher.create.course_name') }}</label>
                <input type="text" name="title" class="form-control theme-input"
                       placeholder="{{ __('teacher.create.course_name_placeholder') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-medium">{{ __('teacher.create.description_label') }}</label>
                <textarea name="description" class="form-control theme-input" rows="4"
                          placeholder="{{ __('teacher.create.description_placeholder') }}"></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label fw-medium">{{ __('teacher.create.price') }}</label>
                <input type="number" step="0.01" name="price" class="form-control theme-input"
                       placeholder="{{ __('teacher.create.price_placeholder') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-medium">{{ __('teacher.create.category') }}</label>
                <select name="cat_id" class="form-select theme-input" required>
                    <option value="" disabled selected>{{ __('teacher.create.category_placeholder') }}</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="form-label fw-medium">{{ __('teacher.create.image') }}</label>
                <input type="file" name="image" class="form-control theme-input" accept="image/*">
                <small class="text-theme-secondary">{{ __('teacher.create.image_hint') }}</small>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-success">
                    {{ __('teacher.create.submit_btn') }}
                </button>
            </div>
        </form>
    </div>
@endsection
