<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#16a34a',
                        light: '#f1f5f9',
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-gray-100 font-sans">

    <div x-data="{
        sidebarOpen: window.innerWidth >= 768,
        toggleSidebar() {
            this.sidebarOpen = !this.sidebarOpen;
        },
        init() {
            const updateSidebar = () => {
                this.sidebarOpen = window.innerWidth >= 768;
            };
            window.addEventListener('resize', updateSidebar);
            updateSidebar(); // jalankan saat init juga
        }
    }" x-init="init()" class="flex h-screen" x-cloak>

        {{-- Sidebar Component --}}
        <div x-show="sidebarOpen && window.innerWidth < 768" x-transition
            class="fixed inset-0 bg-black bg-opacity-40 z-20 md:hidden" @click="sidebarOpen = false"></div>
        @include('components.sidebar')

        {{-- Main Content --}}
        <div class="flex-1 flex flex-col overflow-hidden ml-0">

            {{-- Navbar Component --}}
            @include('components.navbar')

            {{-- Content --}}
            <main class="flex-1 overflow-y-auto p-2 md:p-4">
                @yield('content')
            </main>
        </div>
    </div>

    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</body>

</html>
