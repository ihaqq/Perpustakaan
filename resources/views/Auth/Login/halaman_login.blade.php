@extends('Admin/Layouts.app')

@section('title', 'Login - SIPERPUS')

@push('styles')
    @vite('resources/css/Auth/login.css')
@endpush

@section('content')

    <body>

        <div class="card">
            <div class="logo-wrapper">
                <img src="{{ asset('images/logoPerpus/siperpus.png') }}" alt="Siperpus">
            </div>

            <h2>Welcome Back!</h2>

            <form action="#">
                <div class="form-group">
                    <div class="input-wrapper">
                        <svg class="field-icon" viewBox="0 0 24 24">
                            <path
                                d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                        </svg>
                        <input type="text" placeholder="Username" required>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-wrapper">
                        <svg class="field-icon" viewBox="0 0 24 24">
                            <path
                                d="M18 8h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zM9 6c0-1.66 1.34-3 3-3s3 1.34 3 3v2H9V6zm9 14H6V10h12v10zm-6-3c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2z" />
                        </svg>
                        <input type="password" id="password" placeholder="Password" required>
                        <svg class="password-toggle" id="togglePassword" viewBox="0 0 24 24">
                            <path id="eye-path"
                                d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z" />
                        </svg>
                    </div>
                </div>

                <div class="options">
                    <label>
                        <input type="checkbox">
                        <span>Remember me</span>
                    </label>
                    <a href="#">Forgot Password?</a>
                </div>

                <button onclick="window.location.href='{{ route('dashboard') }}'" type="submit" class="btn-login">LOGIN</button>
            </form>

            <div class="divider">OR</div>

            <button type="button" class="btn-google">
                <img src="https://www.gstatic.com/firebasejs/ui/2.0.0/images/auth/google.svg" width="18">
                Sign in with Google
            </button>

            <p class="signup-text">
                Don't have an account? <a href="{{ route('register') }}">Sign up</a>
            </p>
        </div>
    </body>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

@endsection
@push('scripts')
    @vite('resources/js/Auth/login.js')
@endpush