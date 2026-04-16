@extends('layouts.email')

@section('content')
<div class="email-container">
    <div class="email-header">
        <div class="logo-container">
            <p style="font-size: 24px;">StoqFlow</p>
            <p style="font-size: 14px;">by romansofts</p>
        </div>
    </div>
    <div class="email-body">
        <h1>Welcome to StoqFlow ⚡</h1>
        <p> You're about to experience the power of having all your business data in one place. Simplify operations, track sales, and manage your inventory with ease.</p>

        <a href="{{ $verificationUrl }}" class="btn" style="background-color:#1a3c6e; color:#fff; padding:12px 24px; border-radius:6px; text-decoration:none;">
            Activate Your StoqFlow Account 🚀
        </a>

        <p style="font-size: 14px; color: #64748b;">Please verify your email within 24 hours to complete your registration.</p>

        <p>Thank you for choosing StoqFlow. We’re excited to have you on board!</p>
    </div>
    <div class="email-footer">
        <p>If you did not request this account, please disregard this email.</p>
        <div class="separator"></div>

        <p>&copy; {{ date('Y') }} StoqFlow by romansofts. All rights reserved.</p>
        <div class="contact-info">
            <p>StoqFlow | Tanzania, Dar es Salaam | <a href="mailto:support@stoqflow.romansofts.co.tz" style="color: #1a3c6e; text-decoration: none;">support@stoqflow.romansofts.co.tz</a></p>
            <p><a href="https://romansofts.co.tz" style="color: #76c417; text-decoration: none;">romansofts</a> | <a href="https://stoqflow.romansofts.co.tz" style="color: #000000; text-decoration: none;">StoqFlow</a></p>
        </div>
    </div>
</div>
@endsection
