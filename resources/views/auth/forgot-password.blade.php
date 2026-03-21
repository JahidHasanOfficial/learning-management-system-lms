@extends('auth.layouts.auth')

@section('title', 'Forgot Password')

@section('content')
<div class="mb-4 text-sm text-gray-600">
    {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link.') }}
</div>

<!-- Session Status -->
<x-auth-session-status class="mb-4" :status="session('status')" />

<form method="POST" action="{{ route('password.email') }}">
    @csrf
    <fieldset>
       <div class="field">
          <label class="label_field">Email Address</label>
          <input type="email" name="email" placeholder="E-mail" value="{{ old('email') }}" required autofocus />
          @error('email')
              <span class="text-danger">{{ $message }}</span>
          @enderror
       </div>
       
       <div class="field margin_0">
          <label class="label_field hidden">hidden label</label>
          <button class="main_bt">Email Password Reset Link</button>
       </div>
    </fieldset>
</form>
@endsection
