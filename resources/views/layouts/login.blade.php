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
    </style>
</head>

<body class="bg-gray-100">

    <div class="min-h-screen flex items-center justify-center">
        <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-sm">

            @yield('content')

            <div class="mt-4 text-center">
                <p class="text-sm text-gray-600">@yield('footer-text')</p>
            </div>
        </div>
    </div>
    @yield('scripts')
</body>

</html>
