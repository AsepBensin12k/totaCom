@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50">
        <div class="container mx-auto px-4 py-4">
            <!-- Header -->
            <div class="mb-8 animate-fade-in">
                <h1 class="text-4xl font-bold text-gray-800 mb-2">Dashboard Admin</h1>
                <p class="text-gray-600">Selamat datang kembali! Berikut adalah ringkasan bisnis Anda hari ini.</p>
            </div>

            <!-- Quick Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Revenue Card -->
                <div class="bg-gradient-to-r from-green-400 to-green-600 rounded-xl shadow-lg p-6 text-white transform hover:scale-105 transition-all duration-300 animate-slide-up"
                    style="animation-delay: 0.1s">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-green-100 text-sm font-medium">Total Revenue</p>
                            <p class="text-3xl font-bold">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
                            <p class="text-green-100 text-xs mt-1">
                                @if ($growthRate >= 0)
                                    <span class="text-green-200">↗ +{{ number_format($growthRate, 1) }}%</span>
                                @else
                                    <span class="text-red-200">↘ {{ number_format($growthRate, 1) }}%</span>
                                @endif
                                dari bulan lalu
                            </p>
                        </div>
                        <div class="bg-white bg-opacity-20 rounded-full p-3">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1">
                                </path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Orders Card -->
                <div class="bg-gradient-to-r from-blue-400 to-blue-600 rounded-xl shadow-lg p-6 text-white transform hover:scale-105 transition-all duration-300 animate-slide-up"
                    style="animation-delay: 0.2s">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-blue-100 text-sm font-medium">Total Pesanan</p>
                            <p class="text-3xl font-bold">{{ $totalPesanan }}</p>
                            <p class="text-blue-100 text-xs mt-1">{{ $totalPesananSelesai }} selesai</p>
                        </div>
                        <div class="bg-white bg-opacity-20 rounded-full p-3">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 11V7a4 4 0 00-8 0v4M5 9h14l-1 12H6L5 9z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Products Card -->
                <div class="bg-gradient-to-r from-purple-400 to-purple-600 rounded-xl shadow-lg p-6 text-white transform hover:scale-105 transition-all duration-300 animate-slide-up"
                    style="animation-delay: 0.3s">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-purple-100 text-sm font-medium">Total Produk</p>
                            <p class="text-3xl font-bold">{{ $totalProduk }}</p>
                            <p class="text-purple-100 text-xs mt-1">{{ $produkMenipis->count() }} stok menipis</p>
                        </div>
                        <div class="bg-white bg-opacity-20 rounded-full p-3">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Users Card -->
                <div class="bg-gradient-to-r from-orange-400 to-orange-600 rounded-xl shadow-lg p-6 text-white transform hover:scale-105 transition-all duration-300 animate-slide-up"
                    style="animation-delay: 0.4s">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-orange-100 text-sm font-medium">Total User</p>
                            <p class="text-3xl font-bold">{{ $totalAkun }}</p>
                            <p class="text-orange-100 text-xs mt-1">Pengguna terdaftar</p>
                        </div>
                        <div class="bg-white bg-opacity-20 rounded-full p-3">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z">
                                </path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Today's Performance & Alerts -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
                <!-- Today's Revenue -->
                <div class="bg-white rounded-xl shadow-lg p-6 animate-slide-up" style="animation-delay: 0.5s">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                        <span class="bg-green-100 p-2 rounded-lg mr-3">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                            </svg>
                        </span>
                        Revenue Hari Ini
                    </h3>
                    <p class="text-3xl font-bold text-green-600">Rp {{ number_format($revenueHariIni, 0, ',', '.') }}</p>
                    <p class="text-gray-500 text-sm mt-2">Bulan ini: Rp {{ number_format($revenueBulanIni, 0, ',', '.') }}
                    </p>
                </div>

                <!-- Pending Orders Alert -->
                <div class="bg-white rounded-xl shadow-lg p-6 animate-slide-up" style="animation-delay: 0.6s">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                        <span class="bg-yellow-100 p-2 rounded-lg mr-3">
                            <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z">
                                </path>
                            </svg>
                        </span>
                        Pesanan Pending
                    </h3>
                    <p class="text-3xl font-bold text-yellow-600">{{ $pesananPending }}</p>
                    <p class="text-gray-500 text-sm mt-2">Memerlukan perhatian</p>
                </div>

                <!-- Low Stock Alert -->
                <div class="bg-white rounded-xl shadow-lg p-6 animate-slide-up" style="animation-delay: 0.7s">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                        <span class="bg-red-100 p-2 rounded-lg mr-3">
                            <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z">
                                </path>
                            </svg>
                        </span>
                        Stok Menipis
                    </h3>
                    <p class="text-3xl font-bold text-red-600">{{ $produkMenipis->count() }}</p>
                    <p class="text-gray-500 text-sm mt-2">Produk stok ≤ 5</p>
                </div>
            </div>

            <!-- Charts Section -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                <!-- Sales Chart -->
                <div class="bg-white rounded-xl shadow-lg p-6 animate-slide-up" style="animation-delay: 0.8s">
                    <h3 class="text-lg font-semibold text-gray-800 mb-6">Penjualan 7 Hari Terakhir</h3>
                    <div class="space-y-4">
                        @foreach ($dailySales as $index => $sale)
                            <div class="flex items-center space-x-4">
                                <span class="w-16 text-sm text-gray-600 font-medium">{{ $sale['date'] }}</span>
                                <div class="flex-1 bg-gray-200 rounded-full h-3 relative overflow-hidden">
                                    <div class="bg-gradient-to-r from-blue-400 to-blue-600 h-3 rounded-full transition-all duration-1000 ease-out chart-bar"
                                        data-width="{{ $sale['sales'] > 0 ? min(100, ($sale['sales'] / max(array_column($dailySales, 'sales'))) * 100) : 0 }}%"
                                        style="width: 0%">
                                    </div>
                                </div>
                                <span class="w-24 text-sm text-gray-700 font-semibold text-right">
                                    Rp {{ number_format($sale['sales'], 0, ',', '.') }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Order Status Distribution -->
                <div class="bg-white rounded-xl shadow-lg p-6 animate-slide-up" style="animation-delay: 0.9s">
                    <h3 class="text-lg font-semibold text-gray-800 mb-6">Distribusi Status Pesanan</h3>
                    <div class="space-y-4">
                        @php
                            $colors = ['bg-yellow-400', 'bg-blue-400', 'bg-green-400', 'bg-red-400', 'bg-purple-400'];
                            $totalOrders = $statusDistribution->sum('total');
                        @endphp
                        @foreach ($statusDistribution as $index => $status)
                            @php
                                $percentage = $totalOrders > 0 ? ($status->total / $totalOrders) * 100 : 0;
                            @endphp
                            <div class="flex items-center space-x-4">
                                <div class="w-4 h-4 rounded-full {{ $colors[$index % count($colors)] }}"></div>
                                <span class="flex-1 text-gray-700">{{ $status->nama_status }}</span>
                                <div class="w-32 bg-gray-200 rounded-full h-2">
                                    <div class="{{ $colors[$index % count($colors)] }} h-2 rounded-full transition-all duration-1000 ease-out status-bar"
                                        data-width="{{ $percentage }}%" style="width: 0%">
                                    </div>
                                </div>
                                <span class="w-12 text-sm text-gray-600 text-right">{{ $status->total }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Tables Section -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                <!-- Top Products -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden animate-slide-up" style="animation-delay: 1.0s">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-800">Produk Terlaris Bulan Ini</h3>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Rank</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Produk</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Terjual</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($produkTerlaris as $index => $produk)
                                    <tr class="hover:bg-gray-50 transition-colors duration-200">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-gradient-to-r from-yellow-400 to-orange-500 text-white font-bold text-sm">
                                                {{ $index + 1 }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-900">{{ $produk->nama_produk }}</td>
                                        <td class="px-6 py-4 text-sm font-semibold text-green-600">
                                            {{ $produk->total_terjual }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="px-6 py-4 text-center text-gray-500">Tidak ada data</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Recent Orders -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden animate-slide-up" style="animation-delay: 1.1s">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-800">Pesanan Terbaru</h3>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        ID</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Customer</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($pesananTerbaru as $pesanan)
                                    <tr class="hover:bg-gray-50 transition-colors duration-200">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            #{{ $pesanan->id_pesanan }}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-900">{{ $pesanan->akun->nama ?? 'Guest' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @php
                                                $statusColors = [
                                                    1 => 'bg-yellow-100 text-yellow-800',
                                                    2 => 'bg-blue-100 text-blue-800',
                                                    3 => 'bg-green-100 text-green-800',
                                                    4 => 'bg-red-100 text-red-800',
                                                ];
                                            @endphp
                                            <span
                                                class="inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ $statusColors[$pesanan->id_status] ?? 'bg-gray-100 text-gray-800' }}">
                                                {{ $pesanan->status->nama_status ?? 'Unknown' }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="px-6 py-4 text-center text-gray-500">Tidak ada pesanan
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Low Stock Alert Table -->
            @if ($produkMenipis->count() > 0)
                <div class="bg-white rounded-xl shadow-lg overflow-hidden animate-slide-up mb-8"
                    style="animation-delay: 1.2s">
                    <div class="px-6 py-4 border-b border-gray-200 bg-red-50">
                        <h3 class="text-lg font-semibold text-red-800 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z">
                                </path>
                            </svg>
                            Alert: Produk Stok Menipis
                        </h3>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full">
                            <thead class="bg-red-50">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-red-700 uppercase tracking-wider">
                                        ID</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-red-700 uppercase tracking-wider">
                                        Nama Produk</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-red-700 uppercase tracking-wider">
                                        Stok</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-red-700 uppercase tracking-wider">
                                        Status</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($produkMenipis as $produk)
                                    <tr class="hover:bg-red-50 transition-colors duration-200">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {{ $produk->id_produk }}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-900">{{ $produk->nama_produk }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="text-lg font-bold text-red-600">{{ $produk->stok }}</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if ($produk->stok == 0)
                                                <span
                                                    class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                                    Habis
                                                </span>
                                            @elseif($produk->stok <= 2)
                                                <span
                                                    class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                                    Kritis
                                                </span>
                                            @else
                                                <span
                                                    class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                    Rendah
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif

            <!-- Category Performance -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden animate-slide-up" style="animation-delay: 1.3s">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800">Performa Kategori Bulan Ini</h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @php
                            $categoryColors = [
                                'bg-red-500',
                                'bg-blue-500',
                                'bg-green-500',
                                'bg-yellow-500',
                                'bg-purple-500',
                                'bg-pink-500',
                                'bg-indigo-500',
                                'bg-teal-500',
                            ];
                            $maxSales = $kategoriTerlaris->max('total_terjual');
                        @endphp
                        @forelse($kategoriTerlaris as $index => $kategori)
                            <div class="bg-gray-50 rounded-lg p-4 hover:bg-gray-100 transition-colors duration-200 category-card"
                                data-index="{{ $index }}">
                                <div class="flex items-center justify-between mb-3">
                                    <h4 class="font-semibold text-gray-800">{{ $kategori->nama_jenis }}</h4>
                                    <div
                                        class="w-4 h-4 rounded-full {{ $categoryColors[$index % count($categoryColors)] }}">
                                    </div>
                                </div>
                                <div class="space-y-2">
                                    <div class="flex justify-between items-center">
                                        <span
                                            class="text-2xl font-bold text-gray-900">{{ $kategori->total_terjual }}</span>
                                        <span class="text-sm text-gray-500">terjual</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        <div class="{{ $categoryColors[$index % count($categoryColors)] }} h-2 rounded-full transition-all duration-1000 ease-out category-progress"
                                            data-width="{{ $maxSales > 0 ? ($kategori->total_terjual / $maxSales) * 100 : 0 }}%"
                                            style="width: 0%">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-full text-center text-gray-500 py-8">
                                Tidak ada data kategori
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Animation Keyframes */
        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes pulse {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }
        }

        /* Animation Classes */
        .animate-fade-in {
            animation: fadeIn 0.6s ease-out;
        }

        .animate-slide-up {
            animation: slideUp 0.6s ease-out;
            animation-fill-mode: both;
        }

        .animate-pulse-slow {
            animation: pulse 2s infinite;
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Animate chart bars
            setTimeout(() => {
                const chartBars = document.querySelectorAll('.chart-bar');
                chartBars.forEach(bar => {
                    const width = bar.getAttribute('data-width');
                    bar.style.width = width;
                });
            }, 500);

            // Animate status bars
            setTimeout(() => {
                const statusBars = document.querySelectorAll('.status-bar');
                statusBars.forEach(bar => {
                    const width = bar.getAttribute('data-width');
                    bar.style.width = width + '%';
                });
            }, 800);

            // Animate category progress bars
            setTimeout(() => {
                const categoryBars = document.querySelectorAll('.category-progress');
                categoryBars.forEach(bar => {
                    const width = bar.getAttribute('data-width');
                    bar.style.width = width + '%';
                });
            }, 1200);

            // Add hover effects to cards
            const cards = document.querySelectorAll('.category-card');
            cards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-2px)';
                    this.style.boxShadow = '0 4px 12px rgba(0, 0, 0, 0.15)';
                });

                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                    this.style.boxShadow = 'none';
                });
            });

            // Add click effects to stat cards
            const statCards = document.querySelectorAll('.grid .transform');
            statCards.forEach(card => {
                card.addEventListener('click', function() {
                    this.style.transform = 'scale(0.98)';
                    setTimeout(() => {
                        this.style.transform = 'scale(1.05)';
                    }, 100);
                    setTimeout(() => {
                        this.style.transform = 'scale(1)';
                    }, 200);
                });
            });

            // Auto-refresh data every 5 minutes
            setInterval(() => {
                console.log('Dashboard data refreshed');
            }, 300000);

            // Add loading animation for tables
            const tables = document.querySelectorAll('table tbody tr');
            tables.forEach((row, index) => {
                row.style.opacity = '0';
                row.style.transform = 'translateX(-20px)';
                setTimeout(() => {
                    row.style.transition = 'all 0.3s ease';
                    row.style.opacity = '1';
                    row.style.transform = 'translateX(0)';
                }, index * 100 + 1000);
            });

            // Add notification for critical stock
            const criticalStock = {{ $produkMenipis->where('stok', '<=', 2)->count() }};
            if (criticalStock > 0) {
                setTimeout(() => {
                    showNotification(`Perhatian! ${criticalStock} produk memiliki stok kritis`, 'warning');
                }, 2000);
            }

            function showNotification(message, type = 'info') {
                const notification = document.createElement('div');
                notification.className = `fixed top-4 right-4 z-50 p-4 rounded-lg shadow-lg transform translate-x-full
                transition-transform duration-300 ${
                type === 'warning' ? 'bg-yellow-500 text-white' : 'bg-blue-500 text-white'
                }`;
                notification.textContent = message;

                document.body.appendChild(notification);

                setTimeout(() => {
                    notification.style.transform = 'translateX(0)';
                }, 100);

                setTimeout(() => {
                    notification.style.transform = 'translateX(full)';
                    setTimeout(() => {
                        document.body.removeChild(notification);
                    }, 300);
                }, 5000);
            }

            // Real-time clock
            function updateClock() {
                const now = new Date();
                const timeString = now.toLocaleTimeString('id-ID');
                const dateString = now.toLocaleDateString('id-ID', {
                    weekday: 'long',
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                });

                // You can add a clock element to display this
                console.log(`${dateString} - ${timeString}`);
            }

            setInterval(updateClock, 1000);
            updateClock();
        });
    </script>
@endsection
