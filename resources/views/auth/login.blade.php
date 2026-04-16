@extends('layouts.auth')

@section('content')
<div class="card card-md">
    <div class="card-body">
        <h2 class="h2 text-center mb-4">
            Welcome Back
        </h2>
        <form action="{{ route('login') }}" method="POST" autocomplete="off">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">
                    Email address
                </label>
                <input type="email"
                       name="email"
                       id="email"
                       class="form-control @error('email') is-invalid @enderror"
                       placeholder="you@example.com"
                       autocomplete="off"
                       value="{{ old('email') }}"
                >

                @error('email')
                    <div class="invalid-feedback">s
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-2">
                <label for="password" class="form-label">
                    Password
                </label>

                <div class="input-group input-group-flat">
                    <input type="password"
                           name="password"
                           id="password"
                           class="form-control @error('password') is-invalid @enderror"
                           placeholder="Your password"
                           autocomplete="off"
                    >

                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="mb-2">
                <label for="remember" class="form-check">
                    <input type="checkbox" id="remember" name="remember" class="form-check-input"/>
                    <span class="form-check-label">Keep me signed in on this device</span>
                </label>
            </div>

            <div class="form-footer">
                <button type="submit" class="btn btn-primary w-100">
                    Sign in
                </button>
            </div>
        </form>
    </div>
</div>
<div class="text-center text-secondary mt-3">
    New to StoqFlow? <a href="{{ route('register') }}" tabindex="-1">
        Sign up
    </a>

    <span class="form-label-description">
        <a href="{{ route('password.request') }}">Forgot your password?</a>
    </span>
</div>
@endsection
