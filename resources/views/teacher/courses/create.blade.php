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

            <div class="mb-3">
                <label class="form-label fw-medium">{{ __('teacher.create.difficulty') }}</label>
                <select name="difficulty" class="form-select theme-input">
                    <option value="" disabled selected>{{ __('teacher.create.difficulty_placeholder') }}</option>
                    <option value="новичок">{{ __('teacher.create.level_beginner') }}</option>
                    <option value="средний">{{ __('teacher.create.level_intermediate') }}</option>
                    <option value="продвинутый">{{ __('teacher.create.level_advanced') }}</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label fw-medium">{{ __('teacher.create.duration') }}</label>
                <input type="text" name="duration" class="form-control theme-input"
                       placeholder="{{ __('teacher.create.duration_placeholder') }}">
            </div>

            <div class="mb-3">
                <label class="form-label fw-medium">{{ __('teacher.create.requirements') }}</label>
                <textarea name="requirements" class="form-control theme-input" rows="2"
                          placeholder="{{ __('teacher.create.requirements_placeholder') }}"></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label fw-medium">{{ __('teacher.create.skills') }}</label>
                <input type="text" name="skills" class="form-control theme-input"
                       placeholder="Например: Python, Excel, Git">
                <small class="text-theme-secondary">Перечислите навыки через запятую</small>

            </div>
            @if($skills->count())
                <div class="mb-4">
                    <label class="form-label fw-medium">{{ __('teacher.create.suggested_skills') }}</label>
                    <div id="suggested-skills">
                        @foreach($skills as $skill)
                            <button type="button" class="btn btn-outline-secondary btn-sm rounded-pill me-1 mb-2 suggested-skill">
                                {{ $skill->name }}
                            </button>
                        @endforeach
                    </div>
                </div>
            @endif


            <div class="form-check form-switch mb-4">
                <input class="form-check-input" type="checkbox" name="is_certified" id="is_certified" value="1">
                <label class="form-check-label" for="is_certified">{{ __('teacher.create.is_certified') }}</label>
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
