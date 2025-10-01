@extends('layout.master')

@section('title', 'Forgot Password')

@section('content')
    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <div class="logo">
                    <img src="{{ asset('assets/images/logo-apk-simple.png') }}" alt="logo apk simple" class="logo-apk">
                </div>
                <h1>Forgot Password?</h1>
                <p>Input email to reset your password.</p>
            </div>

            {{-- Success Message --}}
            @if (session('status'))
                <div style="padding:10px; margin-bottom:10px; border:1px solid green; border-radius:5px; color:green; background:#eaffea;">
                    {{ session('status') }}
                </div>
            @endif

            {{-- Error --}}
            @if ($errors->any())
                <div style="padding:10px; margin-bottom:10px; border:1px solid red; border-radius:5px; color:red; background:#ffeaea;">
                    {{ $errors->first('email') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="form-field">
                    <input type="email" name="email" id="email" required autofocus>
                    <label for="email">Email Address</label>
                    <div class="field-line"></div>
                </div>

                <button type="submit" class="signin-button">
                    <span class="button-text">Confirm</span>
                </button>
            </form>
        </div>
    </div>
@endsection
