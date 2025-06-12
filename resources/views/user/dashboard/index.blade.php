@extends('layouts.user')

@section('title', 'Dashboard Customer - totaCom')

@section('content')

<div class="space-y-8 animate-fade-in-up mb-12"> {{-- Tambahkan kelas mb-12 di sini --}}
    <div class="bg-gradient-to-r from-teal-500 to-teal-600 text-white p-8 rounded-lg shadow-lg flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold mb-2">Halo, {{ Auth::user()->nama }}!</h1>
            <p class="text-teal-100 text-lg">Selamat datang di dashboard totaCom Anda.</p>
        </div>
        <div class="hidden md:block">
            <i class="fas fa-hand-holding-seedling text-5xl opacity-75"></i>
        </div>
    </div>

    {{-- Mengubah grid menjadi 2 kolom dan memposisikan di tengah --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 justify-items-center">
        <a href="{{ route('pesanan.buat') }}" class="block bg-white p-6 rounded-lg shadow-md hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border border-teal-200 hover:border-teal-500 w-full max-w-sm">
            <div class="flex items-center space-x-4">
                <div class="p-3 bg-teal-100 rounded-full text-teal-700">
                    <i class="fas fa-plus-circle text-xl"></i>
                </div>
                <div>
                    <h2 class="text-xl font-semibold text-gray-800">Buat Pesanan</h2>
                    <p class="text-gray-600 text-sm">Mulai pesanan baru Anda.</p>
                </div>
            </div>
        </a>

        <a href="{{ route('pesanan.riwayat') }}" class="block bg-white p-6 rounded-lg shadow-md hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border border-teal-200 hover:border-teal-500 w-full max-w-sm">
            <div class="flex items-center space-x-4">
                <div class="p-3 bg-teal-100 rounded-full text-teal-700">
                    <i class="fas fa-history text-xl"></i>
                </div>
                <div>
                    <h2 class="text-xl font-semibold text-gray-800">Riwayat Pesanan</h2>
                    <p class="text-gray-600 text-sm">Lihat semua pesanan Anda.</p>
                </div>
            </div>
        </a>
    </div>

<div class="bg-white p-6 rounded-lg shadow-md border border-gray-200">
    <h2 class="text-2xl font-bold text-gray-800 mb-4">Pesanan Terbaru Anda</h2>
    <div class="space-y-4">
        @forelse($latestOrders as $pesanan)
        <a href="{{ route('pesanan.riwayat') }}" class="block p-4 bg-gray-50 rounded-md border border-gray-100 hover:bg-teal-50 transition-colors duration-200">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <i class="fas fa-receipt text-teal-600 text-lg"></i>
                    <div>
                        <p class="font-medium text-gray-800">Pesanan Terbaru</p>
                        <p class="text-sm text-gray-500">Status:
                            <span class="font-semibold
                                @if($pesanan->status->id_status == 1) text-yellow-600 @endif
                                @if($pesanan->status->id_status == 2) text-blue-600 @endif
                                @if($pesanan->status->id_status == 3) text-green-600 @endif
                                @if($pesanan->status->id_status == 4) text-red-600 @endif
                            ">{{ $pesanan->status->nama_status }}</span>
                        </p>
                    </div>
                </div>
                <div class="text-right">
                    <p class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($pesanan->tanggal)->diffForHumans()}}</p>
                    <p class="font-bold text-gray-700">Rp {{ number_format($pesanan->detailPesanans->sum(function($d) { return ($d->qty ?? 0) * ($d->harga ?? 0); }), 0, ',', '.') }}</p>
                </div>
            </div>
        </a>
        @empty
        <p class="text-gray-500 text-center py-4">Anda belum memiliki pesanan terbaru.</p>
        @endforelse

        <div class="text-center mt-4">
            <a href="{{ route('pesanan.riwayat') }}" class="text-teal-600 hover:text-teal-800 font-semibold transition-colors duration-200">Lihat Semua Pesanan <i class="fas fa-arrow-right text-sm ml-1"></i></a>
        </div>
    </div>
</div>

    <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Produk Rekomendasi untuk Anda</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($recommendedProducts as $produk)
            <div class="border border-gray-200 rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-all duration-300">
                @if ($produk->gambar)
                    <img src="{{ asset('storage/' . $produk->gambar) }}" class="w-full h-40 object-cover rounded-t-lg" alt="{{ $produk->nama_produk }}">
                @else
                    <div class="w-full h-40 bg-gray-200 rounded-t-lg flex items-center justify-center text-gray-500">
                        No Image
                    </div>
                @endif
                <div class="p-4">
                    <h3 class="font-semibold text-lg text-gray-800 mb-1">{{ $produk->nama_produk }}</h3>
                    <p class="text-gray-600 text-sm mb-3 truncate">{{ $produk->deskripsi ?? 'Tidak ada deskripsi.' }}</p>
                    <div class="flex justify-between items-center">
                        <span class="text-teal-700 font-bold text-xl">Rp{{ number_format($produk->harga, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
            @empty
            <p class="text-gray-500 col-span-full text-center py-4">Tidak ada produk rekomendasi saat ini.</p>
            @endforelse
        </div>
        <div class="text-center mt-6">
            <a href="{{ route('user.produk.index') }}" class="bg-teal-500 text-white px-6 py-3 rounded-full text-lg font-semibold hover:bg-teal-600 transition-colors duration-200 shadow-md">
                Lihat Semua Produk <i class="fas fa-arrow-right ml-2"></i>
            </a>
        </div>
    </div>
</div>

@endsection
