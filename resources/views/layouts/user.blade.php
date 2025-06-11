<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'Customer Dashboard')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Dropdown hover desktop */
        @media (min-width: 640px) {
            .group:hover .dropdown-menu {
                display: block;
            }

            .group:hover .dropdown-menu {
                animation: dropdownFadeIn 0.2s ease-in-out forwards;
            }

            .group:not(:hover) .dropdown-menu {
                animation: dropdownFadeOut 0.2s ease-in-out forwards;
            }
        }

        @keyframes dropdownFadeIn {
            from {
                opacity: 0;
                transform: translateY(5px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes dropdownFadeOut {
            from {
                opacity: 1;
                transform: translateY(0);
            }

            to {
                opacity: 0;
                transform: translateY(5px);
            }
        }
    </style>
</head>

<body class="bg-gradient-to-b from-blue-100 to-white min-h-screen font-sans">

    <nav class="bg-white/80 backdrop-blur shadow-md fixed w-full z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('user.dashboard') }}"
                        class="text-2xl font-bold bg-gradient-to-r from-blue-500 to-purple-600 text-transparent bg-clip-text">totaCom</a>
                </div>
                <div class="hidden sm:flex sm:space-x-8">
                    <a href="{{ route('user.dashboard') }}" class="animated-link">Dashboard</a>
                    <a href="{{ route('user.profile.index') }}" class="animated-link">Profile</a>
                    <a href="{{ route('pesanan.keranjang') }}" class="animated-link">Keranjang</a>

                    <!-- Dropdown -->
                    <div class="relative group inline-block text-left">
                        <button type="button" class="animated-link flex items-center">
                            Pesanan
                            <svg class="ml-1 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <div
                            class="dropdown-menu absolute left-0 top-full w-44 bg-white border border-gray-200 rounded-lg shadow-lg hidden z-10">
                            <a href="{{ route('pesanan.buat') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50">Buat Pesanan</a>
                            <a href="{{ route('pesanan.riwayat') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50">Riwayat Pesanan</a>
                        </div>
                    </div>

                    <a href="{{ route('user.produk.index') }}" class="animated-link">Produk</a>
                </div>

                <!-- Right side -->
                <div class="hidden sm:flex items-center space-x-4">
                    <div class="w-9 h-9 rounded-full overflow-hidden shadow">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->nama) }}" alt="Profile"
                            class="w-full h-full object-cover">
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-sm text-gray-700 hover:text-red-500">Logout</button>
                    </form>
                </div>

                <!-- Hamburger button mobile -->
                <div class="sm:hidden flex items-center">
                    <button id="mobile-menu-button"
                        class="p-2 text-gray-700 hover:text-blue-600 focus:outline-none flex items-center justify-center w-10 h-10">
                        <svg id="hamburger-icon" class="h-6 w-6 block" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        <svg id="close-icon" class="h-6 w-6 hidden" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        <div id="mobile-menu"
            class="hidden sm:hidden bg-white border-t border-gray-200 flex flex-col space-y-1 py-2 px-4 rounded-md shadow-md">
            <a href="{{ route('user.dashboard') }}" class="mobile-link">Dashboard</a>
            <a href="{{ route('user.profile.index') }}" class="mobile-link">Profile</a>
            <a href="{{ route('pesanan.keranjang') }}" class="mobile-link">Keranjang</a>
            <div class="border-t border-gray-200">
                <button onclick="togglePesanan()"
                    class="w-full flex justify-between items-center px-4 py-3 text-gray-700 hover:bg-gray-100">
                    Pesanan
                    <svg id="pesanan-chevron" class="h-5 w-5 transform transition-transform"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div id="pesanan-submenu" class="hidden flex flex-col border-t border-gray-200 ml-4">
                    <a href="{{ route('pesanan.buat') }}" class="mobile-sub-link">Buat Pesanan</a>
                    <a href="{{ route('pesanan.riwayat') }}" class="mobile-sub-link">Riwayat Pesanan</a>
                </div>
            </div>
            <a href="{{ route('user.produk.index') }}" class="mobile-link">Produk</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="mobile-link">Logout</button>
            </form>
        </div>
    </nav>

    <div class="pt-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @yield('content')
    </div>

    <script>
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        const hamburgerIcon = document.getElementById('hamburger-icon');
        const closeIcon = document.getElementById('close-icon');
        const pesananSubmenu = document.getElementById('pesanan-submenu');
        const pesananChevron = document.getElementById('pesanan-chevron');

        mobileMenuButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
            hamburgerIcon.classList.toggle('hidden');
            closeIcon.classList.toggle('hidden');
        });

        function togglePesanan() {
            if (pesananSubmenu.classList.contains('hidden')) {
                pesananSubmenu.classList.remove('hidden');
                pesananChevron.style.transform = 'rotate(180deg)';
            } else {
                pesananSubmenu.classList.add('hidden');
                pesananChevron.style.transform = 'rotate(0deg)';
            }
        }
    </script>

    <style>
        .animated-link {
            @apply inline-flex items-center px-3 py-2 text-sm font-medium text-gray-700 hover:text-blue-600 transition duration-200 relative;
        }

        .mobile-link {
            @apply block px-4 py-3 text-gray-700 hover:bg-gray-100;
        }

        .mobile-sub-link {
            @apply block px-6 py-2 text-gray-700 hover:bg-gray-100;
        }
    </style>

</body>

</html>
