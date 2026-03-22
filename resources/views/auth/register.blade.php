@extends('frontend.layouts.auth')

@section('title', 'Create Account')
@section('heading', 'Join Our Platform')

@section('content')
<form method="POST" action="{{ route('register') }}">
    @csrf
    <div class="mb-3">
        <label class="form-label small fw-bold">Full Name</label>
        <div class="input-group">
            <span class="input-group-text bg-light border-0"><i class="fa fa-user text-primary small"></i></span>
            <input type="text" name="name" class="form-control border-0 bg-light" placeholder="John Doe" value="{{ old('name') }}" required autofocus>
        </div>
        @error('name')
            <span class="text-danger small">{{ $message }}</span>
        @enderror
    </div>

    <div class="mb-3">
        <label class="form-label small fw-bold">Email Address</label>
        <div class="input-group">
            <span class="input-group-text bg-light border-0"><i class="fa fa-envelope text-primary small"></i></span>
            <input type="email" name="email" class="form-control border-0 bg-light" placeholder="john@example.com" value="{{ old('email') }}" required>
        </div>
        @error('email')
            <span class="text-danger small">{{ $message }}</span>
        @enderror
    </div>

    <div class="mb-3">
        <label class="form-label small fw-bold">Phone Number</label>
        <div class="input-group">
            <span class="input-group-text bg-light border-0"><i class="fa fa-phone text-primary small"></i></span>
            <input type="text" name="phone" class="form-control border-0 bg-light" placeholder="+01..." value="{{ old('phone') }}" required>
        </div>
        @error('phone')
            <span class="text-danger small">{{ $message }}</span>
        @enderror
    </div>

    <div class="row mb-4">
        <div class="col-6 mb-3 mb-md-0">
            <label class="form-label small fw-bold">Password</label>
            <div class="input-group">
                <span class="input-group-text bg-light border-0"><i class="fa fa-lock text-primary small"></i></span>
                <input type="password" name="password" class="form-control border-0 bg-light px-2" placeholder="••••••••" required>
            </div>
            @error('password')
                <span class="text-danger small">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-6">
            <label class="form-label small fw-bold">Confirm Password</label>
            <div class="input-group">
                <span class="input-group-text bg-light border-0"><i class="fa fa-check text-primary small"></i></span>
                <input type="password" name="password_confirmation" class="form-control border-0 bg-light px-2" placeholder="••••••••" required>
            </div>
        </div>
    </div>

    <button type="submit" class="btn btn-primary w-100 shadow-sm">Sign Up <i class="fa fa-user-plus ms-2"></i></button>
</form>
@endsection

@section('footer')
<p class="mb-0 text-muted small">Already have an account? <a href="{{ route('login') }}" class="text-primary fw-bold text-decoration-none">Sign In</a></p>
@endsection
