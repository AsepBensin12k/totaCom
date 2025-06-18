<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'Customer Dashboard')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    {{-- Font Awesome untuk ikon sosial media dan kontak di footer --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <style>
        /* PENTING: Penambahan ini untuk mengatasi geseran scrollbar */
        html {
            overflow-y: scroll;
            /* Selalu tampilkan scrollbar vertikal */
        }

        /* Define custom teal colors */
        :root {
            --color-teal-50: #E0F2F1;
            --color-teal-100: #B2DFDB;
            --color-teal-200: #80CBC4;
            --color-teal-300: #4DB6AC;
            --color-teal-400: #26A69A;
            --color-teal-500: #009688;
            --color-teal-600: #00897B;
            --color-teal-700: #00796B;
            --color-teal-800: #00695C;
            --color-teal-900: #004D40;

            --color-gray-900: #1a202c;
            --color-gray-700: #4a5568;
            --color-gray-200: #edf2f7;
            --color-gray-300: #cbd5e0;
        }

        /* Apply custom colors to Tailwind classes */
        .bg-teal-50 {
            background-color: var(--color-teal-50);
        }

        .bg-teal-100 {
            background-color: var(--color-teal-100);
        }

        .bg-teal-500 {
            background-color: var(--color-teal-500);
        }

        .bg-teal-700 {
            color: var(--color-teal-700);
        }

        .text-teal-500 {
            color: var(--color-teal-500);
        }

        .text-teal-600 {
            color: var(--color-teal-600);
        }

        .text-teal-700 {
            color: var(--color-teal-700);
        }

        .hover\:bg-teal-50:hover {
            background-color: var(--color-teal-50);
        }

        .hover\:text-teal-600:hover {
            color: var(--color-teal-600);
        }

        .hover\:bg-teal-500:hover {
            background-color: var(--color-teal-500);
        }

        .border-gray-200 {
            border-color: var(--color-gray-200);
        }

        .border-gray-300 {
            border-color: var(--color-gray-300);
        }

        .border-teal-200 {
            border-color: var(--color-teal-200);
        }


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

        /* Animated Link Underline */
        .animated-link {
            @apply inline-flex items-center px-3 py-2 text-sm font-medium text-gray-700 hover:text-teal-600 transition duration-300;
            background-image: linear-gradient(to right, var(--color-teal-500), var(--color-teal-500));
            background-size: 0% 2px;
            background-repeat: no-repeat;
            background-position: 50% calc(100% - 2px);
            transition: background-size 0.3s ease-out, color 0.3s ease-out;
        }

        .animated-link:hover {
            background-size: 100% 2px;
        }

        /* Khusus untuk button dropdown (Pesanan) */
        .group>.animated-link {
            flex-shrink: 0;
        }

        .animated-link svg {
            flex-shrink: 0;
        }


        /* Mobile Menu Link Styling */
        .mobile-link {
            @apply flex justify-center items-center py-3 text-gray-700 hover:bg-teal-50 transition duration-200 rounded-md;
            position: relative;
            overflow: hidden;
            width: 100%;
            text-align: center;
        }

        .mobile-sub-link {
            @apply flex justify-center items-center py-3 text-gray-700 hover:bg-teal-50 transition duration-200 rounded-md;
            position: relative;
            overflow: hidden;
            width: 100%;
            text-align: center;
            /* Memberikan sedikit indentasi pada submenu agar terlihat berbeda dari menu utama */
            padding-left: 1.5rem;
            /* Indentasi halus */
            padding-right: 1.5rem;
        }

        /* Underline effect for mobile links */
        .mobile-link::after,
        .mobile-sub-link::after {
            content: '';
            position: absolute;
            left: 50%;
            bottom: 0;
            width: 0%;
            height: 2px;
            background-color: var(--color-teal-500);
            transform: translateX(-50%) scaleX(0);
            transition: transform 0.3s ease-out, width 0.3s ease-out;
        }

        .mobile-link:hover::after {
            width: 80%;
            /* Lebar underline yang konsisten untuk link utama */
            transform: translateX(-50%) scaleX(1);
        }

        .mobile-sub-link:hover::after {
            width: calc(100% - 3rem);
            /* Sesuaikan lebar underline dengan padding 1.5rem kiri-kanan */
            transform: translateX(-50%) scaleX(1);
        }

        .mobile-link:hover,
        .mobile-sub-link:hover {
            background-color: var(--color-teal-50);
            color: var(--color-teal-700);
        }


        /* Hamburger/Close Icon Animation */
        #mobile-menu-button {
            transition: transform 0.3s ease-in-out;
        }

        #mobile-menu-button.open #hamburger-icon {
            transform: rotate(45deg);
            opacity: 0;
        }

        #mobile-menu-button.open #close-icon {
            transform: rotate(0deg);
            opacity: 1;
        }

        #hamburger-icon,
        #close-icon {
            transition: transform 0.3s ease-in-out, opacity 0.3s ease-in-out;
            position: absolute;
        }

        /* Mobile Menu Slide In/Out */
        #mobile-menu.hidden {
            opacity: 0;
            transform: translateY(-20px) scaleY(0.95);
            pointer-events: none;
        }

        #mobile-menu {
            transition: opacity 0.3s ease-out, transform 0.3s ease-out;
            border-bottom-left-radius: 0.75rem;
            border-bottom-right-radius: 0.75rem;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            transform-origin: top;
            padding-top: 1rem;
            padding-bottom: 1rem;
        }

        /* Profile image subtle glow */
        .profile-glow {
            transition: box-shadow 0.3s ease-in-out;
        }

        .profile-glow:hover {
            box-shadow: 0 0 15px var(--color-teal-500);
        }

        /* BODY BACKGROUND: TEAL GLOSSY EFFECT */
        body {
            background: linear-gradient(to bottom,
                    rgba(0, 150, 136, 0.15) 0%,
                    rgba(0, 150, 136, 0.08) 20%,
                    rgba(0, 150, 136, 0.04) 40%,
                    rgba(0, 150, 136, 0.02) 60%,
                    rgba(0, 150, 136, 0.05) 80%,
                    rgba(0, 150, 136, 0.1) 100%);
        }

        /* Added for mobile submenu smooth transition */
        .mobile-submenu-collapse {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.4s ease-in-out, padding 0.3s ease-in-out;
            padding-top: 0;
            padding-bottom: 0;
            padding-left: 0;
            padding-right: 0;
        }

        .mobile-submenu-collapse.open {
            max-height: 300px;
            padding-top: 0.75rem;
            padding-bottom: 0.75rem;
        }

        /* Border pemisah antar grup */
        .mobile-menu-group-separator {
            border-top: 1px solid var(--color-gray-300);
            padding-top: 1.5rem;
            margin-top: 1.5rem;
        }

        /* Styling khusus untuk tombol "Pesanan" di mobile */
        .mobile-pesanan-toggle {
            @apply flex justify-between items-center py-3 text-gray-700 hover:bg-teal-50 transition duration-200 rounded-md;
            position: relative;
            overflow: hidden;
            width: 100%;
            padding-left: 1rem;
            padding-right: 1rem;
            text-align: center;
        }

        .mobile-pesanan-toggle span {
            flex-grow: 1;
            text-align: center;
        }

        /* Underline khusus untuk tombol Pesanan */
        .mobile-pesanan-toggle::after {
            content: '';
            position: absolute;
            left: 50%;
            bottom: 0;
            width: 0%;
            height: 2px;
            background-color: var(--color-teal-500);
            transform: translateX(-50%) scaleX(0);
            transition: transform 0.3s ease-out, width 0.3s ease-out;
        }

        .mobile-pesanan-toggle:hover::after {
            width: calc(100% - 2rem);
            transform: translateX(-50%) scaleX(1);
        }

        /* Mengatur posisi dan rotasi svg chevron pada button Pesanan */
        #pesanan-chevron {
            transition: transform 0.3s ease-in-out;
        }

        .mobile-pesanan-toggle.active #pesanan-chevron {
            transform: rotate(180deg);
        }

        /* --- Animasi Masuk Halaman Cepat dan Fluid --- */

        /* Animasi Fade-in & Slide-up untuk konten utama */
        .animate-fade-in-up {
            opacity: 0;
            transform: translateY(15px);
            /* Sedikit geser dari bawah */
            animation: fadeInFromBottom 0.5s ease-out forwards;
            /* Durasi 0.5s */
        }

        @keyframes fadeInFromBottom {
            from {
                opacity: 0;
                transform: translateY(15px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Animasi Navbar: slide-down cepat */
        .animate-navbar-slide-down {
            opacity: 0;
            transform: translateY(-20px);
            /* Geser dari atas */
            animation: slideDownFadeIn 0.4s ease-out forwards;
            /* Durasi 0.4s, lebih cepat dari konten */
        }

        @keyframes slideDownFadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Animasi Staggered Fade-in untuk Footer (lebih cepat) */
        .stagger-fade-in>* {
            opacity: 0;
            animation: fadeInFromBottom 0.5s ease-out forwards;
        }

        /* Penundaan singkat untuk setiap child di dalam .stagger-fade-in */
        .stagger-fade-in>*:nth-child(1) {
            animation-delay: 0.1s;
        }

        .stagger-fade-in>*:nth-child(2) {
            animation-delay: 0.2s;
        }

        .stagger-fade-in>*:nth-child(3) {
            animation-delay: 0.3s;
        }

        .stagger-fade-in>*:nth-child(4) {
            animation-delay: 0.4s;
        }

        /* Sesuaikan delay jika ada lebih banyak elemen di level yang sama di footer */
    </style>
</head>

<body class="flex flex-col min-h-screen font-sans text-gray-900">
    <div id="loading-overlay"
        class="fixed inset-0 bg-white z-50 flex items-center justify-center transition-opacity duration-300 opacity-100">
        <div class="animate-spin rounded-full h-12 w-12 border-4 border-t-4 border-teal-500 border-opacity-75"></div>
    </div>

    <div class="flex-grow">
        {{-- Pastikan @include('components.user-navbar') ini me-render elemen dengan kelas animate-navbar-slide-down --}}
        {{-- Contoh di Laravel Blade: Jika user-navbar.blade.php punya <nav class="bg-white">, ubah jadi <nav class="bg-white animate-navbar-slide-down"> --}}
        @include('components.user-navbar')
        <div class="pt-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 **animate-fade-in-up**">
            @yield('content')
        </div>
    </div>
    <footer id="footer" class="bg-gray-900 text-white mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 **stagger-fade-in**">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="col-span-1 lg:col-span-2">
                    <div class="flex items-center space-x-2 mb-4">
                        <div
                            class="w-10 h-10 bg-gradient-to-r from-green-500 to-emerald-600 rounded-full flex items-center justify-center">
                            <i class="fas fa-tree text-white text-lg"></i>
                        </div>
                        <span class="text-xl font-bold">totaCom</span>
                    </div>
                    <p class="text-gray-300 mb-4 max-w-md">
                        Nikmati pengalaman terbaik bersama totaCom, platform Anda untuk belanja kebutuhan pertanian.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#"
                            class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center hover:bg-blue-700 transition-colors duration-200">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#"
                            class="w-10 h-10 bg-pink-600 rounded-full flex items-center justify-center hover:bg-pink-700 transition-colors duration-200">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#"
                            class="w-10 h-10 bg-blue-400 rounded-full flex items-center justify-center hover:bg-blue-500 transition-colors duration-200">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#"
                            class="w-10 h-10 bg-green-600 rounded-full flex items-center justify-center hover:bg-green-700 transition-colors duration-200">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                    </div>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Tautan Cepat</h3>
                    <ul class="space-y-2">
                        <li><a href="/"
                                class="text-gray-300 hover:text-white transition-colors duration-200">Beranda</a></li>
                        <li><a href="{{ route('user.profile.index') }}"
                                class="text-gray-300 hover:text-white transition-colors duration-200">Produk</a></li>
                        <li><a href="{{ route('pesanan.buat') }}"
                                class="text-gray-300 hover:text-white transition-colors duration-200">Buat Pesanan</a>
                        </li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Kontak Kami</h3>
                    <div class="space-y-3">
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-map-marker-alt text-green-400"></i>
                            <span class="text-gray-300 text-sm">Area Pegunungan Argop, Suci, Kec. Panti,
                                Kab. Jember, Jawa Timur 68153</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-phone text-green-400"></i>
                            <span class="text-gray-300 text-sm">+62 812-3456-7890</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-envelope text-green-400"></i>
                            <span class="text-gray-300 text-sm">support@totacom.com</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-5 pt-5 flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-400 text-sm">
                    © {{ date('Y') }} totaCom. All rights reserved.
                </p>
                <div class="flex space-x-6 mt-4 md:mt-0">
                    <a href="#"
                        class="text-gray-400 hover:text-white text-sm transition-colors duration-200">Privacy Policy</a>
                    <a href="#"
                        class="text-gray-400 hover:text-white text-sm transition-colors duration-200">Terms of
                        Service</a>
                    <a href="#"
                        class="text-gray-400 hover:text-white text-sm transition-colors duration-200">Cookie
                        Policy</a>
                </div>
            </div>
        </div>
    </footer>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');
            const hamburgerIcon = document.getElementById('hamburger-icon');
            const closeIcon = document.getElementById('close-icon');
            const pesananSubmenu = document.getElementById('pesanan-submenu');
            const pesananToggleBtn = document.querySelector('.mobile-pesanan-toggle');
            const loadingOverlay = document.getElementById('loading-overlay');

            // Sembunyikan loading overlay dengan cepat setelah DOMContentLoaded
            // Memberikan waktu sangat singkat untuk CSS termuat dan elemen dirender
            setTimeout(() => {
                loadingOverlay.style.opacity = '0';
                setTimeout(() => {
                    loadingOverlay.style.display = 'none';
                }, 300); // Durasi transisi opacity overlay (0.3s)
            }, 100); // Penundaan awal yang sangat singkat (0.1s)

            mobileMenuButton.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
                mobileMenuButton.classList.toggle('open');
                hamburgerIcon.classList.toggle('hidden');
                closeIcon.classList.toggle('hidden');

                if (mobileMenu.classList.contains('hidden')) {
                    pesananSubmenu.classList.remove('open');
                    pesananToggleBtn.classList.remove('active');
                }
            });

            window.togglePesanan = function() {
                pesananSubmenu.classList.toggle('open');
                pesananToggleBtn.classList.toggle('active');
            }
        });
    </script>
</body>

</html>
