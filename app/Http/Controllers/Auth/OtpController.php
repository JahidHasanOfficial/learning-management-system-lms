<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OtpController extends Controller
{
    public function showVerifyForm(Request $request)
    {
        $email = $request->email;
        return view('auth.verify-otp', compact('email'));
    }

    public function verify(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|string|size:6',
        ]);

        $user = User::where('email', $request->email)
            ->where('otp_code', $request->otp)
            ->where('otp_expires_at', '>', now())
            ->first();

        if (!$user) {
            return back()->withErrors(['otp' => 'Invalid or expired OTP.']);
        }

        // Clear OTP and activate user
        $user->update([
            'otp_code' => null,
            'otp_expires_at' => null,
            'email_verified_at' => now(), // Assume email verified if OTP is correct
            'phone_verified_at' => now(),
            'status' => 'active',
        ]);

        Auth::login($user);

        return redirect()->route('dashboard')->with('success', 'Account verified successfully.');
    }

    public function resend(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->with('error', 'User not found.');
        }

        $otp = rand(100000, 999999);
        $user->update([
            'otp_code' => $otp,
            'otp_expires_at' => now()->addMinutes(10),
        ]);

        // In production, send SMS/Email
        \Log::info("Resent OTP for {$user->email}: {$otp}");

        return back()->with('status', 'A new OTP has been sent.');
    }
}
