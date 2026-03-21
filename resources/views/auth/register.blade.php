@extends('auth.layouts.auth')

@section('title', 'Register')

@section('content')
<form method="POST" action="{{ route('register') }}">
    @csrf
    <fieldset>
       <div class="field">
          <label class="label_field">Full Name</label>
          <input type="text" name="name" placeholder="Full Name" value="{{ old('name') }}" required autofocus autocomplete="name" />
          @error('name')
              <span class="text-danger">{{ $message }}</span>
          @enderror
       </div>
       <div class="field">
          <label class="label_field">Email Address</label>
          <input type="email" name="email" placeholder="E-mail" value="{{ old('email') }}" required autocomplete="username" />
          @error('email')
              <span class="text-danger">{{ $message }}</span>
          @enderror
       </div>
       <div class="field">
          <label class="label_field">Password</label>
          <input type="password" name="password" placeholder="Password" required autocomplete="new-password" />
          @error('password')
              <span class="text-danger">{{ $message }}</span>
          @enderror
       </div>
       <div class="field">
          <label class="label_field">Confirm Password</label>
          <input type="password" name="password_confirmation" placeholder="Confirm Password" required autocomplete="new-password" />
       </div>
       
       <div class="field">
          <label class="label_field hidden">hidden label</label>
          <a class="forgot" href="{{ route('login') }}">Already registered?</a>
       </div>
       
       <div class="field margin_0">
          <label class="label_field hidden">hidden label</label>
          <button class="main_bt">Register</button>
       </div>
    </fieldset>
</form>
@endsection
