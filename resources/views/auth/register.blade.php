@extends('layouts.app')

@section('title', __('main.register_title'))

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="theme-surface border-0 shadow-sm rounded">
                    <div class="p-4">
                        <h4 class="mb-4 text-center fw-bold" style="color: var(--heading-color);">{{ __('main.register_heading') }}</h4>

                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="mb-3">
                                <label for="name" class="form-label">{{ __('main.name') }}</label>
                                <input id="name" type="text"
                                       class="form-control theme-input @error('name') is-invalid @enderror"
                                       name="name" value="{{ old('name') }}"
                                       required autocomplete="name" autofocus>
                                @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">{{ __('main.email') }}</label>
                                <input id="email" type="email"
                                       class="form-control theme-input @error('email') is-invalid @enderror"
                                       name="email" value="{{ old('email') }}"
                                       required autocomplete="email">
                                @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">{{ __('main.password') }}</label>
                                <input id="password" type="password"
                                       class="form-control theme-input @error('password') is-invalid @enderror"
                                       name="password" required autocomplete="new-password">
                                @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password-confirm" class="form-label">{{ __('main.password_confirm') }}</label>
                                <input id="password-confirm" type="password"
                                       class="form-control theme-input"
                                       name="password_confirmation"
                                       required autocomplete="new-password">
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-success">
                                    {{ __('main.register') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="text-center mt-3">
                    <small class="text-theme-secondary">
                        {{ __('main.have_account') }}
                        <a href="{{ route('login') }}" style="color: var(--accent-color);">
                            {{ __('main.login') }}
                        </a>
                    </small>
                </div>
            </div>
        </div>
    </div>
@endsection
