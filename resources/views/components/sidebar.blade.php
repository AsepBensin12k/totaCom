<div x-show="sidebarOpen" x-transition class="fixed inset-0 bg-black bg-opacity-40 z-20 md:hidden"
    @click="sidebarOpen = false"></div>
<aside x-show="sidebarOpen" :class="{ 'md:translate-x-0': sidebarOpen }" x-transition:enter="transition duration-300"
    x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0"
    x-transition:leave="transition duration-300" x-transition:leave-start="translate-x-0"
    x-transition:leave-end="-translate-x-full"
    class="fixed z-30 md:translate-x-0 md:static w-64 bg-white shadow-md flex flex-col transform md:transform-none transition-transform ease-in-out h-full">


    <a href="{{ route('dashboard') }}" class="flex items-center px-6 py-4 space-x-3 border-b border-gray-200">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-12 w-auto">
        <span class="text-2xl font-bold text-green-600">TotaCom</span>
    </a>

    <nav class="flex-1 px-4 py-6 space-y-2 text-gray-700">
        <a href="/dashboard" class="block px-4 py-2 rounded-lg bg-green-100 text-green-700 font-semibold">Dashboard</a>
        <a href="/produk" class="block px-4 py-2 rounded-lg hover:bg-gray-200">Manajemen Stok</a>
        <a href="/pesanan" class="block px-4 py-2 rounded-lg hover:bg-gray-200">Pesanan</a>
        <a href="/laporan" class="block px-4 py-2 rounded-lg hover:bg-gray-200">Manajemen Pesanan</a>
        <a href="/laporan" class="block px-4 py-2 rounded-lg hover:bg-gray-200">Analisis Produk</a>
        <a href="/laporan" class="block px-4 py-2 rounded-lg hover:bg-gray-200">Data Akun</a>
        <a href="/laporan" class="block px-4 py-2 rounded-lg hover:bg-gray-200">Profil</a>

    </nav>
    <form action="{{ route('logout') }}" method="POST" class="p-4 border-t">
        @csrf
        <button type="submit" class="w-full text-left py-2 px-3 text-red-600 hover:bg-red-100 rounded-lg">
            Logout
        </button>
    </form>
</aside>
