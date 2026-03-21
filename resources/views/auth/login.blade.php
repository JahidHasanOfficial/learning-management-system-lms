@extends('auth.layouts.auth')

@section('title', 'Login')

@section('content')
<form method="POST" action="{{ route('login') }}">
    @csrf
    <fieldset>
       <div class="field">
          <label class="label_field">Email Address</label>
          <input type="email" name="email" placeholder="E-mail" value="{{ old('email') }}" required autofocus />
          @error('email')
              <span class="text-danger">{{ $message }}</span>
          @enderror
       </div>
       <div class="field">
          <label class="label_field">Password</label>
          <input type="password" name="password" placeholder="Password" value="password" required autocomplete="current-password" />
          @error('password')
              <span class="text-danger">{{ $message }}</span>
          @enderror
       </div>
       <div class="field">
          <label class="label_field hidden">hidden label</label>
          <label class="form-check-label">
             <input type="checkbox" name="remember" class="form-check-input"> Remember Me
          </label>
          @if (Route::has('password.request'))
              <a class="forgot" href="{{ route('password.request') }}">Forgotten Password?</a>
          @endif
       </div>
       <div class="field margin_0">
          <label class="label_field hidden">hidden label</label>
          <button class="main_bt">Sign In</button>
       </div>
    </fieldset>
</form>
@endsection
