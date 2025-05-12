@extends('layouts.admin')

@section('title', 'Analisis Produk')
@section('content')
    <div class="container mx-auto px-6 py-6">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">10 Produk Terlaris Bulan Ini</h2>
        <p class="text-gray-600 mb-6">Analisa berdasarkan data pesanan yang telah selesai</p>

        @if ($produkTerlaris->isEmpty())
            <div class="bg-blue-100 text-blue-700 text-center py-4 px-6 rounded-md">
                Belum ada data penjualan bulan ini.
            </div>
        @else
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg bg-white">
                <table class="min-w-full divide-y divide-blue-200 text-sm text-left text-gray-700">
                    <thead class="text-gray-700 bg-blue-100">
                        <tr>
                            <th scope="col" class="px-6 py-3">No.</th>
                            <th scope="col" class="px-6 py-3">Nama Produk</th>
                            <th scope="col" class="px-6 py-3">Jumlah Terjual</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($produkTerlaris as $index => $produk)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $index + 1 }}</td>
                                <td class="px-6 py-4">{{ $produk->nama_produk }}</td>
                                <td class="px-6 py-4">{{ $produk->total_terjual }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    {{-- Grafik Penjualan --}}
    <div class="container mx-auto px-6 py-6">
        <form method="GET" action="{{ route('analisa.index') }}" class="mb-6">
            <label for="filter" class="mr-2 text-gray-700 font-medium">Filter Waktu:</label>
            {{-- Dropdown Filter Waktu --}}
            <div class="relative inline-block text-left">
                <form method="GET" action="{{ route('analisa.index') }}">
                    <button id="dropdownFilterButton" data-dropdown-toggle="dropdownFilterMenu" type="button"
                        class="inline-flex items-center text-white bg-teal-600 border border-teal-600 focus:outline-none hover:bg-teal-700 font-medium rounded-lg text-sm px-4 py-2 shadow-md">
                        Filter Waktu
                        <svg class="w-2.5 h-2.5 ms-2.5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 4 4 4-4" />
                        </svg>
                    </button>

                    <div id="dropdownFilterMenu"
                        class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 mt-2 absolute">
                        <ul class="py-2 text-sm text-gray-700">
                            <li>
                                <button type="submit" name="filter" value="12bulan"
                                    class="block w-full px-4 py-2 text-left hover:bg-teal-100 rounded transition {{ request('filter') == '12bulan' ? 'font-semibold text-teal-600' : '' }}">
                                    12 Bulan Terakhir
                                </button>
                            </li>
                            <li>
                                <button type="submit" name="filter" value="perbulan"
                                    class="block w-full px-4 py-2 text-left hover:bg-teal-100 rounded transition {{ request('filter') == 'perbulan' ? 'font-semibold text-teal-600' : '' }}">
                                    1 Bulan Terakhir
                                </button>
                            </li>
                            <li>
                                <button type="submit" name="filter" value="2minggu"
                                    class="block w-full px-4 py-2 text-left hover:bg-teal-100 rounded transition {{ request('filter') == '2minggu' ? 'font-semibold text-teal-600' : '' }}">
                                    2 Minggu Terakhir
                                </button>
                            </li>
                        </ul>
                    </div>
                </form>
            </div>

        </form>

        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Grafik Penjualan Produk</h2>
        <canvas id="grafikPenjualan" height="100"></canvas>
    </div>

    {{-- Grafik Kategori Penyumbang Penjualan --}}
    <div class="container mx-auto px-6 py-6 h-auto">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Distribusi Penjualan Berdasarkan Kategori Produk</h2>

        <div class="flex flex-col items-center">
            {{-- Legend di Atas --}}
            <div class="mb-4 flex flex-wrap gap-3">
                @php
                    $total = array_sum(array_column($kategoriTerlaris->toArray(), 'total_terjual'));
                @endphp
                @foreach ($kategoriTerlaris as $index => $item)
                    <div class="flex items-center">
                        <div class="w-4 h-4 mr-2 rounded-full"
                            style="background-color: {{ $warnaKategori[$index % count($warnaKategori)] }}"></div>
                        <span class="text-gray-700 text-sm font-medium mr-4">
                            {{ $item->nama_jenis }} ({{ number_format(($item->total_terjual / $total) * 100, 1) }}%)
                        </span>
                    </div>
                @endforeach
            </div>

            {{-- Pie Chart di Bawah --}}
            <div class="w-full h-96">
                <canvas id="kategoriPieChart" class="w-full h-full"></canvas>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.getElementById('dropdownFilterButton').addEventListener('click', function() {
            const menu = document.getElementById('dropdownFilterMenu');
            menu.classList.toggle('hidden');
        });

        // Grafik Penjualan per Waktu
        const data = @json($data);
        const labels = data.map(item => item.label);
        const values = data.map(item => item.total_terjual);

        const ctx1 = document.getElementById('grafikPenjualan').getContext('2d');
        const gradient = ctx1.createLinearGradient(0, 0, 0, 400);
        gradient.addColorStop(0, 'rgba(56, 189, 248, 0.6)');
        gradient.addColorStop(1, 'rgba(56, 189, 248, 0.2)');

        const grafik1 = new Chart(ctx1, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Total Produk Terjual',
                    data: values,
                    backgroundColor: gradient,
                    borderColor: '#0284c7',
                    borderWidth: 2,
                    borderRadius: 5,
                    pointBackgroundColor: '#0284c7',
                    pointRadius: 5,
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 10,
                            font: {
                                weight: 'bold',
                                size: 12
                            }
                        },
                    },
                    x: {
                        ticks: {
                            font: {
                                weight: 'bold',
                                size: 12
                            }
                        }
                    }
                }
            }
        });

        // Pie Chart Kategori Penyumbang Penjualan
        const kategoriData = @json($kategoriTerlaris);
        const kategoriLabels = kategoriData.map(item => item.nama_jenis);
        const kategoriValues = kategoriData.map(item => item.total_terjual);

        const warnaKategori = [
            '#f87171', '#facc15', '#34d399', '#60a5fa', '#a78bfa', '#f472b6',
            '#fb923c', '#4ade80', '#38bdf8', '#c084fc'
        ];

        const ctxPie = document.getElementById('kategoriPieChart').getContext('2d');
        const kategoriPieChart = new Chart(ctxPie, {
            type: 'pie',
            data: {
                labels: kategoriLabels,
                datasets: [{
                    label: 'Penjualan per Kategori',
                    data: kategoriValues,
                    backgroundColor: warnaKategori,
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            font: {
                                weight: 'bold'
                            }
                        }
                    }
                }
            }
        });
    </script>
@endsection
