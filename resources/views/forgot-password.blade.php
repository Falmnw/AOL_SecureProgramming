@extends('layout.master')
@section('title', 'Forgot password')

@section('content')
    <div class="login-container">
        <div class="login-card">
            <div class="card-accent"></div>

            <div class="login-header">
                <div class="logo">
                    <img src="{{ asset('assets/images/logo-apk-simple.png') }}" alt="logo apk simple" class="logo-apk">
                </div>
                <h1>Forgot password?</h1>
                <p>Input email to reset your password</p>
            </div>

            <form class="forgotpasswordform" id="forgotpasswordform" novalidate>
                <div class="form-field">
                    <input type="password" id="email" name="email" required autocomplete="email">
                    <label for="email">Email Address</label>
                    <div class="field-line"></div>
                    <span class="error-message" id="emailError"></span>
                </div>

                <button type="submit" class="signin-button">
                    <span class="button-text">Send email</span>
                    <div class="button-loader">
                        <div class="loader-circle"></div>
                    </div>
                </button>
            </form>

            <div class="success-state" id="successMessage">
                <div class="success-visual">
                    <svg width="40" height="40" viewBox="0 0 40 40" fill="none">
                        <circle cx="20" cy="20" r="20" fill="url(#successGradient)"/>
                        <path d="M12 20l6 6 10-10" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <defs>
                            <linearGradient id="successGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                                <stop offset="0%" stop-color="#4ECDC4"/>
                                <stop offset="100%" stop-color="#44A08D"/>
                            </linearGradient>
                        </defs>
                    </svg>
                </div>
                <h3>Welcome back!</h3>
                <p>Taking you to your creative dashboard...</p>
            </div>
        </div>
    </div>

    <script src="../../shared/js/form-utils.js"></script>
    <script src="{{ asset('assets/js/script-forgotpassword.js') }}"></script>
@endsection
