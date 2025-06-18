@extends('layouts.user')

@section('title', 'Dashboard Customer TotaCom')

@section('content')
    <div
        class="relative h-[65vh] md:h-[80vh] mt-12 flex items-center justify-center text-white overflow-hidden rounded-xl shadow-2xl">
        <div id="dashboardSlideshow" class="absolute inset-0 z-0">
            <img src="{{ asset('storage/background/bg_background1.jpeg') }}"
                class="absolute inset-0 w-full h-full object-cover opacity-100 transition-opacity duration-1000 ease-in-out"
                alt="Background Image 1" />
            <img src="{{ asset('storage/background/bg_background2.jpeg') }}"
                class="absolute inset-0 w-full h-full object-cover opacity-0 transition-opacity duration-1000 ease-in-out"
                alt="Background Image 2" />
            <img src="{{ asset('storage/background/bg_background3.jpeg') }}"
                class="absolute inset-0 w-full h-full object-cover opacity-0 transition-opacity duration-1000 ease-in-out"
                alt="Background Image 3" />
        </div>

        <div class="absolute inset-0 bg-gradient-to-t from-black via-black/60 to-transparent z-10"></div>
        <div class="absolute inset-0 bg-teal-800 opacity-30 z-10"></div>

        {{-- Main Content --}}
        <div
            class="relative z-20 flex flex-col items-center justify-center h-full text-center px-6 text-white animate-fade-in-up">
            <h1 class="text-4xl md:text-6xl font-extrabold mb-4 drop-shadow-lg leading-tight">
                Selamat Datang di <span class="text-teal-300">TotaCom</span>, <br class="md:hidden" />
                {{ Auth::user()->nama }}!
            </h1>
            <p class="text-lg md:text-2xl max-w-3xl mx-auto mb-10 drop-shadow-md opacity-90">
                Temukan berbagai peralatan dan kebutuhan pertanian terbaik untuk mendukung produktivitas Anda.
                Kami hadir untuk membantu petani Indonesia lebih maju, efisien, dan berdaya saing tinggi.
            </p>

            <div class="space-y-4 sm:space-y-0 sm:space-x-6 flex flex-col sm:flex-row justify-center">
                <a href="{{ route('pesanan.buat') }}"
                    class="group inline-flex items-center justify-center bg-teal-600 hover:bg-teal-700 px-8 py-3 rounded-full text-xl font-semibold shadow-lg transition-all duration-300 transform hover:scale-105 border-2 border-teal-600 hover:border-teal-700 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-opacity-75">
                    <i class="fas fa-plus-circle mr-3 group-hover:rotate-6 transition-transform"></i> Buat Pesanan Baru
                </a>
                <a href="{{ route('pesanan.riwayat') }}"
                    class="group inline-flex items-center justify-center bg-transparent border-2 border-white hover:border-teal-300 text-white hover:text-teal-300 px-8 py-3 rounded-full text-xl font-semibold shadow-lg transition-all duration-300 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-white focus:ring-opacity-75">
                    <i class="fas fa-history mr-3 group-hover:scale-110 transition-transform"></i> Riwayat Pesanan
                </a>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-4 py-12">

        <section class="bg-white p-8 rounded-xl shadow-xl border border-gray-100 mb-12 animate-fade-in-up"
            style="animation-delay: 0.2s;">
            <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center flex items-center justify-center">
                <i class="fas fa-seedling text-teal-600 mr-3 text-4xl"></i> Kenapa Memilih <span
                    class="text-teal-700">TotaCom</span>?
            </h2>
            <div class="grid md:grid-cols-3 gap-8">
                <div
                    class="flex flex-col items-center text-center p-6 bg-teal-50 rounded-lg shadow-md hover:shadow-lg transition-all duration-300 border border-teal-100">
                    <i class="fas fa-award text-5xl text-teal-500 mb-4 animate-bounce-slow"></i>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Produk Berkualitas Tinggi</h3>
                    <p class="text-gray-600">Kami menjamin setiap produk yang kami tawarkan memiliki kualitas terbaik untuk
                        mendukung hasil pertanian Anda.</p>
                </div>
                <div
                    class="flex flex-col items-center text-center p-6 bg-teal-50 rounded-lg shadow-md hover:shadow-lg transition-all duration-300 border border-teal-100">
                    <i class="fas fa-headset text-5xl text-teal-500 mb-4 animate-bounce-slow"
                        style="animation-delay: 0.1s;"></i>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Layanan Pelanggan Profesional</h3>
                    <p class="text-gray-600">Tim ahli kami siap membantu Anda mulai dari konsultasi produk hingga panduan
                        penggunaan.</p>
                </div>
                <div
                    class="flex flex-col items-center text-center p-6 bg-teal-50 rounded-lg shadow-md hover:shadow-lg transition-all duration-300 border border-teal-100">
                    <i class="fas fa-shipping-fast text-5xl text-teal-500 mb-4 animate-bounce-slow"
                        style="animation-delay: 0.2s;"></i>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Pengiriman Cepat & Aman</h3>
                    <p class="text-gray-600">Kami memastikan pesanan Anda tiba dengan cepat dan dalam kondisi prima, karena
                        kepuasan Anda prioritas kami.</p>
                </div>
            </div>
        </section>

        <section class="bg-white p-8 rounded-xl shadow-xl border border-gray-100 mb-12 animate-fade-in-up"
            style="animation-delay: 0.4s;">
            <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center flex items-center justify-center">
                <i class="fas fa-map-marker-alt text-teal-600 mr-3 text-4xl"></i> Lokasi Toko Kami
            </h2>
            <div class="grid md:grid-cols-2 gap-8 items-center">
                <div class="bg-teal-50 text-gray-800 p-6 rounded-lg shadow-md border border-teal-100">
                    <h3 class="text-xl font-bold mb-3 flex items-center text-teal-700">
                        <i class="fas fa-store mr-2"></i> Alamat Lengkap TotaCom
                    </h3>
                    <p class="text-lg italic mb-4">Jl. Wolter Monginsidi No.89, Langsepam, Rowo Indah, Kec. Ajung, Kabupaten
                        Jember, Jawa Timur 68175</p>

                    <div class="mb-3">
                        <p class="text-sm text-gray-600">Jam Operasional:</p>
                        <p class="font-medium text-gray-700">Senin - Sabtu: <span class="font-bold text-teal-700">08.00 -
                                17.00 WIB</span></p>
                    </div>

                    <div class="mt-4">
                        <a href="https://www.google.com/maps/search/Jl.+Wolter+Monginsidi+No.89,+Langsepam,+Rowo+Indah,+Kec.+Ajung,+Kabupaten+Jember,+Jawa+Timur+68175"
                            target="_blank" rel="noopener noreferrer"
                            class="inline-block bg-teal-600 hover:bg-teal-700 text-white px-5 py-2 rounded-full font-semibold transition transform hover:scale-105 shadow-md focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-opacity-75">
                            <i class="fas fa-directions mr-2"></i> Buka di Google Maps
                        </a>
                    </div>
                </div>

                <div class="bg-teal-50 p-3 rounded-lg shadow-md border border-teal-100">
                    <a href="https://www.google.com/maps/search/Jl.+Wolter+Monginsidi+No.89,+Langsepam,+Rowo+Indah,+Kec.+Ajung,+Kabupaten+Jember,+Jawa+Timur+68175"
                        target="_blank" rel="noopener noreferrer">
                        <img src="{{ asset('storage/background/map_thumbnail.png') }}" alt="Peta Lokasi TotaCom"
                            class="rounded-lg shadow-lg hover:opacity-90 transition-opacity duration-300 w-full h-56 object-cover">
                        <p class="text-center mt-2 text-teal-700 font-semibold">Klik untuk melihat peta lebih besar</p>
                    </a>
                </div>
            </div>
        </section>

        <section class="bg-white p-8 rounded-xl shadow-xl border border-gray-100 mb-12 animate-fade-in-up"
            style="animation-delay: 0.6s;">
            <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center flex items-center justify-center">
                <i class="fas fa-receipt text-teal-600 mr-3 text-4xl"></i> Pesanan Terbaru Anda
            </h2>
            <div class="space-y-6">
                @forelse($latestOrders as $pesanan)
                    <a href="{{ route('pesanan.riwayat') }}"
                        class="block p-5 bg-teal-50 rounded-lg border border-teal-100 hover:bg-teal-100 transition-colors duration-200 group shadow-sm">
                        <div class="flex flex-col md:flex-row items-start md:items-center justify-between">
                            <div class="flex items-center space-x-4 mb-3 md:mb-0">
                                <div
                                    class="p-3 bg-teal-100 rounded-full text-teal-700 group-hover:bg-teal-200 transition-colors">
                                    <i class="fas fa-shopping-basket text-xl"></i>
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-800 text-lg">Pesanan
                                        #PSN{{ str_pad($pesanan->id_pesanan, 4, '0', STR_PAD_LEFT) }}</p>
                                    <p class="text-sm text-gray-600">
                                        Tanggal: <span
                                            class="font-medium text-teal-700">{{ \Carbon\Carbon::parse($pesanan->created_at)->format('d M Y, H:i') }}</span>
                                    </p>
                                </div>
                            </div>
                            <div class="text-left md:text-right">
                                @php
                                    $statusIdClasses = [
                                        1 => 'bg-yellow-100 text-yellow-800', // Pending/Menunggu Pembayaran
                                        2 => 'bg-blue-100 text-blue-800', // Diproses/Dikemas
                                        3 => 'bg-indigo-100 text-indigo-800', // Dikirim
                                        4 => 'bg-green-100 text-green-800', // Selesai
                                        5 => 'bg-red-100 text-red-800', // Dibatalkan/Gagal
                                    ];
                                    $statusClass =
                                        $statusIdClasses[$pesanan->status->id_status] ?? 'bg-gray-100 text-gray-800';
                                @endphp
                                <span class="px-3 py-1 rounded-full text-sm font-semibold {{ $statusClass }}">
                                    {{ $pesanan->status->nama_status }}
                                </span>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="bg-teal-50 p-6 rounded-lg text-center border border-teal-100 shadow-sm">
                        <p class="text-gray-500 py-4 text-lg">
                            Anda belum memiliki pesanan terbaru. <br />
                            <a href="{{ route('pesanan.buat') }}"
                                class="text-teal-600 hover:underline font-semibold mt-2 inline-block">Mulai petualangan Anda
                                dengan membuat pesanan pertama</a>!
                        </p>
                    </div>
                @endforelse

                @if (isset($latestOrders) && $latestOrders->count() > 0)
                    {{-- Perbaikan: Tambahkan isset() check --}}
                    <div class="text-center mt-8">
                        <a href="{{ route('pesanan.riwayat') }}"
                            class="inline-flex items-center text-teal-600 hover:text-teal-800 font-semibold transition-colors duration-200 text-lg group-hover:underline">
                            Lihat Semua Riwayat Pesanan <i
                                class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
                        </a>
                    </div>
                @endif
        </section>

        <section class="bg-white p-8 rounded-xl shadow-xl border border-gray-100 animate-fade-in-up"
            style="animation-delay: 0.8s;">
            <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center flex items-center justify-center">
                <i class="fas fa-lightbulb text-teal-600 mr-3 text-4xl"></i> Jelajahi Produk
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                @forelse($recommendedProducts as $produk)
                    <a href="{{ route('user.produk.index', $produk->id_produk) }}"
                        class="block bg-teal-50 rounded-xl overflow-hidden shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1 group border border-teal-100">
                        @if ($produk->gambar)
                            <img src="{{ asset('storage/' . $produk->gambar) }}"
                                class="w-full h-56 object-cover rounded-t-xl group-hover:scale-105 transition-transform duration-300"
                                alt="{{ $produk->nama_produk }}">
                        @else
                            <div
                                class="w-full h-56 bg-gray-100 rounded-t-xl flex items-center justify-center text-gray-400">
                                <i class="fas fa-box-open text-6xl"></i>
                            </div>
                        @endif
                        <div class="p-5">
                            <h3
                                class="font-bold text-xl text-gray-800 mb-2 group-hover:text-teal-700 transition-colors line-clamp-1">
                                {{ $produk->nama_produk }}</h3>
                            <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                                {{ $produk->deskripsi ?? 'Tidak ada deskripsi.' }}</p>
                            <div class="flex justify-between items-center">
                                <span
                                    class="text-teal-700 font-bold text-xl">Rp{{ number_format($produk->harga, 0, ',', '.') }}</span>
                                <button
                                    class="bg-teal-600 hover:bg-teal-700 text-white px-4 py-2 rounded-full text-sm font-semibold shadow-md transition transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-opacity-75">
                                    <i class="fas fa-shopping-cart mr-1"></i> Beli
                                </button>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="bg-teal-50 p-6 rounded-lg text-center border border-teal-100 shadow-sm col-span-full">
                        <p class="text-gray-500 py-4 text-lg">
                            Tidak ada produk saat ini. <br />
                            <a href="{{ route('user.produk.index') }}"
                                class="text-teal-600 hover:underline font-semibold mt-2 inline-block">Jelajahi semua
                                penawaran produk kami</a>!
                        </p>
                    </div>
                @endforelse
            </div>
            <div class="text-center mt-10">
                <a href="{{ route('user.produk.index') }}"
                    class="inline-flex items-center bg-teal-600 text-white hover:bg-teal-700 px-10 py-4 rounded-full text-xl font-semibold transition-colors duration-200 shadow-lg transform hover:-translate-y-1 hover:scale-105 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-opacity-75">
                    Lihat Semua Produk <i class="fas fa-arrow-right ml-3 text-xl"></i>
                </a>
            </div>
        </section>
    </div>

    {{-- Script untuk slideshow dan animasi --}}
    <script>
        // Slideshow Script for Dashboard Hero Section
        const dashboardSlides = document.querySelectorAll('#dashboardSlideshow img');
        let currentDashboardSlide = 0;

        function showNextDashboardSlide() {
            // Check if there are slides to prevent errors if the array is empty
            if (dashboardSlides.length === 0) return;

            // Remove opacity-100 from current slide and add opacity-0
            dashboardSlides[currentDashboardSlide].classList.remove('opacity-100');
            dashboardSlides[currentDashboardSlide].classList.add('opacity-0');

            // Move to the next slide
            currentDashboardSlide = (currentDashboardSlide + 1) % dashboardSlides.length;

            // Remove opacity-0 from next slide and add opacity-100
            dashboardSlides[currentDashboardSlide].classList.remove('opacity-0');
            dashboardSlides[currentDashboardSlide].classList.add('opacity-100');
        }

        // Start slideshow only if there's more than one image
        if (dashboardSlides.length > 1) {
            setInterval(showNextDashboardSlide, 4000); // Change image every 4 seconds (diperpanjang agar lebih nyaman)
        }

        // Animasi CSS untuk Bounce pada Icon
        // Ini adalah contoh, Anda bisa menempatkan ini di CSS global jika ingin berulang di banyak tempat
        const style = document.createElement('style');
        style.innerHTML = `
            @keyframes bounceSlow {
                0%, 100% {
                    transform: translateY(0);
                }
                50% {
                    transform: translateY(-10px);
                }
            }
            .animate-bounce-slow {
                animation: bounceSlow 3s infinite ease-in-out;
            }
        `;
        document.head.appendChild(style);
    </script>
@endsection
