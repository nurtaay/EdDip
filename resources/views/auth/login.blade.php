@extends('layouts.app')

@section('title', __('main.login_title'))

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="theme-surface border-0 shadow-sm rounded">
                    <div class="p-4">
                        <h4 class="mb-4 text-center fw-bold" style="color: var(--heading-color);">{{ __('main.login_heading') }}</h4>

                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="mb-3">
                                <label for="email" class="form-label">{{ __('main.email') }}</label>
                                <input id="email" type="email"
                                       class="form-control theme-input @error('email') is-invalid @enderror"
                                       name="email" value="{{ old('email') }}"
                                       required autocomplete="email" autofocus>
                                @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">{{ __('main.password') }}</label>
                                <input id="password" type="password"
                                       class="form-control theme-input @error('password') is-invalid @enderror"
                                       name="password" required autocomplete="current-password">
                                @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 form-check">
                                <input class="form-check-input" type="checkbox" name="remember"
                                       id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">
                                    {{ __('main.remember_me') }}
                                </label>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('main.login') }}
                                </button>
                            </div>

                            @if (Route::has('password.request'))
                                <div class="mt-3 text-center">
                                    <a href="{{ route('password.request') }}" class="small" style="color: var(--accent-color);">
                                        {{ __('main.forgot_password') }}
                                    </a>
                                </div>
                            @endif
                        </form>
                    </div>
                </div>

                <div class="text-center mt-3">
                    <small class="text-theme-secondary">
                        {{ __('main.no_account') }}
                        <a href="{{ route('register') }}" style="color: var(--accent-color);">
                            {{ __('main.register') }}
                        </a>
                    </small>
                </div>
            </div>
        </div>
    </div>
@endsection
