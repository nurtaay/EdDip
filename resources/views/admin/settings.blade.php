@extends('layouts.admin')

@section('content')
    <div class="container py-4">
        <h3 class="mb-4">{{ __('admin.settings.site_settings') }}</h3>

        {{-- Блок уведомлений --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="{{ route('admin.settings.update') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label">{{ __('admin.settings.site_name') }}</label>
                <input type="text" name="site_name" value="{{ $settings['site_name'] }}" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">{{ __('admin.settings.support_email') }}</label>
                <input type="email" name="support_email" value="{{ $settings['support_email'] }}" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">{{ __('admin.settings.banner_text') }}</label>
                <textarea name="banner_text" class="form-control">{{ $settings['banner_text'] }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Приветственное сообщение для новых преподавателей</label>
                <textarea name="teacher_welcome_message" class="form-control" rows="6">{{ $settings['teacher_welcome_message'] ?? '' }}</textarea>
                <div class="form-text">Вы можете вставить ссылки, HTML и инструкции. Это сообщение получит преподаватель при подтверждении.</div>
            </div>



            <button class="btn btn-primary">{{ __('admin.settings.save') }}</button>
        </form>
    </div>
@endsection
