@extends('layout.master')
@section('title', 'Change Password')

@section('content')
    <div class="login-container">
        <div class="login-card">
            <div class="card-accent"></div>

            <div class="login-header">
                <div class="logo">
                    <img src="{{ asset('assets/images/logo-apk-simple.png') }}" alt="logo apk simple" class="logo-apk">
                </div>
                <h1>Change Your Password!</h1>
            </div>

            {{-- tampilkan error jika ada --}}
            @if ($errors->any())
                <div style="color: red; margin-bottom: 15px;">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- form reset password --}}
            <form action="{{ route('password.update') }}" method="POST" class="login-form" @if(session('status')) style="display:none;" @endif>
                @csrf
                <input type="hidden" name="token" value="{{ request()->route('token') }}">
                <input type="hidden" name="email" value="{{ request('email') }}">

                <div class="form-field">
                    <input type="password" id="password" name="password" required>
                    <label for="password">New Password</label>
                </div>

                <div class="form-field">
                    <input type="password" id="password_confirmation" name="password_confirmation" required>
                    <label for="password_confirmation">Confirm Password</label>
                </div>

                <button type="submit" class="signin-button">
                    <span class="button-text">Confirm</span>
                </button>
            </form>

            @if (session('status'))
                <script>
                    setTimeout(() => {
                        window.location.href = "{{ route('login') }}";
                    }, 2500); 
                </script>
            @endif
        </div>
    </div>
@endsection
