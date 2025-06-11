<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Autentikasi')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        input[type="password"]::-ms-reveal,
        input[type="password"]::-ms-clear,
        input.hide-password-toggle::-webkit-contacts-auto-fill-button,
        input.hide-password-toggle::-webkit-credentials-auto-fill-button {
            display: none !important;
        }

        input.hide-password-toggle::-webkit-credentials-auto-fill-button,
        input.hide-password-toggle::-webkit-caps-lock-indicator {
            visibility: hidden;
            pointer-events: none;
            position: absolute;
            right: 0;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        @keyframes fadeInUp {
            0% {
                opacity: 0;
                transform: translateY(30px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes bounce-gentle {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-5px);
            }
        }

        .animate-float {
            animation: float 6s ease-in-out infinite;
        }

        .animate-fadeInUp {
            animation: fadeInUp 0.8s ease-out;
        }

        .animate-bounce-gentle {
            animation: bounce-gentle 2s ease-in-out infinite;
        }

        .bg-agriculture {
            background: linear-gradient(135deg, #0d9488 0%, #14b8a6 50%, #5eead4 100%);
        }

        .glass-effect {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.95);
        }

        .input-focus:focus {
            transform: scale(1.02);
            box-shadow: 0 10px 25px rgba(20, 184, 166, 0.2);
        }

        .leaf-pattern::before {
            content: '';
            position: absolute;
            top: -50px;
            right: -50px;
            width: 100px;
            height: 100px;
            background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'%3E%3Cpath d='M50 10 C20 10, 10 30, 10 50 C10 70, 30 90, 50 90 C70 70, 90 50, 90 30 C70 10, 50 10, 50 10 Z' fill='%23a7f3d0' opacity='0.3'/%3E%3C/svg%3E") no-repeat;
            background-size: contain;
        }
    </style>
</head>

<body class="bg-agriculture min-h-screen relative overflow-hidden">
    <!-- Floating Elements -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-20 left-10 w-16 h-16 bg-teal-200 rounded-full opacity-20 animate-float"></div>
        <div class="absolute top-40 right-20 w-12 h-12 bg-teal-300 rounded-full opacity-30 animate-float"
            style="animation-delay: 2s;"></div>
        <div class="absolute bottom-32 left-20 w-20 h-20 bg-emerald-200 rounded-full opacity-20 animate-float"
            style="animation-delay: 4s;"></div>
        <div class="absolute bottom-20 right-10 w-8 h-8 bg-teal-400 rounded-full opacity-40 animate-bounce-gentle">
        </div>
    </div>

    <!-- Agricultural Icons -->
    <div class="absolute top-10 left-10 text-teal-200 opacity-30 animate-float">
        <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 24 24">
            <path
                d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z" />
        </svg>
    </div>

    <div class="absolute top-20 right-16 text-emerald-200 opacity-25 animate-bounce-gentle"
        style="animation-delay: 1s;">
        <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 24 24">
            <path
                d="M17,8C8,10 5.9,16.17 3.82,21.34L5.71,22L6.66,19.7C7.14,19.87 7.64,20 8,20C19,20 22,3 22,3C21,5 14,5.25 9,6.25C4,7.25 2,11.5 2,13.5C2,15.5 3.75,17.25 3.75,17.25C7,8 17,8 17,8Z" />
        </svg>
    </div>

    <div class="min-h-screen flex items-center justify-center p-4">
        <div
            class="glass-effect p-8 rounded-2xl shadow-2xl w-full max-w-md relative leaf-pattern animate-fadeInUp transform transition-all duration-700">
            <!-- Logo/Header -->
            <div class="text-center mb-8">
                <div
                    class="mx-auto w-16 h-16 bg-gradient-to-br from-teal-500 to-emerald-500 rounded-full flex items-center justify-center mb-4 animate-bounce-gentle">
                    <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M12,2A3,3 0 0,1 15,5V11A3,3 0 0,1 12,14A3,3 0 0,1 9,11V5A3,3 0 0,1 12,2M19,11C19,14.53 16.39,17.44 13,17.93V21H11V17.93C7.61,17.44 5,14.53 5,11H7A5,5 0 0,0 12,16A5,5 0 0,0 17,11H19Z" />
                    </svg>
                </div>
                <h1 class="text-2xl font-bold text-gray-800 mb-2">Selamat Datang</h1>
                <p class="text-gray-600 text-sm">Masuk ke sistem pertanian digital</p>
            </div>

            @yield('content')

            <div class="mt-6 text-center">
                <p class="text-sm text-gray-600">@yield('footer-text')</p>
            </div>

            <!-- Decorative Elements -->
            <div
                class="absolute -bottom-4 -right-4 w-20 h-20 bg-gradient-to-br from-teal-400 to-emerald-400 rounded-full opacity-10">
            </div>
            <div
                class="absolute -top-4 -left-4 w-16 h-16 bg-gradient-to-br from-emerald-400 to-teal-400 rounded-full opacity-10">
            </div>
        </div>
    </div>
    @yield('scripts')
</body>

</html>
