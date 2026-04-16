@extends('layouts.auth')

@section('content')
<div class="text-center">
    <div class="my-5">
        <p class="fs-h3 text-secondary">
            {{ __('Welcome to StoqFlow. Before you get started, please verify your email address using the link we just sent you. If it did not arrive, we can send another one.') }}
        </p>
    </div>
</div>

{{-- Display success or error messages --}}
@if (session('status') == 'verification-link-sent')
    <div class="alert alert-success" role="alert">
        {{ __('A new verification link has been sent to your email address.') }}
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger" role="alert">
        {{ $errors->first() }}
    </div>
@endif

{{-- Resend verification email --}}
<form action="{{ route('verification.send') }}" method="POST" autocomplete="off">
    @csrf
    <button type="submit" class="btn btn-primary w-100">
        {{ __('Resend verification email') }}
    </button>
</form>

{{-- Log out button --}}
<form action="{{ route('logout') }}" method="POST" autocomplete="off" class="mt-4">
    @csrf
    <button type="submit" class="btn btn-secondary w-100">
        {{ __('Log out') }}
    </button>
</form>
@endsection
