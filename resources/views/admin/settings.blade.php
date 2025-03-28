@extends('layouts.admin')

@section('content')
    <div class="container py-4">
        <h3 class="mb-4">{{ __('admin.settings.site_settings') }}</h3>

        @if(session('success'))
            <div class="alert alert-success">{{ __('admin.settings.success_updated') }}</div>
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

            <button class="btn btn-primary">{{ __('admin.settings.save') }}</button>
        </form>
    </div>
@endsection
