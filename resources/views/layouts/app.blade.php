<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'TotaCom')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <!-- Navbar -->
    <nav class="bg-blue-600 text-white p-4">
        <div class="flex items-center justify-between">
            <a href="/" class="text-2xl font-semibold">TotaCom</a>
            <div>
                <a href="/login" class="text-sm font-semibold hover:text-blue-200">Login</a>
                <a href="/register" class="ml-4 text-sm font-semibold hover:text-blue-200">Register</a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="container mx-auto p-6">
        @yield('content')
    </main>

</body>

</html>
