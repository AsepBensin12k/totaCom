@extends('layouts.admin')

@section('title', 'Dashboard Analisis Produk')
@section('content')
    <div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50">
        <!-- Header Section with Animation -->
        <div class="container mx-auto px-6 py-8">
            <div class="text-center mb-8 animate-fade-in">
                <h1
                    class="text-4xl font-bold text-gray-800 mb-2 bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                    Dashboard Analisis Produk
                </h1>
                <p class="text-gray-600 text-lg">Insights bisnis totaCom</p>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div
                    class="bg-white rounded-xl shadow-lg p-6 transform hover:scale-105 transition-all duration-300 hover:shadow-xl border border-blue-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Total Produk Terjual</p>
                            <p class="text-3xl font-bold text-blue-600" id="totalProduk">
                                {{ number_format($statistikUmum->total_produk_terjual ?? 0) }}</p>
                        </div>
                        <div class="p-3 bg-blue-100 rounded-full">
                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="mt-2 flex items-center">
                        <span class="text-green-500 text-sm font-medium">↗ 12.5%</span>
                        <span class="text-gray-500 text-sm ml-1">vs bulan lalu</span>
                    </div>
                </div>

                <div
                    class="bg-white rounded-xl shadow-lg p-6 transform hover:scale-105 transition-all duration-300 hover:shadow-xl border border-green-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Total Pendapatan</p>
                            <p class="text-3xl font-bold text-green-600" id="totalPendapatan">Rp
                                {{ number_format($statistikUmum->total_pendapatan ?? 0, 0, ',', '.') }}</p>
                        </div>
                        <div class="p-3 bg-green-100 rounded-full">
                            <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1">
                                </path>
                            </svg>
                        </div>
                    </div>
                    <div class="mt-2 flex items-center">
                        <span class="text-green-500 text-sm font-medium">↗ 8.2%</span>
                        <span class="text-gray-500 text-sm ml-1">vs bulan lalu</span>
                    </div>
                </div>

                <div
                    class="bg-white rounded-xl shadow-lg p-6 transform hover:scale-105 transition-all duration-300 hover:shadow-xl border border-orange-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Total Transaksi</p>
                            <p class="text-3xl font-bold text-orange-600" id="totalTransaksi">
                                {{ number_format($statistikUmum->total_transaksi ?? 0) }}</p>
                        </div>
                        <div class="p-3 bg-orange-100 rounded-full">
                            <svg class="w-8 h-8 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                        </div>
                    </div>
                    <div class="mt-2 flex items-center">
                        <span class="text-green-500 text-sm font-medium">↗ 15.3%</span>
                        <span class="text-gray-500 text-sm ml-1">vs bulan lalu</span>
                    </div>
                </div>

                <div
                    class="bg-white rounded-xl shadow-lg p-6 transform hover:scale-105 transition-all duration-300 hover:shadow-xl border border-purple-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Rata-rata per Transaksi</p>
                            <p class="text-3xl font-bold text-purple-600" id="rataRataTransaksi">Rp
                                {{ number_format($statistikUmum->rata_rata_nilai_transaksi ?? 0, 0, ',', '.') }}</p>
                        </div>
                        <div class="p-3 bg-purple-100 rounded-full">
                            <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="mt-2 flex items-center">
                        <span class="text-green-500 text-sm font-medium">↗ 5.7%</span>
                        <span class="text-gray-500 text-sm ml-1">vs bulan lalu</span>
                    </div>
                </div>
            </div>

            <!-- Filter Section -->
            <div class="bg-white rounded-xl shadow-lg p-6 mb-8 animate-slide-up">
                <form method="GET" action="{{ route('analisa.index') }}" class="flex flex-wrap items-center gap-4">
                    <label for="filter" class="text-gray-700 font-semibold">Filter Periode:</label>

                    <div class="relative">
                        <button id="dropdownFilterButton" type="button"
                            class="inline-flex items-center px-6 py-3 text-white bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 font-medium rounded-lg text-sm shadow-lg transform hover:scale-105 transition-all duration-200">
                            @php
                                $filterLabels = [
                                    '12bulan' => '12 Bulan Terakhir',
                                    'perbulan' => '1 Bulan Terakhir',
                                    '2minggu' => '2 Minggu Terakhir',
                                ];
                                $currentFilter = request('filter', '12bulan');
                                $currentLabel = $filterLabels[$currentFilter] ?? $filterLabels['12bulan'];
                            @endphp
                            {{ $currentLabel }}
                            <svg class="w-4 h-4 ml-2 transform transition-transform duration-200" id="dropdownIcon"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                                </path>
                            </svg>
                        </button>

                        <div id="dropdownFilterMenu"
                            class="hidden absolute top-full left-0 mt-2 w-56 bg-white rounded-lg shadow-xl border border-gray-100 z-10 animate-slide-down">
                            <div class="py-2">
                                <button type="submit" name="filter" value="12bulan"
                                    class="w-full px-4 py-3 text-left hover:bg-blue-50 transition-colors duration-200 {{ request('filter') == '12bulan' || !request('filter') ? 'bg-blue-50 text-blue-600 font-semibold' : 'text-gray-700' }}">
                                    <div class="flex items-center justify-between">
                                        <span>12 Bulan Terakhir</span>
                                        @if (request('filter') == '12bulan' || !request('filter'))
                                            <svg class="w-4 h-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                        @endif
                                    </div>
                                </button>
                                <button type="submit" name="filter" value="perbulan"
                                    class="w-full px-4 py-3 text-left hover:bg-blue-50 transition-colors duration-200 {{ request('filter') == 'perbulan' ? 'bg-blue-50 text-blue-600 font-semibold' : 'text-gray-700' }}">
                                    <div class="flex items-center justify-between">
                                        <span>1 Bulan Terakhir</span>
                                        @if (request('filter') == 'perbulan')
                                            <svg class="w-4 h-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                        @endif
                                    </div>
                                </button>
                                <button type="submit" name="filter" value="2minggu"
                                    class="w-full px-4 py-3 text-left hover:bg-blue-50 transition-colors duration-200 {{ request('filter') == '2minggu' ? 'bg-blue-50 text-blue-600 font-semibold' : 'text-gray-700' }}">
                                    <div class="flex items-center justify-between">
                                        <span>2 Minggu Terakhir</span>
                                        @if (request('filter') == '2minggu')
                                            <svg class="w-4 h-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                        @endif
                                    </div>
                                </button>
                            </div>
                        </div>
                    </div>

                    <button type="button" id="refreshData"
                        class="px-4 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-lg transition-colors duration-200 flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                            </path>
                        </svg>
                        Refresh
                    </button>
                </form>
            </div>

            <!-- Charts Section -->
            <div class="grid grid-cols-1 xl:grid-cols-2 gap-8 mb-8">
                <!-- Line Chart -->
                <div class="bg-white rounded-xl shadow-lg p-6 animate-slide-up">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-xl font-bold text-gray-800">Trend Penjualan</h3>
                        <div class="flex space-x-2">
                            <button
                                class="chart-toggle px-3 py-1 bg-blue-100 text-blue-600 rounded-lg text-sm font-medium transition-colors active"
                                data-chart="qty">Qty</button>
                            <button
                                class="chart-toggle px-3 py-1 bg-gray-100 text-gray-600 rounded-lg text-sm font-medium transition-colors"
                                data-chart="revenue">Revenue</button>
                        </div>
                    </div>
                    <div class="relative h-80">
                        <canvas id="trendChart"></canvas>
                    </div>
                </div>

                <!-- Pie Chart -->
                <div class="bg-white rounded-xl shadow-lg p-6 animate-slide-up">
                    <h3 class="text-xl font-bold text-gray-800 mb-6">Distribusi Kategori</h3>
                    <div class="relative h-80">
                        <canvas id="kategoriChart"></canvas>
                    </div>
                    <div class="mt-4 grid grid-cols-2 gap-2">
                        @php $total = array_sum(array_column($kategoriTerlaris->toArray(), 'total_terjual')); @endphp
                        @foreach ($kategoriTerlaris->take(6) as $index => $item)
                            <div class="flex items-center p-2 bg-gray-50 rounded-lg">
                                <div class="w-3 h-3 rounded-full mr-2"
                                    style="background-color: {{ $warnaKategori[$index % count($warnaKategori)] }}"></div>
                                <span class="text-sm text-gray-700 font-medium">{{ $item->nama_jenis }}</span>
                                <span
                                    class="ml-auto text-sm text-gray-500">{{ number_format(($item->total_terjual / max($total, 1)) * 100, 1) }}%</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Top Products Section -->
            <div class="bg-white rounded-xl shadow-lg p-6 mb-8 animate-slide-up">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-xl font-bold text-gray-800">🏆 Top 10 Produk Terlaris</h3>
                    <span class="px-3 py-1 bg-green-100 text-green-600 rounded-full text-sm font-medium">
                        {{ $produkTerlaris->count() }} Produk
                    </span>
                </div>

                @if ($produkTerlaris->isEmpty())
                    <div class="text-center py-12">
                        <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                        <p class="text-gray-500 text-lg">Belum ada data penjualan untuk periode ini</p>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="border-b border-gray-200">
                                    <th class="text-left py-4 px-4 font-semibold text-gray-700">Rank</th>
                                    <th class="text-left py-4 px-4 font-semibold text-gray-700">Produk</th>
                                    <th class="text-left py-4 px-4 font-semibold text-gray-700">Kategori</th>
                                    <th class="text-left py-4 px-4 font-semibold text-gray-700">Qty Terjual</th>
                                    <th class="text-left py-4 px-4 font-semibold text-gray-700">Total Revenue</th>
                                    <th class="text-left py-4 px-4 font-semibold text-gray-700">Avg/Transaksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($produkTerlaris as $index => $produk)
                                    <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors duration-200 product-row"
                                        style="animation-delay: {{ $index * 0.1 }}s">
                                        <td class="py-4 px-4">
                                            <div class="flex items-center">
                                                @if ($index < 3)
                                                    <div
                                                        class="w-8 h-8 rounded-full flex items-center justify-center text-white font-bold text-sm {{ $index == 0 ? 'bg-yellow-500' : ($index == 1 ? 'bg-gray-400' : 'bg-orange-500') }}">
                                                        {{ $index + 1 }}
                                                    </div>
                                                @else
                                                    <div
                                                        class="w-8 h-8 rounded-full flex items-center justify-center bg-blue-100 text-blue-600 font-bold text-sm">
                                                        {{ $index + 1 }}
                                                    </div>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="py-4 px-4">
                                            <div class="font-semibold text-gray-800">{{ $produk->nama_produk }}</div>
                                            <div class="text-sm text-gray-500">Rp
                                                {{ number_format($produk->harga, 0, ',', '.') }}</div>
                                        </td>
                                        <td class="py-4 px-4">
                                            <span
                                                class="px-2 py-1 bg-blue-100 text-blue-600 rounded-full text-xs font-medium">
                                                {{ $produk->nama_jenis }}
                                            </span>
                                        </td>
                                        <td class="py-4 px-4">
                                            <div class="flex items-center">
                                                <div class="font-bold text-lg text-gray-800">
                                                    {{ number_format($produk->total_terjual) }}</div>
                                                <div class="ml-2 w-16 h-2 bg-gray-200 rounded-full overflow-hidden">
                                                    <div class="h-full bg-gradient-to-r from-blue-400 to-blue-600 rounded-full transition-all duration-1000"
                                                        style="width: {{ min(($produk->total_terjual / $produkTerlaris->first()->total_terjual) * 100, 100) }}%">
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-4 px-4">
                                            <div class="font-bold text-green-600">Rp
                                                {{ number_format($produk->total_pendapatan, 0, ',', '.') }}</div>
                                        </td>
                                        <td class="py-4 px-4">
                                            <div class="text-gray-600">
                                                {{ number_format($produk->rata_rata_per_transaksi, 1) }}</div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>

            <!-- Performance Comparison Section -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                <!-- Category Performance -->
                <div class="bg-white rounded-xl shadow-lg p-6 animate-slide-up">
                    <h3 class="text-xl font-bold text-gray-800 mb-6">📊 Performa Kategori</h3>
                    <div class="space-y-4">
                        @foreach ($performaKategori->take(5) as $index => $kategori)
                            <div
                                class="p-4 border border-gray-100 rounded-lg hover:shadow-md transition-shadow duration-200">
                                <div class="flex items-center justify-between mb-2">
                                    <h4 class="font-semibold text-gray-800">{{ $kategori->nama_jenis }}</h4>
                                    <span class="text-sm text-gray-500">#{{ $index + 1 }}</span>
                                </div>
                                <div class="grid grid-cols-2 gap-4 text-sm">
                                    <div>
                                        <span class="text-gray-600">Qty Terjual:</span>
                                        <div class="font-bold text-blue-600">{{ number_format($kategori->total_qty) }}
                                        </div>
                                    </div>
                                    <div>
                                        <span class="text-gray-600">Revenue:</span>
                                        <div class="font-bold text-green-600">Rp
                                            {{ number_format($kategori->total_revenue, 0, ',', '.') }}</div>
                                    </div>
                                </div>
                                <div class="mt-3 w-full h-2 bg-gray-200 rounded-full overflow-hidden">
                                    <div class="h-full bg-gradient-to-r from-purple-400 to-purple-600 rounded-full transition-all duration-1000"
                                        style="width: {{ min(($kategori->total_revenue / $performaKategori->first()->total_revenue) * 100, 100) }}%">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Quick Insights -->
                <div class="bg-white rounded-xl shadow-lg p-6 animate-slide-up">
                    <h3 class="text-xl font-bold text-gray-800 mb-6">💡 Quick Insights</h3>
                    <div class="space-y-4">
                        <div class="p-4 bg-blue-50 rounded-lg border-l-4 border-blue-400">
                            <div class="flex items-start">
                                <svg class="w-5 h-5 text-blue-400 mt-1 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <div>
                                    <h4 class="font-semibold text-blue-800">Best Seller</h4>
                                    <p class="text-blue-600 text-sm">
                                        {{ $produkTerlaris->first()->nama_produk ?? 'Tidak ada data' }} adalah produk
                                        terlaris dengan
                                        {{ number_format($produkTerlaris->first()->total_terjual ?? 0) }} unit terjual
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="p-4 bg-green-50 rounded-lg border-l-4 border-green-400">
                            <div class="flex items-start">
                                <svg class="w-5 h-5 text-green-400 mt-1 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <div>
                                    <h4 class="font-semibold text-green-800">Top Revenue</h4>
                                    <p class="text-green-600 text-sm">
                                        {{ $kategoriTerlaris->first()->nama_jenis ?? 'Tidak ada data' }} menghasilkan
                                        pendapatan tertinggi
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="p-4 bg-purple-50 rounded-lg border-l-4 border-purple-400">
                            <div class="flex items-start">
                                <svg class="w-5 h-5 text-purple-400 mt-1 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M3 3a1 1 0 000 2v8a2 2 0 002 2h2.586l-1.293 1.293a1 1 0 101.414 1.414L10 15.414l2.293 2.293a1 1 0 001.414-1.414L12.414 15H15a2 2 0 002-2V5a1 1 0 100-2H3zm11.707 4.707a1 1 0 00-1.414-1.414L10 9.586 8.707 8.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <div>
                                    <h4 class="font-semibold text-purple-800">Growth Trend</h4>
                                    <p class="text-purple-600 text-sm">
                                        Penjualan menunjukkan trend positif dengan pertumbuhan rata-rata 12.5% per bulan
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="p-4 bg-orange-50 rounded-lg border-l-4 border-orange-400">
                            <div class="flex items-start">
                                <svg class="w-5 h-5 text-orange-400 mt-1 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <div>
                                    <h4 class="font-semibold text-orange-800">Opportunity</h4>
                                    <p class="text-orange-600 text-sm">
                                        Focus pada kategori
                                        {{ $kategoriTerlaris->skip(1)->first()->nama_jenis ?? 'tertentu' }}
                                        untuk meningkatkan market share
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        @keyframes fade-in {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slide-up {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slide-down {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fade-in 0.6s ease-out;
        }

        .animate-slide-up {
            animation: slide-up 0.6s ease-out;
        }

        .animate-slide-down {
            animation: slide-down 0.3s ease-out;
        }

        .product-row {
            animation: slide-up 0.6s ease-out both;
        }

        .chart-toggle.active {
            background-color: rgb(59 130 246);
            color: white;
        }

        .chart-toggle:hover {
            background-color: rgb(59 130 246);
            color: white;
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Dropdown functionality
        document.getElementById('dropdownFilterButton').addEventListener('click', function() {
            const menu = document.getElementById('dropdownFilterMenu');
            const icon = document.getElementById('dropdownIcon');

            menu.classList.toggle('hidden');
            icon.style.transform = menu.classList.contains('hidden') ? 'rotate(0deg)' : 'rotate(180deg)';
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            const dropdown = document.getElementById('dropdownFilterButton');
            const menu = document.getElementById('dropdownFilterMenu');

            if (!dropdown.contains(event.target) && !menu.contains(event.target)) {
                menu.classList.add('hidden');
                document.getElementById('dropdownIcon').style.transform = 'rotate(0deg)';
            }
        });

        // Data from backend
        const chartData = @json($data);
        const kategoriData = @json($kategoriTerlaris);
        const currentFilter = @json($filter);

        // Process chart data
        const labels = chartData.map(item => {
            let date;
            if (item.label.length === 10) {
                // Full date string, parse directly
                date = new Date(item.label);
            } else if (item.label.length === 7) {
                // Year-month format, append '-01'
                date = new Date(item.label + '-01');
            } else {
                // Fallback
                date = new Date(item.label);
            }
            if (currentFilter === '2minggu' || currentFilter === 'perbulan') {
                return date.toLocaleDateString('id-ID', {
                    day: 'numeric',
                    month: 'short',
                    year: 'numeric'
                });
            } else {
                return date.toLocaleDateString('id-ID', {
                    month: 'short',
                    year: 'numeric'
                });
            }
        });

        const qtyData = chartData.map(item => parseInt(item.total_terjual) || 0);
        const revenueData = chartData.map(item => parseInt(item.total_pendapatan) || 0);
        const transactionData = chartData.map(item => parseInt(item.total_transaksi) || 0);

        // Trend Chart
        const trendCtx = document.getElementById('trendChart').getContext('2d');
        const gradient1 = trendCtx.createLinearGradient(0, 0, 0, 300);
        gradient1.addColorStop(0, 'rgba(59, 130, 246, 0.3)');
        gradient1.addColorStop(1, 'rgba(59, 130, 246, 0.05)');

        const gradient2 = trendCtx.createLinearGradient(0, 0, 0, 300);
        gradient2.addColorStop(0, 'rgba(16, 185, 129, 0.3)');
        gradient2.addColorStop(1, 'rgba(16, 185, 129, 0.05)');

        let currentChartType = 'qty';
        const trendChart = new Chart(trendCtx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Quantity Terjual',
                    data: qtyData,
                    backgroundColor: gradient1,
                    borderColor: '#3B82F6',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: '#3B82F6',
                    pointBorderColor: '#ffffff',
                    pointBorderWidth: 2,
                    pointRadius: 6,
                    pointHoverRadius: 8,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        titleColor: '#ffffff',
                        bodyColor: '#ffffff',
                        borderColor: '#3B82F6',
                        borderWidth: 1,
                        cornerRadius: 8,
                        displayColors: false,
                        callbacks: {
                            label: function(context) {
                                if (currentChartType === 'qty') {
                                    return `Qty: ${context.parsed.y.toLocaleString()} unit`;
                                } else {
                                    return `Revenue: Rp ${context.parsed.y.toLocaleString()}`;
                                }
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)',
                        },
                        ticks: {
                            color: '#6B7280',
                            callback: function(value) {
                                if (currentChartType === 'revenue') {
                                    return 'Rp ' + value.toLocaleString();
                                }
                                return value.toLocaleString();
                            }
                        }
                    },
                    x: {
                        grid: {
                            display: false,
                        },
                        ticks: {
                            color: '#6B7280',
                        }
                    }
                },
                elements: {
                    point: {
                        hoverBackgroundColor: '#ffffff',
                    }
                }
            }
        });

        // Chart toggle functionality
        document.querySelectorAll('.chart-toggle').forEach(button => {
            button.addEventListener('click', function() {
                // Remove active class from all buttons
                document.querySelectorAll('.chart-toggle').forEach(btn => btn.classList.remove(
                    'active'));
                // Add active class to clicked button
                this.classList.add('active');

                const chartType = this.dataset.chart;
                currentChartType = chartType;

                if (chartType === 'qty') {
                    trendChart.data.datasets[0].data = qtyData;
                    trendChart.data.datasets[0].label = 'Quantity Terjual';
                    trendChart.data.datasets[0].backgroundColor = gradient1;
                    trendChart.data.datasets[0].borderColor = '#3B82F6';
                    trendChart.data.datasets[0].pointBackgroundColor = '#3B82F6';
                } else {
                    trendChart.data.datasets[0].data = revenueData;
                    trendChart.data.datasets[0].label = 'Revenue';
                    trendChart.data.datasets[0].backgroundColor = gradient2;
                    trendChart.data.datasets[0].borderColor = '#10B981';
                    trendChart.data.datasets[0].pointBackgroundColor = '#10B981';
                }

                trendChart.update('active');
            });
        });

        // Kategori Chart
        const kategoriLabels = kategoriData.map(item => item.nama_jenis);
        const kategoriValues = kategoriData.map(item => parseInt(item.total_terjual));

        const warnaKategori = [
            '#f87171', '#facc15', '#34d399', '#60a5fa', '#a78bfa',
            '#f472b6', '#fb923c', '#4ade80', '#38bdf8', '#c084fc'
        ];

        const kategoriCtx = document.getElementById('kategoriChart').getContext('2d');
        const kategoriChart = new Chart(kategoriCtx, {
            type: 'doughnut',
            data: {
                labels: kategoriLabels,
                datasets: [{
                    data: kategoriValues,
                    backgroundColor: warnaKategori,
                    borderWidth: 0,
                    hoverBorderWidth: 3,
                    hoverBorderColor: '#ffffff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '60%',
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        titleColor: '#ffffff',
                        bodyColor: '#ffffff',
                        borderColor: '#ffffff',
                        borderWidth: 1,
                        cornerRadius: 8,
                        callbacks: {
                            label: function(context) {
                                const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                const percentage = ((context.parsed * 100) / total).toFixed(1);
                                return `${context.label}: ${context.parsed.toLocaleString()} (${percentage}%)`;
                            }
                        }
                    }
                },
                onHover: (event, elements) => {
                    event.native.target.style.cursor = elements.length > 0 ? 'pointer' : 'default';
                }
            }
        });

        // Animate progress bars on load
        setTimeout(() => {
            document.querySelectorAll('.product-row').forEach((row, index) => {
                setTimeout(() => {
                    row.style.opacity = '1';
                    row.style.transform = 'translateY(0)';
                }, index * 100);
            });
        }, 500);

        // Animate counter numbers
        function animateValue(element, start, end, duration) {
            let startTimestamp = null;
            const step = (timestamp) => {
                if (!startTimestamp) startTimestamp = timestamp;
                const progress = Math.min((timestamp - startTimestamp) / duration, 1);
                const current = Math.floor(progress * (end - start) + start);
                element.textContent = current.toLocaleString();
                if (progress < 1) {
                    window.requestAnimationFrame(step);
                }
            };
            window.requestAnimationFrame(step);
        }

        // Animate stats on page load
        window.addEventListener('load', () => {
            const totalProduk = document.getElementById('totalProduk');
            const totalTransaksi = document.getElementById('totalTransaksi');

            if (totalProduk) {
                const target = parseInt(totalProduk.textContent.replace(/,/g, ''));
                totalProduk.textContent = '0';
                animateValue(totalProduk, 0, target, 2000);
            }

            if (totalTransaksi) {
                const target = parseInt(totalTransaksi.textContent.replace(/,/g, ''));
                totalTransaksi.textContent = '0';
                animateValue(totalTransaksi, 0, target, 2000);
            }
        });
    </script>
@endsection
