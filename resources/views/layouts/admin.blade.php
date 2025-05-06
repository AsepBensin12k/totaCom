<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <div class="w-64 bg-blue-600 p-6 text-white">
            <h2 class="text-2xl font-semibold mb-8">Admin Panel</h2>
            <ul>
                <li><a href="#" class="block py-2 px-4 rounded hover:bg-blue-700">Dashboard</a></li>
                <li><a href="#" class="block py-2 px-4 rounded hover:bg-blue-700">Manage Users</a></li>
                <li><a href="#" class="block py-2 px-4 rounded hover:bg-blue-700">Settings</a></li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-6">
            <h1 class="text-3xl font-semibold text-gray-700 mb-6">Welcome to Admin Dashboard</h1>
            <!-- Content goes here -->
            @yield('content')
        </div>
    </div>

</body>

</html>
