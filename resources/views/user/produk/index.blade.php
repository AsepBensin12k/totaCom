@extends('layouts.user')

@section('title', 'Produk')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-4">Semua Produk</h1>

    <div class="flex flex-col md:flex-row justify-between items-center mb-4 gap-4">
        {{-- Search --}}
        <form method="GET" action="{{ route('user.produk.index') }}" class="w-full md:w-1/2 flex">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari produk atau kategori..."
                class="border border-gray-300 rounded-l-md px-4 py-2 w-full" />
            <button type="submit"
                class="bg-blue-600 text-white px-4 py-2 rounded-r-md hover:bg-blue-700">Cari</button>
        </form>

        {{-- Filter Kategori --}}
        <div class="relative">
            <button id="filterBtn" class="bg-green-600 text-white px-4 py-2 rounded shadow hover:bg-green-700">
                Filter Kategori
            </button>

            <div id="filterDropdown"
                class="hidden absolute z-10 mt-2 w-48 bg-white border border-gray-200 shadow-lg rounded-md">
                <ul class="p-2 text-sm text-gray-800 space-y-1 max-h-60 overflow-auto">
                    @foreach ($kategori as $jenis)
                        <li>
                            <a href="{{ route('user.produk.index', array_merge(request()->except('filter_jenis'), ['filter_jenis' => $jenis->id_jenis])) }}"
                                class="block px-4 py-2 hover:bg-green-100 rounded">
                                {{ $jenis->nama_jenis }}
                            </a>
                        </li>
                    @endforeach
                    <li>
                        <a href="{{ route('user.produk.index', request()->except('filter_jenis')) }}"
                            class="block px-4 py-2 text-red-600 hover:bg-green-100 rounded mt-2 font-semibold">
                            Reset Filter
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    @if (request('filter_jenis'))
        @php
            $jenisNama = \App\Models\Jenis::find(request('filter_jenis'))->nama_jenis ?? 'Tidak diketahui';
        @endphp
        <div class="mb-4 px-4 py-2 bg-blue-100 text-blue-800 rounded-md text-sm w-fit">
            Filter: <strong>{{ $jenisNama }}</strong>
        </div>
    @endif

    {{-- Produk Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($produks as $produk)
            <div class="bg-white p-4 rounded-lg shadow hover:shadow-lg transition">
                @if ($produk->gambar)
                    <img src="{{ asset('storage/' . $produk->gambar) }}" class="w-full h-40 object-cover rounded mb-3"
                        alt="{{ $produk->nama_produk }}">
                @else
                    <div class="w-full h-40 bg-gray-200 rounded mb-3 flex items-center justify-center text-gray-500">
                        No Image
                    </div>
                @endif
                <h3 class="text-lg font-semibold">{{ $produk->nama_produk }}</h3>
                <p class="text-sm text-gray-600">{{ $produk->jenis->nama_jenis ?? 'Tidak diketahui' }}</p>
                <p class="mt-2 text-green-700 font-bold">Rp{{ number_format($produk->harga, 0, ',', '.') }}</p>
                <p class="text-sm text-gray-500">Stok: {{ $produk->stok }}</p>
            </div>
        @empty
            <p class="text-gray-500 col-span-full">Tidak ada produk yang ditemukan.</p>
        @endforelse
    </div>
</div>

<script>
    const btn = document.getElementById('filterBtn');
    const dropdown = document.getElementById('filterDropdown');

    btn.addEventListener('click', () => {
        dropdown.classList.toggle('hidden');
    });

    window.addEventListener('click', (e) => {
        if (!btn.contains(e.target) && !dropdown.contains(e.target)) {
            dropdown.classList.add('hidden');
        }
    });
</script>
@endsection
