<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'Customer Dashboard')</title>
    <!-- Tailwind CSS CDN (ganti sesuai kebutuhan) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
      /* Dropdown hover desktop */
      @media (min-width: 640px) {
        .group:hover .dropdown-menu {
          display: block;
        }
      }
    </style>
</head>
<body class="bg-gray-100">

<nav class="bg-white shadow-md fixed w-full z-50">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between h-16 items-center">
      <!-- Logo -->
      <div class="flex-shrink-0 flex items-center">
        <a href="{{ route('user.dashboard') }}" class="text-xl font-bold text-blue-600">totaCom</a>
      </div>

      <!-- Desktop menu -->
      <div class="hidden sm:flex sm:space-x-8">
        <a href="{{ route('user.dashboard') }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-700 hover:text-blue-600">Dashboard</a>
        <a href="{{ route('profile.index') }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-700 hover:text-blue-600">Profile</a>

        <!-- Pesanan dropdown -->
        <div class="relative group inline-block text-left">
          <button type="button" class="inline-flex justify-center w-full px-3 py-2 text-sm font-medium text-gray-700 hover:text-blue-600 focus:outline-none">
            Pesanan
            <svg class="ml-1 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
          </button>

          <div class="dropdown-menu absolute left-0 mt-2 w-40 bg-white border border-gray-200 rounded-md shadow-lg hidden group-hover:block z-10">
            <a href="{{ route('pesanan.buat') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Buat Pesanan</a>
            <a href="{{ route('pesanan.lihat') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Lihat Pesanan</a>
            <a href="{{ route('pesanan.riwayat') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Riwayat Pesanan</a>
          </div>
        </div>

        <a href="{{ route('user.produk.index') }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-700 hover:text-blue-600">Produk</a>
      </div>

    <!-- Right side -->
    <div class="hidden sm:flex items-center space-x-4">
    <!-- Foto profil -->
    <div class="w-8 h-8 rounded-full bg-gray-300 overflow-hidden">
        <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->nama) }}" alt="Profile" class="w-full h-full object-cover">
    </div>

    <!-- Logout -->
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="text-sm text-gray-700 hover:text-red-500">Logout</button>
    </form>
    </div>


      <!-- Mobile hamburger -->
      <div class="sm:hidden">
        <button id="mobile-menu-button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-700 hover:text-blue-600 focus:outline-none">
          <svg id="hamburger-icon" class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
          </svg>
          <svg id="close-icon" class="hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>
    </div>
  </div>

  <!-- Mobile menu -->
  <div id="mobile-menu" class="hidden sm:hidden bg-white border-t border-gray-200">
    <a href="{{ route('user.dashboard') }}" class="block px-4 py-3 text-gray-700 hover:bg-gray-100">Dashboard</a>
    <a href="{{ route('profile.index') }}" class="block px-4 py-3 text-gray-700 hover:bg-gray-100">Profile</a>

    <!-- Pesanan accordion -->
    <div x-data="{ open: false }" class="border-t border-gray-200">
      <button onclick="togglePesanan()" class="w-full flex justify-between items-center px-4 py-3 text-gray-700 hover:bg-gray-100 focus:outline-none">
        Pesanan
        <svg id="pesanan-chevron" class="h-5 w-5 transform transition-transform" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
        </svg>
      </button>
      <div id="pesanan-submenu" class="hidden flex flex-col border-t border-gray-200">
        <a href="{{ route('pesanan.buat') }}" class="block px-6 py-2 text-gray-700 hover:bg-gray-100">Buat Pesanan</a>
        <a href="{{ route('pesanan.lihat') }}" class="block px-6 py-2 text-gray-700 hover:bg-gray-100">Lihat Pesanan</a>
        <a href="{{ route('pesanan.riwayat') }}" class="block px-6 py-2 text-gray-700 hover:bg-gray-100">Riwayat Pesanan</a>
      </div>
    </div>

    <a href="{{ route('user.produk.index') }}" class="block px-4 py-3 text-gray-700 hover:bg-gray-100">Produk</a>

    <form method="POST" action="{{ route('logout') }}">
  @csrf
  <button type="submit" class="block w-full text-left px-4 py-3 text-gray-700 hover:bg-gray-100">
    Logout
  </button>
</form>

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
</nav>

<div class="pt-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
  @yield('content')
</div>

</body>
</html>
