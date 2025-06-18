@extends('layouts.user') {{-- Pastikan ini mengacu ke layout untuk user dashboard --}}

@section('title', 'Dashboard Customer ')

@section('content')

    {{-- Hero Section Dashboard dengan Slideshow Background --}}
    <div class="relative h-[60vh] md:h-[70vh] flex items-center justify-center text-white overflow-hidden rounded-b-lg shadow-xl">
        {{-- Background Slideshow --}}
        <div id="dashboardSlideshow" class="absolute inset-0 z-0">
            {{-- Pastikan nama file gambar di sini sesuai dengan yang ada di storage/app/public/background --}}
            <img src="{{ asset('storage/background/bg_background1.jpeg') }}" class="absolute inset-0 w-full h-full object-cover opacity-100 transition-opacity duration-1000 ease-in-out" />
            <img src="{{ asset('storage/background/bg_background2.jpeg') }}" class="absolute inset-0 w-full h-full object-cover opacity-0 transition-opacity duration-1000 ease-in-out" />
            <img src="{{ asset('storage/background/bg_background3.jpeg') }}" class="absolute inset-0 w-full h-full object-cover opacity-0 transition-opacity duration-1000 ease-in-out" />
            {{-- Tambahkan lebih banyak gambar jika Anda punya --}}
        </div>

        {{-- Overlay untuk membuat teks lebih mudah dibaca --}}
        <div class="absolute inset-0 bg-black bg-opacity-60 z-10"></div>

        {{-- Main Content --}}
        <div class="relative z-20 flex flex-col items-center justify-center h-full text-center px-6 text-white animate-fade-in-up">
            <h1 class="text-4xl md:text-6xl font-extrabold mb-4 drop-shadow-lg leading-tight">
                Selamat Datang Di TotaCom, <br class="md:hidden"/> {{ Auth::user()->nama }}!
            </h1>
            <p class="text-lg md:text-2xl max-w-3xl mx-auto mb-10 drop-shadow-md opacity-90">
                Temukan berbagai peralatan dan kebutuhan pertanian terbaik untuk mendukung produktivitas Anda.
                Kami hadir untuk membantu petani Indonesia lebih maju, efisien, dan berdaya saing tinggi.
            </p>

            <div class="space-y-4 sm:space-y-0 sm:space-x-6 flex flex-col sm:flex-row justify-center">
                <a href="{{ route('pesanan.buat') }}"
                   class="bg-primary-600 hover:bg-primary-700 px-8 py-3 rounded-full text-xl font-semibold shadow-lg transition transform hover:scale-105 flex items-center justify-center">
                    <i class="fas fa-plus-circle mr-3"></i> Buat Pesanan
                </a>
                <a href="{{ route('pesanan.riwayat') }}"
                   class="bg-primary-600 hover:bg-primary-700 px-8 py-3 rounded-full text-xl font-semibold shadow-lg transition transform hover:scale-105 flex items-center justify-center">                    <i class="fas fa-history mr-3"></i> Riwayat Pesanan
                </a>
            </div>
        </div>
    </div>



    <div class="container mx-auto px-4 py-12"> {{-- Container untuk bagian di bawah hero section --}}

        {{-- Bagian Tentang Kami / Keunggulan Toko --}}
        <section class="bg-white p-8 rounded-lg shadow-xl border border-gray-200 mb-12 animate-fade-in-up" style="animation-delay: 0.2s;">
            <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center flex items-center justify-center">
                <i class="fas fa-mountain-sun text-primary-600 mr-3"></i> Kenapa Memilih TotaCom?
            </h2>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="flex flex-col items-center text-center p-6 bg-gray-50 rounded-lg shadow-sm hover:shadow-md transition-all duration-300">
                    <i class="fas fa-tents text-5xl text-primary-500 mb-4"></i>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Barang berkualitas</h3>
                    <p class="text-gray-600">Kami mungkin bukan yang termurah tapi kami bisa menjamin barang yang kami jual berkualitas tinggi</p>
                </div>
                <div class="flex flex-col items-center text-center p-6 bg-gray-50 rounded-lg shadow-sm hover:shadow-md transition-all duration-300">
                    <i class="fas fa-handshake-angle text-5xl text-primary-500 mb-4"></i>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Layanan Profesional</h3>
                    <p class="text-gray-600">kami siap membantu Anda dari pemilihan produk, Rekomendasi, hingga tata cara penggunaan jika dibutuhkan.</p>
                </div>
                <div class="flex flex-col items-center text-center p-6 bg-gray-50 rounded-lg shadow-sm hover:shadow-md transition-all duration-300">
                    <i class="fas fa-truck-fast text-5xl text-primary-500 mb-4"></i>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Pengiriman Cepat</h3>
                    <p class="text-gray-600">Barang anda akan dikirim secepatnya karna kepuasan pelanggan yang utama.</p>
                </div>
            </div>
        </section>

