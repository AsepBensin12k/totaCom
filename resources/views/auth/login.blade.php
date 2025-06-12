@extends('layouts.login')

@section('title', 'Login')

@section('content')
    <form method="POST" action="/login" class="space-y-6">
        @csrf

        <!-- Username/Email Field -->
        <div class="group">
            <label for="login"
                class="block text-sm font-semibold text-gray-700 mb-2 transition-colors duration-200 group-focus-within:text-teal-600">
                <span class="flex items-center">
                    <svg class="w-4 h-4 mr-2 text-teal-500" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M12,4A4,4 0 0,1 16,8A4,4 0 0,1 12,12A4,4 0 0,1 8,8A4,4 0 0,1 12,4M12,14C16.42,14 20,15.79 20,18V20H4V18C4,15.79 7.58,14 12,14Z" />
                    </svg>
                    Username atau Email
                </span>
            </label>
            <div class="relative">
                <input type="text" name="login" id="login" placeholder="Masukkan username atau email" required
                    class="w-full p-4 pl-12 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent input-focus transition-all duration-300 bg-white/80 backdrop-blur-sm">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M12,4A4,4 0 0,1 16,8A4,4 0 0,1 12,12A4,4 0 0,1 8,8A4,4 0 0,1 12,4M12,14C16.42,14 20,15.79 20,18V20H4V18C4,15.79 7.58,14 12,14Z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Password Field -->
        <div class="group">
            <label for="password"
                class="block text-sm font-semibold text-gray-700 mb-2 transition-colors duration-200 group-focus-within:text-teal-600">
                <span class="flex items-center">
                    <svg class="w-4 h-4 mr-2 text-teal-500" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M12,17A2,2 0 0,0 14,15C14,13.89 13.1,13 12,13A2,2 0 0,0 10,15A2,2 0 0,0 12,17M18,8A2,2 0 0,1 20,10V20A2,2 0 0,1 18,22H6A2,2 0 0,1 4,20V10C4,8.89 4.9,8 6,8H7V6A5,5 0 0,1 12,1A5,5 0 0,1 17,6V8H18M12,3A3,3 0 0,0 9,6V8H15V6A3,3 0 0,0 12,3Z" />
                    </svg>
                    Password
                </span>
            </label>
            <div class="relative">
                <input type="password" name="password" id="password" placeholder="Masukkan password" required
                    class="w-full p-4 pl-12 pr-12 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent input-focus transition-all duration-300 bg-white/80 backdrop-blur-sm">

                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M12,17A2,2 0 0,0 14,15C14,13.89 13.1,13 12,13A2,2 0 0,0 10,15A2,2 0 0,0 12,17M18,8A2,2 0 0,1 20,10V20A2,2 0 0,1 18,22H6A2,2 0 0,1 4,20V10C4,8.89 4.9,8 6,8H7V6A5,5 0 0,1 12,1A5,5 0 0,1 17,6V8H18M12,3A3,3 0 0,0 9,6V8H15V6A3,3 0 0,0 12,3Z" />
                    </svg>
                </div>

                <button type="button" onclick="togglePassword()"
                    class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-teal-600 focus:outline-none transition-colors duration-200 z-10">
                    <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5 transform transition-transform duration-200 hover:scale-110" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path id="eyeOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Login Button -->
        <div class="pt-2">
            <button type="submit" id="loginBtn"
                class="w-full py-4 bg-gradient-to-r from-teal-600 to-emerald-600 text-white font-bold rounded-xl hover:from-teal-700 hover:to-emerald-700 focus:outline-none focus:ring-4 focus:ring-teal-500/50 transition-all duration-300 transform hover:scale-105 hover:shadow-xl active:scale-95 relative overflow-hidden group">

                <span class="relative z-10 flex items-center justify-center">
                    <svg class="w-5 h-5 mr-2 transition-transform duration-200 group-hover:translate-x-1"
                        fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M10,17V14H3V10H10V7L15,12L10,17M10,2H19A2,2 0 0,1 21,4V20A2,2 0 0,1 19,22H10A2,2 0 0,1 8,20V18H10V20H19V4H10V6H8V4A2,2 0 0,1 10,2Z" />
                    </svg>
                    Masuk
                </span>

                <!-- Animated Background -->
                <div
                    class="absolute inset-0 bg-gradient-to-r from-emerald-600 to-teal-600 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left">
                </div>
            </button>
        </div>

        {{-- <!-- Forgot Password Link -->
        <div class="text-center">
            <a href="#" class="text-sm text-teal-600 hover:text-teal-800 transition-colors duration-200 font-medium">
                Lupa password?
            </a>
        </div> --}}
    </form>
@endsection

@section('footer-text')
    Belum punya akun?
    <a href="/register"
        class="text-teal-600 hover:text-teal-800 font-semibold transition-colors duration-200 hover:underline">
        Daftar sekarang
    </a>
@endsection

@section('scripts')
    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');

            const showIcon =
                `
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />`;

            const hideIcon =
                `
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029M9.878 9.878a3 3 0 114.243 4.243M3 3l18 18" />`;

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                eyeIcon.innerHTML = hideIcon;
                eyeIcon.classList.add('text-teal-600');
            } else {
                passwordInput.type = "password";
                eyeIcon.innerHTML = showIcon;
                eyeIcon.classList.remove('text-teal-600');
            }
        }

        // Add input animation effects
        document.addEventListener('DOMContentLoaded', function() {
            const inputs = document.querySelectorAll('input[type="text"], input[type="password"]');

            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.classList.add('ring-2', 'ring-teal-500/20');
                });

                input.addEventListener('blur', function() {
                    this.parentElement.classList.remove('ring-2', 'ring-teal-500/20');
                });
            });

            // Login button loading animation
            const loginBtn = document.getElementById('loginBtn');
            const loginForm = document.querySelector('form');

            loginForm.addEventListener('submit', function() {
                loginBtn.innerHTML = `
                    <span class="flex items-center justify-center">
                        <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Memproses...
                    </span>
                `;
                loginBtn.disabled = true;
            });
        });
    </script>
@endsection
