<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class SocialAuthController extends Controller
{
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        try {
            $socialUser = Socialite::driver($provider)->user();
        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Social login failed.');
        }

        $user = User::where('email', $socialUser->getEmail())->first();

        if ($user) {
            $user->update([
                'provider' => $provider,
                'provider_id' => $socialUser->getId(),
            ]);
        } else {
            $user = User::create([
                'name' => $socialUser->getName() ?? $socialUser->getNickname(),
                'email' => $socialUser->getEmail(),
                'provider' => $provider,
                'provider_id' => $socialUser->getId(),
                'password' => bcrypt(Str::random(16)),
                'email_verified_at' => now(),
                'status' => 'active',
            ]);
            $user->assignRole('Student');
        }

        Auth::login($user);

        return redirect()->route('dashboard');
    }
}