{{-- Bagian Alamat Lokasi --}}
<section class="bg-white p-8 rounded-lg shadow-xl border border-gray-200 mb-12 animate-fade-in-up" style="animation-delay: 0.4s;">
    <h2 class="text-3xl font-bold mb-8 text-center flex items-center justify-center">
        <i class="fas fa-map-marker-alt text-white mr-3"></i> Lokasi Toko Kami
    </h2>
    <div class="grid md:grid-cols-2 gap-8 items-center">
        {{-- Kolom Alamat Teks --}}
        <div class="bg-white text-gray-800 p-6 rounded-lg shadow-md">
            <h3 class="text-xl font-bold mb-3 flex items-center text-primary-700">
                <i class="fas fa-store mr-2"></i> Alamat Lengkap
            </h3>
            <p class="text-lg italic mb-4">Jl. Wolter Monginsidi No.89, Langsepam, Rowo Indah, Kec. Ajung, Kabupaten Jember, Jawa Timur 68175</p>

            <div class="mb-3">
                <p class="text-sm text-gray-600">Jam Operasional:</p>
                <p class="font-medium text-gray-700">Senin - Sabtu: 08.00 - 17.00 WIB</p>
            </div>

            <div class="mt-4">
                <a href="https://www.google.com/maps/place/Toko+Pertanian+SUMBERDADI/@-8.2098475,113.7125824,985m/data=!3m2!1e3!4b1!4m6!3m5!1s0x2dd696f7d10ace89:0xd889be3d4aa49522!8m2!3d-8.2098475!4d113.7151627!16s%2Fg%2F11ddxp5_k8?entry=ttu"
                   target="_blank" rel="noopener noreferrer"
                   class="inline-block bg-primary-600 hover:bg-primary-800 text-white px-5 py-2 rounded-full font-semibold transition transform hover:scale-105">
                    <i class="fas fa-map-location-dot mr-2"></i> Buka di Google Maps
                </a>
            </div>
        </div>

        {{-- Kolom Gambar Thumbnail Map --}}
        <div class="bg-white p-3 rounded-lg shadow-md">
            <a href="https://www.google.com/maps/place/Toko+Pertanian+SUMBERDADI/@-8.2098475,113.7125824,985m/data=!3m2!1e3!4b1!4m6!3m5!1s0x2dd696f7d10ace89:0xd889be3d4aa49522!8m2!3d-8.2098475!4d113.7151627!16s%2Fg%2F11ddxp5_k8?entry=ttu"
               target="_blank" rel="noopener noreferrer">
                <img src="{{ asset('storage/background/map_thumbnail.png') }}"
                     alt="Peta Lokasi TotaCom"
                     class="rounded-lg shadow-lg hover:opacity-90 transition-opacity duration-300 w-full h-56 object-cover">
                <p class="text-center mt-2 text-primary-700 font-semibold">Klik untuk melihat peta lebih besar</p>
            </a>
        </div>
    </div>
