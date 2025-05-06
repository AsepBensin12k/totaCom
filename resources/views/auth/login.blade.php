@extends('layouts.auth')

@section('title', 'Login')

@section('content')
    <h2 class="text-3xl font-semibold text-center text-gray-700 mb-6">Login</h2>
    <form method="POST" action="/login">
        @csrf
        <div class="mb-4">
            <label for="login" class="block text-sm font-medium text-gray-600">Username atau Email</label>
            <input type="text" name="login" id="login" placeholder="Username atau Email" required
                class="w-full p-3 mt-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div class="mb-6">
            <label for="password" class="block text-sm font-medium text-gray-600">Password</label>
            <div class="relative mt-2">
                <input type="password" name="password" id="password" placeholder="Password" required
                    class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 pr-10">

                <button type="button" onclick="togglePassword()"
                    class="absolute inset-y-0 right-3 flex items-center text-gray-600 focus:outline-none">
                    <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path id="eyeOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path id="eyeOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                </button>
            </div>
        </div>

        <button type="submit"
            class="w-full py-3 bg-blue-600 text-white font-semibold rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
            Login
        </button>
    </form>
@endsection

@section('footer-text')
    Belum punya akun? <a href="/register" class="text-blue-600 hover:text-blue-700 font-semibold">Daftar sekarang</a>
@endsection

@section('scripts')
<script>
    function togglePassword() {
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');

        const showIcon = `
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />`;

        const hideIcon = `
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029M9.878 9.878a3 3 0 114.243 4.243M3 3l18 18" />`;

        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            eyeIcon.innerHTML = hideIcon;
        } else {
            passwordInput.type = "password";
            eyeIcon.innerHTML = showIcon;
        }
    }
</script>
@endsection
