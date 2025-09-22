@extends('layout.master')
@section('title', 'Register')

@section('content')
    <div class="login-container">
        <div class="login-card">
            <div class="card-accent"></div>

            <div class="login-header">
                <div class="logo">
                    <img src="{{ asset('assets/images/logo-apk-simple.png') }}" alt="logo apk simple" class="logo-apk">
                </div>
                <h1>Register</h1>
                <p>Register new account</p>
            </div>

            <form action="{{ route('register.post') }}" class="register-form" id="registerForm" novalidate method="post">
                @csrf
                <div class="form-field">
                    <input type="number" id="nim" name="nim" required autocomplete="nim" value="{{ old('nim') }}">
                    <label for="nim">NIM</label>
                    <div class="field-line"></div>
                    <span class="error-message" id="nimError">
                        @if($errors->has('nim'))
                            {{ $errors->first('nim') }}
                        @endif
                    </span>
                </div>

                 <div class="form-field">
                    <input type="text" id="name" name="name" required autocomplete="name" value="{{ old('name') }}">
                    <label for="name">Nama</label>
                    <div class="field-line"></div>
                    <span class="error-message" id="nameError">
                        @if($errors->has('name'))
                            {{ $errors->first('name') }}
                        @endif
                    </span>
                </div>

                <div class="form-field">
                    <input type="text" id="daerah" name="daerah" required autocomplete="daerah" value="{{ old('daerah') }}">
                    <label for="daerah">Daerah</label>
                    <div class="field-line"></div>
                    <span class="error-message" id="daerahError">
                        @if($errors->has('daerah'))
                            {{ $errors->first('daerah') }}
                        @endif
                    </span>
                </div>

                <div class="form-field">
                    <select id="organisasi" name="organisasi" required>
                        <option value="">-</option>
                        <option value="BNCC" {{ old('organisasi') == 'BNCC' ? 'selected' : '' }}>BNCC</option>
                        <option value="HIMTI" {{ old('organisasi') == 'HIMTI' ? 'selected' : '' }}>HIMTI</option>
                        <option value="CSC" {{ old('organisasi') == 'CSC' ? 'selected' : '' }}>CSC</option>
                    </select>
                    <label for="organisasi">Organisasi Kemahasiswaan</label>
                    <div class="field-line"></div>
                    <span class="error-message" id="organisasiError">
                        @if($errors->has('organisasi'))
                            {{ $errors->first('organisasi') }}
                        @endif
                    </span>
                </div>

                <div class="form-field">
                    <input type="email" id="email" name="email" required autocomplete="email" value="{{ old('email') }}">
                    <label for="email">Email Address</label>
                    <div class="field-line"></div>
                    <span class="error-message" id="emailError">
                        @if($errors->has('email'))
                            {{ $errors->first('email') }}
                        @endif
                    </span>
                </div>

                <div class="form-field">
                    <input type="password" id="password" name="password" required autocomplete="current-password">
                    <label for="password">Password</label>
                    <button type="button" class="password-reveal" id="passwordToggle" aria-label="Toggle password visibility">
                        <svg class="eye-show" width="20" height="20" viewBox="0 0 20 20" fill="none">
                            <path d="M10 4C5.5 4 1.7 7.3 1 10c.7 2.7 4.5 6 9 6s8.3-3.3 9-6c-.7-2.7-4.5-6-9-6zm0 10a4 4 0 110-8 4 4 0 010 8zm0-6a2 2 0 100 4 2 2 0 000-4z" fill="currentColor"/>
                        </svg>
                        <svg class="eye-hide" width="20" height="20" viewBox="0 0 20 20" fill="none">
                            <path d="M3 3l14 14m-7-7a2 2 0 01-2-2m2 2a2 2 0 002 2m-2-2v.01M10 6a4 4 0 014 4m-4-4a4 4 0 00-4 4m4-4V4m0 10v2m4-6c.7-2.7-3.3-6-8-6m8 6c-.7 2.7-4.5 6-9 6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                    <div class="field-line"></div>
                    <span class="error-message" id="passwordError">
                        @if($errors->has('password'))
                            {{ $errors->first('password') }}
                        @endif
                    </span>
                </div>

                <div class="form-field">
                    <input type="password" id="password_confirmation" name="password_confirmation" required autocomplete="current-password-confirmation">
                    <label for="password_confirmation">Password confirmation</label>
                    <button type="button" class="password-reveal" id="passwordConfirmationToggle" aria-label="Toggle password visibility">
                        <svg class="eye-show" width="20" height="20" viewBox="0 0 20 20" fill="none">
                            <path d="M10 4C5.5 4 1.7 7.3 1 10c.7 2.7 4.5 6 9 6s8.3-3.3 9-6c-.7-2.7-4.5-6-9-6zm0 10a4 4 0 110-8 4 4 0 010 8zm0-6a2 2 0 100 4 2 2 0 000-4z" fill="currentColor"/>
                        </svg>
                        <svg class="eye-hide" width="20" height="20" viewBox="0 0 20 20" fill="none">
                            <path d="M3 3l14 14m-7-7a2 2 0 01-2-2m2 2a2 2 0 002 2m-2-2v.01M10 6a4 4 0 014 4m-4-4a4 4 0 00-4 4m4-4V4m0 10v2m4-6c.7-2.7-3.3-6-8-6m8 6c-.7 2.7-4.5 6-9 6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                    <div class="field-line"></div>
                    <span class="error-message" id="passwordConfirmationError">
                        @if($errors->has('password_confirmation'))
                            {{ $errors->first('password_confirmation') }}
                        @endif
                    </span>
                </div>

                <div class="form-actions">
                    <label class="remember-checkbox">
                        <input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                        <span class="checkbox-custom">
                            <svg width="12" height="10" viewBox="0 0 12 10" fill="none">
                                <path d="M1 5l3 3 7-7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
                        <span class="checkbox-label">Remember me</span>
                    </label>
                </div>

                <button type="submit" class="signin-button">
                    <span class="button-text">Register</span>
                    <div class="button-loader">
                        <div class="loader-circle"></div>
                    </div>
                </button>
            </form>

            <div class="auth-divider">
                <span>or continue with</span>
            </div>

            <div class="social-auth">
                <a href="{{ url('/auth/redirect') }}" class="social-button google">
                    <img src="{{ asset('assets/images/logo-google.png') }}" alt="logo google" class="google-icon">
                    <span>Google</span>
                </a>
            </div>

            <div class="signup-prompt">
                <span>Already have an account? </span>
                <a href="{{ route('login') }}" class="signup-link">Login</a>
            </div>

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
                <h3>Welcome!</h3>
                <p>Taking you to your creative dashboard...</p>
            </div>
        </div>
    </div>
    <script src="../../shared/js/form-utils.js"></script>
    <script src="{{ asset('assets/js/script-register.js') }}"></script>
@endsection
