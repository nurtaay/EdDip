@extends('layouts.app')

@section('content')
    <div class="container py-5 text-center">
        <h1 class="display-4 fw-bold mb-4" style="color: var(--heading-color);">
            {{ __('main.welcome') }}
        </h1>

        <p class="lead text-theme-secondary mb-5">
            {{ __('main.description') }}
        </p>

        <div class="d-flex justify-content-center gap-3 flex-wrap">
            @auth
                <a href="{{ url('/home') }}" class="btn btn-primary btn-lg">
                    {{ __('main.dashboard') }}
                </a>
            @else
                <a href="{{ route('login') }}" class="theme-btn-outline btn-lg" style="width: 80px; text-align: center">
                    {{ __('main.login') }}
                </a>
                <a href="{{ route('register') }}" class="btn btn-primary btn-lg">
                    {{ __('main.register') }}
                </a>
            @endauth
        </div>

        <div class="mt-5">
            {{-- <img src="{{ asset('images/landing-preview.png') }}" class="img-fluid" alt="Preview"> --}}
        </div>
    </div>
@endsection
