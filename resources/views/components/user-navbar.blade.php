<nav class="bg-white shadow-md">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            {{-- Kiri: Logo --}}
            <div class="flex items-center">
                <a href="{{ route('user.dashboard') }}" class="text-xl font-bold text-green-600">
                    totaCom
                </a>
            </div>

            {{-- Tengah: Navigasi --}}
            <div class="hidden md:flex space-x-8 items-center">
                <a href="{{ route('user.dashboard') }}" class="text-gray-700 hover:text-green-600 font-medium">
                    Dashboard
                </a>

                <a href="{{ route('profile.index') }}" class="text-gray-700 hover:text-green-600 font-medium">
                    Profil
                </a>

                <a href="{{ route('pesanan.keranjang') }}" class="text-gray-700 hover:text-green-600 font-medium">
                    Keranjang
                </a>

                {{-- Dropdown Pesanan --}}
                <div x-data="{ open: false }" class="relative">
                    <button @mouseover="open = true" @mouseleave="open = false"
                        class="text-gray-700 hover:text-green-600 font-medium focus:outline-none">
                        Pesanan
                    </button>

                    <div x-show="open" @mouseover="open = true" @mouseleave="open = false"
                        class="absolute left-0 mt-2 w-48 bg-white border border-gray-200 shadow-lg rounded-md z-50"
                        x-transition>
                        <a href="{{ route('pesanan.buat') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Buat Pesanan
                        </a>
                        <a href="{{ route('pesanan.riwayat') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Riwayat Pesanan
                        </a>
                    </div>
                </div>

                <a href="{{ route('user.produk.index') }}" class="text-gray-700 hover:text-green-600 font-medium">
                    Produk
                </a>
            </div>


            {{-- Kanan: Foto Profil & Logout --}}
            <div class="flex items-center space-x-4">
                {{-- Foto Profil Dummy --}}
                <div class="w-8 h-8 rounded-full bg-gray-300"></div>

                {{-- Logout (disalin dari sidebar admin) --}}
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="inline-flex items-center px-3 py-2 bg-red-600 text-white text-sm font-medium rounded-md hover:bg-red-700 transition">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>
