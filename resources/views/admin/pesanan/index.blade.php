@extends('layouts.admin')

@section('title', 'Pesanan')

@section('content')
    <div class="container mx-auto px-4 py-4">
        <h1 class="text-3xl font-bold mb-4">Daftar Produk</h1>

        @if (session('success'))
            <div id="success-alert"
                class="bg-green-100 border-l-4 border-green-500 text-green-700 p-3 mb-6 rounded shadow-md relative"
                role="alert">
                <div class="flex justify-between items-center">
                    <p>{{ session('success') }}</p>
                    <button type="button" class="text-green-700 hover:text-green-900"
                        onclick="document.getElementById('success-alert').remove()">
                        <span class="text-2xl">&times;</span>
                    </button>
                </div>
            </div>

            <script>
                setTimeout(() => {
                    const alert = document.getElementById('success-alert');
                    if (alert) alert.remove();
                }, 3000);
            </script>
        @endif

        @if (session('error'))
            <div id="flash-message" class="bg-red-100 text-red-800 p-3 rounded mb-4">{{ session('error') }}</div>
        @endif

        @php
            $filterJenisId = request('filter_jenis');
            $filterJenisNama = $filterJenisId ? \App\Models\Jenis::find($filterJenisId)->nama_jenis : null;
        @endphp

        <div class="flex flex-col md:flex-row items-start md:items-center justify-between mb-4 gap-4">
            <div class="relative w-full md:w-auto">
                <button id="dropdownRadioButton" data-dropdown-toggle="dropdownRadio"
                    class="inline-flex items-center justify-center text-white bg-teal-500 focus:outline-none hover:bg-teal-600 font-medium rounded-lg text-sm px-4 py-2 shadow-md h-10 w-full md:w-auto"
                    type="button">
                    <svg class="w-5 h-5 mr-2 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 7h10M7 12h4m1 8l7-7-7-7v14z" />
                    </svg>
                    {{-- Tampilkan nama filter aktif, jika ada --}}
                    {{ $filterJenisNama ? 'Filter: ' . $filterJenisNama : 'Filter Kategori' }}
                    <svg class="w-2.5 h-2.5 ml-2.5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 4 4 4-4" />
                    </svg>
                </button>

                <div id="dropdownRadio"
                    class="z-10 hidden w-48 bg-white divide-y divide-gray-100 rounded-lg shadow absolute mt-2">
                    <ul class="p-3 space-y-1 text-sm text-gray-800" aria-labelledby="dropdownRadioButton">
                        @foreach (\App\Models\Jenis::orderBy('nama_jenis', 'asc')->get() as $jenis)
                            <li>
                                <a href="{{ route('pesanan.index', ['filter_jenis' => $jenis->id_jenis, 'search' => request('search')]) }}"
                                    class="block px-4 py-2 hover:bg-teal-100 rounded transition">
                                    {{ $jenis->nama_jenis }}
                                </a>
                            </li>
                        @endforeach
                        <li>
                            <a href="{{ route('pesanan.index', ['search' => request('search')]) }}"
                                class="block px-4 py-2 hover:bg-teal-100 rounded transition">
                                Semua Kategori
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- Search Bar dengan flex-grow supaya mengisi ruang tengah -->
            <div class="flex-grow w-full md:max-w-xl">
                <x-search-bar placeholder="Cari produk atau kategori..." />
            </div>

            <!-- Tombol Lihat Keranjang -->
            <div class="w-full md:w-auto flex justify-start md:justify-end">
                <a href="{{ route('keranjang.index') }}"
                    class="bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-yellow-600 inline-flex items-center h-10 justify-center w-full md:w-auto">
                    Lihat Keranjang
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($produks as $produk)
                <div class="border rounded shadow p-4 flex flex-col">
                    @if ($produk->gambar)
                        <img src="{{ asset('storage/' . $produk->gambar) }}" alt="{{ $produk->nama_produk }}"
                            class="h-40 w-full object-cover mb-3 rounded">
                    @else
                        <div class="h-40 bg-gray-200 flex items-center justify-center mb-3 rounded text-gray-500">
                            No Image
                        </div>
                    @endif

                    <h2 class="font-semibold text-lg">{{ $produk->nama_produk }}</h2>
                    <p class="text-gray-600">Harga: Rp{{ number_format($produk->harga, 0, ',', '.') }}</p>
                    <p class="text-gray-600 mb-3">Stok: {{ $produk->stok }}</p>

                    <form action="{{ route('pesanan.tambahKeranjang', $produk->id_produk) }}" method="POST"
                        class="mt-auto">
                        @csrf
                        <div class="flex flex-col gap-2">
                            <input type="number" id="qty_{{ $produk->id_produk }}" name="qty" value="1"
                                min="1" max="{{ $produk->stok }}" class="border rounded px-2 py-1 w-full" required>

                            <button type="submit"
                                class="bg-green-600 text-white px-3 py-2 rounded hover:bg-green-700 w-full">
                                Tambah
                            </button>
                        </div>
                    </form>

                </div>
            @endforeach
        </div>

        {{ $produks->withQueryString()->links() }}

    </div>

    <script>
        setTimeout(() => {
            const msg = document.getElementById('flash-message');
            if (msg) msg.style.display = 'none';
        }, 2000);

        const dropdownBtn = document.getElementById('dropdownRadioButton');
        const dropdown = document.getElementById('dropdownRadio');

        if (dropdownBtn && dropdown) {
            dropdownBtn.addEventListener('click', () => {
                dropdown.classList.toggle('hidden');
            });

            window.addEventListener('click', function(e) {
                if (!dropdown.contains(e.target) && !dropdownBtn.contains(e.target)) {
                    dropdown.classList.add('hidden');
                }
            });
        }
    </script>
@endsection