</section>

        {{-- Bagian Aktivitas Terkini (Pesanan Terbaru) --}}
        <section class="bg-white p-8 rounded-lg shadow-xl border border-gray-200 mb-12 animate-fade-in-up" style="animation-delay: 0.6s;">
            <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center flex items-center justify-center">
                <i class="fas fa-calendar-check text-primary-600 mr-3"></i> Pesanan Terbaru Anda
            </h2>
            <div class="space-y-6">
                @forelse($latestOrders as $pesanan)
                    <a href="{{ route('pesanan.riwayat', $pesanan->id_pesanan) }}" {{-- KONSISTEN DENGAN KODE ANDA --}}
                        class="block p-5 bg-gray-50 rounded-lg border border-gray-100 hover:bg-primary-50 transition-colors duration-200 group">
                        <div class="flex flex-col md:flex-row items-start md:items-center justify-between">
                            <div class="flex items-center space-x-4 mb-3 md:mb-0">
                                <div class="p-3 bg-primary-100 rounded-full text-primary-700 group-hover:bg-primary-200 transition-colors">
                                    <i class="fas fa-receipt text-xl"></i>
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-800 text-lg">Order Terbaru Anda</p>
                                    <p class="text-sm text-gray-500">
                                        Tanggal: {{ \Carbon\Carbon::parse($pesanan->created_at)->format('d M Y H:i') }}
                                    </p>
                                </div>
                            </div>
                            <div class="text-left md:text-right">
                                <p class="text-sm text-gray-500 mb-1">Status:</p>
                                <span class="font-bold text-lg
                                    @if ($pesanan->status->id_status == 1) text-yellow-600 @endif
                                    @if ($pesanan->status->id_status == 2) text-blue-600 @endif
                                    @if ($pesanan->status->id_status == 3) text-green-600 @endif
                                    @if ($pesanan->status->id_status == 4) text-red-600 @endif
                                ">{{ $pesanan->status->nama_status }}</span>
                            </div>
                        </div>
                    </a>
                @empty
                    <p class="text-gray-500 text-center py-8 text-xl">
                        Anda belum memiliki pesanan terbaru. <br/>
                        <a href="{{ route('pesanan.buat') }}" class="text-primary-600 hover:underline font-medium mt-2 block">Mulai petualangan Anda dengan membuat pesanan pertama</a>!
                    </p>
                @endforelse

                @if($latestOrders->count() > 0)
                    <div class="text-center mt-8">
                        <a href="{{ route('pesanan.riwayat') }}"
                            class="inline-flex items-center text-primary-600 hover:text-primary-800 font-semibold transition-colors duration-200 text-lg group-hover:underline">
                            Lihat Semua Riwayat Pesanan <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
                        </a>
                    </div>
                @endif
            </section>


        {{-- Bagian Rekomendasi Produk --}}
        <section class="bg-white p-8 rounded-lg shadow-xl border border-gray-200 animate-fade-in-up" style="animation-delay: 0.8s;">
            <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center flex items-center justify-center">
                <i class="fas fa-fire text-red-500 mr-3"></i> Jelajahi Produk Rekomendasi
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                @forelse($recommendedProducts as $produk)
                    <a href="{{ route('user.produk.index', $produk->id_produk) }}" {{-- KONSISTEN DENGAN KODE ANDA --}}
                       class="block border border-gray-200 rounded-xl overflow-hidden shadow-sm hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1 group">
                        @if ($produk->gambar)
                            <img src="{{ asset('storage/' . $produk->gambar) }}"
                                class="w-full h-56 object-cover rounded-t-xl group-hover:scale-105 transition-transform duration-300" alt="{{ $produk->nama_produk }}">
                        @else
                            <div
                                class="w-full h-56 bg-gray-100 rounded-t-xl flex items-center justify-center text-gray-400">
                                <i class="fas fa-box-open text-6xl"></i>
                            </div>
                        @endif
                        <div class="p-5">
                            <h3 class="font-bold text-xl text-gray-800 mb-2 group-hover:text-primary-600 transition-colors line-clamp-1">{{ $produk->nama_produk }}</h3>
                            <p class="text-gray-600 text-sm mb-4 line-clamp-2">{{ $produk->deskripsi ?? 'Tidak ada deskripsi.' }}</p>
                            <div class="flex justify-between items-center">
                                <span class="text-primary-700 font-bold text-2xl">Rp{{ number_format($produk->harga, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </a>
                @empty
                    <p class="text-gray-500 col-span-full text-center py-8 text-xl">
                        Tidak ada produk rekomendasi saat ini. <br/>
                        <a href="{{ route('user.produk.index') }}" class="text-primary-600 hover:underline font-medium mt-2 block">Jelajahi semua penawaran produk kami</a>!
                    </p>
                @endforelse
            </div>
            <div class="text-center mt-10">
                <a href="{{ route('user.produk.index') }}"
                    class="inline-flex items-center bg-primary-100 text-primary-800 hover:bg-primary-200 px-10 py-4 rounded-full text-xl font-semibold hover:bg-primary-600 transition-colors duration-200 shadow-lg transform hover:-translate-y-1 hover:scale-105">
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

            dashboardSlides[currentDashboardSlide].classList.remove('opacity-100');
            dashboardSlides[currentDashboardSlide].classList.add('opacity-0');

            currentDashboardSlide = (currentDashboardSlide + 1) % dashboardSlides.length;

            dashboardSlides[currentDashboardSlide].classList.remove('opacity-0');
            dashboardSlides[currentDashboardSlide].classList.add('opacity-100');
        }

        // Start slideshow only if there's more than one image
        if (dashboardSlides.length > 1) {
            setInterval(showNextDashboardSlide, 2000); // Change image every 2 seconds
        }
    </script>

    <style>
        /* Tetap sertakan animasi yang sudah ada, atau tambahkan yang baru jika perlu */
        @keyframes fadeInDown {
            0% { opacity: 0; transform: translateY(-30px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        @keyframes fadeInUp {
            0% { opacity: 0; transform: translateY(30px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in-up {
            animation: fadeInUp 1s ease-out forwards;
        }
        .animate-fade-in-down {
            animation: fadeInDown 1s ease-out forwards;
        }
    </style>
@endsection
