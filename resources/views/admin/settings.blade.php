@extends('layouts.admin')
@section('content')
    <div class="container py-4">
        <h3 class="mb-4">Настройки сайта</h3>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('admin.settings.update') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label">Название сайта</label>
                <input type="text" name="site_name" value="{{ $settings['site_name'] }}" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Email поддержки</label>
                <input type="email" name="support_email" value="{{ $settings['support_email'] }}" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Текст баннера / уведомления</label>
                <textarea name="banner_text" class="form-control">{{ $settings['banner_text'] }}</textarea>
            </div>

            <button class="btn btn-primary">Сохранить</button>
        </form>
    </div>
@endsection
