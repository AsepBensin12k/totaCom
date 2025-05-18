@extends('layouts.admin')

@section('title', 'Manajemen Stok')
@section('content')

    @if (session('success'))
        <div id="success-alert" class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded shadow-md relative"
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

    @php
        $filterJenisId = request('filter_jenis');
        $filterJenisNama = $filterJenisId ? \App\Models\Jenis::find($filterJenisId)->nama_jenis : null;
    @endphp

    <div class="container mx-auto px-6 py-6">
        <h1 class="text-3xl font-bold mb-6">Daftar Produk</h1>

        <div class="flex flex-col md:flex-row justify-between md:items-center mb-4 gap-4">
            <div class="relative">
                <button id="dropdownRadioButton" data-dropdown-toggle="dropdownRadio"
                    class="inline-flex items-center justify-center text-white bg-teal-600 border border-teal-600 focus:outline-none hover:bg-teal-700 font-medium rounded-lg text-sm px-4 py-2 shadow-md h-10 w-full md:w-auto"
                    type="button">
                    <svg class="w-5 h-5 mr-2 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 7h10M7 12h4m1 8l7-7-7-7v14z" />
                    </svg>

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
                                <a href="{{ route('stok.index', ['filter_jenis' => $jenis->id_jenis, 'search' => request('search')]) }}"
                                    class="block px-4 py-2 hover:bg-teal-100 rounded transition">
                                    {{ $jenis->nama_jenis }}
                                </a>
                            </li>
                        @endforeach
                        <li>
                            <a href="{{ route('stok.index', ['search' => request('search')]) }}"
                                class="block px-4 py-2 hover:bg-teal-100 rounded transition">
                                Semua Kategori
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <x-search-bar placeholder="Cari produk atau kategori..." class="w-full md:w-1/2" />

            <div class="w-full md:w-auto flex justify-start md:justify-end">
                <a href="{{ route('stok.create') }}"
                    class="inline-block bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md shadow-md w-full md:w-auto">
                    Tambah Produk +
                </a>
            </div>
        </div>


        {{-- Tabel Produk --}}
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg bg-white">
            <table class="min-w-full divide-y divide-blue-200 text-sm text-left text-gray-700">
                <thead class="text-gray-700 bg-blue-100">
                    <tr>
                        <th scope="col" class="px-6 py-3">Nama Produk</th>
                        <th scope="col" class="px-6 py-3">Kategori</th>
                        <th scope="col" class="px-6 py-3">Harga</th>
                        <th scope="col" class="px-6 py-3">Stok</th>
                        <th scope="col" class="px-6 py-3">Gambar</th>
                        <th scope="col" class="px-6 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($produks as $produk)
                        <tr class="border-b">
                            <td class="px-6 py-4">{{ $produk->nama_produk }}</td>
                            <td class="px-6 py-4">{{ $produk->jenis->nama_jenis ?? 'Tidak diketahui' }}</td>
                            <td class="px-6 py-4">Rp{{ number_format($produk->harga, 0, ',', '.') }}</td>
                            <td class="px-6 py-4">{{ $produk->stok }}</td>
                            <td class="px-6 py-4">
                                @if ($produk->gambar)
                                    <img src="{{ asset('storage/' . $produk->gambar) }}" class="w-20 h-auto rounded">
                                @else
                                    <span class="text-gray-500">Tidak ada gambar</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 space-x-2">
                                <a href="{{ route('stok.edit', $produk->id_produk) }}"
                                    class="text-blue-600 hover:underline">Edit</a>
                                <form action="{{ route('stok.destroy', $produk->id_produk) }}" method="POST"
                                    class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Yakin ingin hapus?')"
                                        class="text-red-600 hover:underline">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-gray-500">Belum ada data produk.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <script>
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
