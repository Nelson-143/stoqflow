<?php

namespace app\Http\Controllers\Auth;

use app\Http\Controllers\Controller;
use app\Models\EmailVerification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\auth\VerifyEmail;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class EmailVerificationController extends Controller
{
    /**
     * Show the email verification form.
     */// Show the email verification notice
    public function showVerificationForm()
    {
        Log::info('Showing email verification form.');

        return view('auth.emails.verify-email');
    }

    // Handle email verification
    public function verify($token)
    {
        Log::info('Verifying email with token: '.$token);

        // Find the email verification record
        $verification = EmailVerification::where('token', $token)->first();

        if (!$verification) {
            Log::warning('Invalid verification token.');

            return redirect()->route('login')->with('error', 'Invalid verification token.');
        }

        // Check if the token has expired
        if (Carbon::now()->gt($verification->expires_at)) {
            Log::warning('Verification token has expired.');

            return redirect()->route('login')->with('error', 'Verification token has expired.');
        }

        // Find the user
        $user = User::find($verification->user_id);

        if (!$user) {
            Log::warning('User not found.');

            return redirect()->route('login')->with('error', 'User not found.');
        }

        // Mark the user's email as verified
        $user->email_verified_at = Carbon::now();
        $user->save();

        Log::info('Email verified successfully.');

        // Delete the verification record
        $verification->delete();

        // Redirect to the dashboard with a success message
        return redirect()->route('dashboard')->with('status', 'Email verified successfully!');
    }

    // Resend the verification email
    public function resendVerification(Request $request)
    {
        $user = $request->user();

        Log::info('Resending verification email for user: '.$user->email);

        // Generate a new verification token
        $token = Str::random(64);
        EmailVerification::updateOrCreate(
            ['email' => $user->email],
            [
                'user_id' => $user->id,
                'token' => $token,
                'expires_at' => Carbon::now()->addHours(24),
            ]
        );

        // Send the verification email
        $verificationUrl = route('verification.verify', ['token' => $token]);
        Mail::to($user->email)->send(new VerifyEmail($verificationUrl));

        Log::info('Verification email resent. Please check your inbox.');

        return redirect()->back()->with('status', 'Verification email resent. Please check your inbox.');


    }
}
