<nav class="bg-white/80 backdrop-blur shadow-md fixed w-full z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-22 items-center">
            <div class="flex-shrink-0 flex items-center">
                <a href="{{ route('user.dashboard') }}"
                    class="flex items-center px-6 py-4 space-x-3 border-b border-gray-200">
                    <img src="{{ asset('storage/logo/logo.png') }}" alt="Logo" class="h-12 w-auto">
                    <a href="{{ route('user.dashboard') }}"
                        class="text-2xl font-bold bg-gradient-to-r from-teal-500 to-teal-700 text-transparent bg-clip-text">TotaCom</a>
                </a>
            </div>

            <div class="hidden sm:flex sm:space-x-8">
                <a href="{{ route('user.dashboard') }}" class="animated-link">Dashboard</a>
                <a href="{{ route('user.profile.index') }}" class="animated-link">Profile</a>
                <a href="{{ route('pesanan.keranjang') }}" class="animated-link">Keranjang</a>

                <div class="relative group inline-block text-left">
                    <button type="button" class="animated-link flex items-center">
                        Pesanan
                        <svg class="ml-1 h-5 w-5 transition-transform duration-300 transform group-hover:rotate-180"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <div
                        class="dropdown-menu absolute left-0 top-full w-44 bg-white border border-gray-200 rounded-lg shadow-lg hidden z-10">
                        <a href="{{ route('pesanan.buat') }}"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-teal-50 rounded-t-lg">Buat
                            Pesanan</a>
                        <a href="{{ route('pesanan.riwayat') }}"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-teal-50 rounded-b-lg">Riwayat
                            Pesanan</a>
                    </div>
                </div>

                <a href="{{ route('user.produk.index') }}" class="animated-link">Produk</a>
            </div>

            <div class="hidden sm:flex items-center space-x-4">
                {{-- Logo Profil Desktop: Sekarang bisa diklik ke halaman profil --}}
                <a href="{{ route('user.profile.index') }}" class="block">
                    <div class="w-9 h-9 rounded-full overflow-hidden shadow profile-glow">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->nama) }}" alt="Profile"
                            class="w-full h-full object-cover">
                    </div>
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="text-sm text-gray-700 hover:text-teal-600 transition duration-200">Logout</button>
                </form>
            </div>

            <div class="sm:hidden flex items-center">
                <button id="mobile-menu-button"
                    class="p-2 text-gray-700 hover:text-teal-600 focus:outline-none flex items-center justify-center w-10 h-10 relative">
                    <svg id="hamburger-icon" class="h-6 w-6 block" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg id="close-icon" class="h-6 w-6 absolute hidden" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
    <div id="mobile-menu" class="hidden sm:hidden bg-white border-t border-gray-200 flex flex-col space-y-2 px-4">

        <div class="flex flex-col items-center justify-center p-4 text-center">
            {{-- Logo Profil Mobile: Sekarang bisa diklik ke halaman profil --}}
            <a href="{{ route('user.profile.index') }}" class="flex flex-col items-center justify-center text-center">
                <div class="w-16 h-16 rounded-full overflow-hidden shadow profile-glow mb-2">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->nama) }}" alt="Profile"
                        class="w-full h-full object-cover">
                </div>
                <div>
                    <div class="font-semibold text-gray-800 text-lg">{{ Auth::user()->nama }}</div>
                    <div class="text-sm text-gray-600">{{ Auth::user()->email }}</div>
                </div>
            </a>
        </div>

        <div class="mobile-menu-group-separator"></div>

        <a href="{{ route('user.dashboard') }}" class="mobile-link">Dashboard</a>

        <div class="mobile-menu-group-separator"></div>

        <a href="{{ route('user.profile.index') }}" class="mobile-link">Profile</a>

        <div class="mobile-menu-group-separator"></div>

        <a href="{{ route('pesanan.keranjang') }}" class="mobile-link">Keranjang</a>

        <div class="mobile-menu-group-separator"></div>

        <button onclick="togglePesanan()" class="mobile-pesanan-toggle">
            <span>Pesanan</span>
            {{-- Tanda panah ke bawah dihilangkan --}}
        </button>
        <div id="pesanan-submenu" class="mobile-submenu-collapse flex flex-col items-center">
            <a href="{{ route('pesanan.buat') }}" class="mobile-sub-link">Buat Pesanan</a>
            <a href="{{ route('pesanan.riwayat') }}" class="mobile-sub-link">Riwayat Pesanan</a>
        </div>

        <div class="mobile-menu-group-separator"></div>

        <a href="{{ route('user.produk.index') }}" class="mobile-link">Produk</a>

        <div class="mobile-menu-group-separator"></div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="mobile-link">Logout</button>
        </form>

    </div>
</nav>
