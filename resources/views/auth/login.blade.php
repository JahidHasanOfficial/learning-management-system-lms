@extends('frontend.layouts.auth')

@section('title', 'Login')
@section('heading', 'Welcome Back!')

@section('content')
<form method="POST" action="{{ route('login') }}">
    @csrf
    <div class="mb-3">
        <label class="form-label small fw-bold">Email Address</label>
        <div class="input-group">
            <span class="input-group-text bg-light border-0"><i class="fa fa-envelope text-primary small"></i></span>
            <input type="email" name="email" class="form-control border-0 bg-light" placeholder="email@example.com" value="{{ old('email') }}" required autofocus>
        </div>
        @error('email')
            <span class="text-danger small">{{ $message }}</span>
        @enderror
    </div>

    <div class="mb-3">
        <label class="form-label small fw-bold d-flex justify-content-between">
            Password
            <a href="{{ route('password.request') }}" class="text-primary xsmall text-decoration-none fw-normal">Forgot?</a>
        </label>
        <div class="input-group">
            <span class="input-group-text bg-light border-0"><i class="fa fa-lock text-primary small"></i></span>
            <input type="password" name="password" class="form-control border-0 bg-light" placeholder="••••••••" required>
        </div>
        @error('password')
            <span class="text-danger small">{{ $message }}</span>
        @enderror
    </div>

    <div class="mb-4 d-flex align-items-center">
        <div class="form-check small">
            <input type="checkbox" name="remember" class="form-check-input" id="rememberMe">
            <label class="form-check-label text-muted" for="rememberMe">Remember for 30 days</label>
        </div>
    </div>

    <button type="submit" class="btn btn-primary w-100 shadow-sm">Sign In <i class="fa fa-arrow-right ms-2"></i></button>
</form>
@endsection

@section('footer')
<p class="mb-0 text-muted small">Don't have an account? <a href="{{ route('register') }}" class="text-primary fw-bold text-decoration-none">Sign Up</a></p>
@endsection
