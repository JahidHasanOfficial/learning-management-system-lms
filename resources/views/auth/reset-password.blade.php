@extends('auth.layouts.auth')

@section('title', 'Reset Password')

@section('content')
<form method="POST" action="{{ route('password.store') }}">
    @csrf
    <!-- Password Reset Token -->
    <input type="hidden" name="token" value="{{ $request->route('token') }}">

    <fieldset>
       <div class="field">
          <label class="label_field">Email Address</label>
          <input type="email" name="email" placeholder="E-mail" value="{{ old('email', $request->email) }}" required autofocus autocomplete="username" />
          @error('email')
              <span class="text-danger">{{ $message }}</span>
          @enderror
       </div>
       <div class="field">
          <label class="label_field">New Password</label>
          <input type="password" name="password" placeholder="New Password" required autocomplete="new-password" />
          @error('password')
              <span class="text-danger">{{ $message }}</span>
          @enderror
       </div>
       <div class="field">
          <label class="label_field">Confirm Password</label>
          <input type="password" name="password_confirmation" placeholder="Confirm Password" required autocomplete="new-password" />
       </div>
       
       <div class="field margin_0">
          <label class="label_field hidden">hidden label</label>
          <button class="main_bt">Reset Password</button>
       </div>
    </fieldset>
</form>
@endsection
