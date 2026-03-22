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

       <div class="field mt-3">
          <div class="text-center">
             <p>Or sign in with:</p>
             <div class="social_login_buttons d-flex justify-content-center">
                <a href="{{ route('social.redirect', 'google') }}" class="btn btn-outline-danger mx-1"><i class="fa fa-google"></i></a>
                <a href="{{ route('social.redirect', 'facebook') }}" class="btn btn-outline-primary mx-1"><i class="fa fa-facebook"></i></a>
                <a href="{{ route('social.redirect', 'linkedin') }}" class="btn btn-outline-info mx-1"><i class="fa fa-linkedin"></i></a>
             </div>
          </div>
       </div>
    </fieldset>
</form>

@endsection
