@extends('auth.layouts.auth')

@section('title', 'Verify OTP')

@section('content')
<div class="login_form">
    <h3>OTP Verification</h3>
    <p>Please enter the 6-digit code sent to your email/phone.</p>
    
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('otp.verify.submit') }}">
        @csrf
        <input type="hidden" name="email" value="{{ request('email') }}">
        <fieldset>
            <div class="field">
                <label class="label_field">OTP Code</label>
                <input type="text" name="otp" placeholder="6-digit code" maxlength="6" required autofocus />
                @error('otp')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="field margin_0">
                <label class="label_field hidden">hidden label</label>
                <button class="main_bt">Verify OTP</button>
            </div>

            <div class="field mt-3">
                <a href="{{ route('otp.resend', ['email' => request('email')]) }}">
                    Resend Code
                </a>
            </div>
        </fieldset>
    </form>
</div>
@endsection
