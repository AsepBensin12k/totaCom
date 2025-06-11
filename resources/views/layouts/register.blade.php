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

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }

        ::-webkit-scrollbar-thumb {
            background: #14b8a6;
            border-radius: 3px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #0f766e;
        }

        /* Background pattern */
        body {
            background: linear-gradient(135deg, #f0fdfa 0%, #ccfbf1 50%, #a7f3d0 100%);
            background-attachment: fixed;
        }

        /* Floating animation */
        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .float-animation {
            animation: float 6s ease-in-out infinite;
        }

        /* Gradient text */
        .gradient-text {
            background: linear-gradient(135deg, #0f766e, #14b8a6, #06b6d4);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
    </style>
</head>

<body class="min-h-screen">
    <!-- Background decorative elements -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-10 left-10 w-20 h-20 bg-teal-200 rounded-full opacity-30 float-animation"></div>
        <div class="absolute top-32 right-20 w-16 h-16 bg-emerald-200 rounded-full opacity-40"
            style="animation-delay: -2s;"></div>
        <div class="absolute bottom-20 left-1/4 w-24 h-24 bg-cyan-200 rounded-full opacity-25"
            style="animation-delay: -4s;"></div>
        <div class="absolute bottom-32 right-1/3 w-12 h-12 bg-teal-300 rounded-full opacity-35"
            style="animation-delay: -1s;"></div>
    </div>

    <div class="min-h-screen flex items-center justify-center p-4 relative">
        <!-- Main container dengan lebar penuh -->
        <div class="bg-white/90 backdrop-blur-sm p-8 rounded-2xl shadow-2xl w-full max-w-7xl border border-white/20">
            <!-- Header -->
            <div class="text-center mb-4">
                <div
                    class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-teal-400 via-emerald-500 to-cyan-500 rounded-full mb-2 shadow-xl float-animation">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                </div>
                <h1 class="text-3xl font-bold gradient-text mb-2">Daftar akun</h1>
                <p class="text-teal-700 text- font-medium">Isi formulir di bawah untuk mendaftarkan akun</p>
                <div class="w-24 h-1 bg-gradient-to-r from-teal-400 to-emerald-500 mx-auto mt-4 rounded-full"></div>
            </div>

            <!-- Content area dengan background gradient -->
            <div
                class="bg-gradient-to-br from-teal-50/80 via-emerald-50/60 to-cyan-50/80 p-8 rounded-xl shadow-inner border border-teal-100">
                @yield('content')
            </div>

            <!-- Footer -->
            <div class="mt-8 text-center">
                <div class="bg-white/70 backdrop-blur-sm rounded-lg p-4 border border-teal-100">
                    <p class="text-teal-800 font-medium">@yield('footer-text')</p>
                </div>
            </div>
        </div>
    </div>

    @yield('scripts')
</body>

</html>
