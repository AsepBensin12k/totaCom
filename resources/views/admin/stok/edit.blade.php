@extends('layouts.admin')

@section('title', 'Manajemen Stok')
@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-semibold text-gray-800 mb-6">Edit Produk</h1>

        @error('nama_produk')
            <div class="text-red-500 mb-4">{{ $message }}</div>
        @enderror

        <form action="{{ route('stok.update', $produk->id_produk) }}" method="POST" enctype="multipart/form-data"
            class="space-y-6 max-w-2xl mx-auto">
            @csrf
            @method('PUT')

            <div>
                <label class="block font-medium text-gray-700">Nama Produk:</label>
                <input type="text" name="nama_produk" value="{{ old('nama_produk', $produk->nama_produk) }}"
                    class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block font-medium text-gray-700">Harga:</label>
                <input type="number" name="harga" value="{{ old('harga', $produk->harga) }}"
                    class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block font-medium text-gray-700">Stok:</label>
                <input type="number" name="stok" value="{{ old('stok', $produk->stok) }}"
                    class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block font-medium text-gray-700">Jenis Produk:</label>
                <select name="id_jenis"
                    class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @foreach (\App\Models\Jenis::all() as $jenis)
                        <option value="{{ $jenis->id_jenis }}"
                            {{ $produk->id_jenis == $jenis->id_jenis ? 'selected' : '' }}>
                            {{ $jenis->nama_jenis }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block font-medium text-gray-700">Gambar (opsional):</label>
                <input type="file" name="gambar" class="w-full border border-gray-300 rounded-md px-4 py-2">
            </div>

            @if ($produk->gambar)
                <div class="flex items-center gap-4">
                    <img src="{{ asset('storage/' . $produk->gambar) }}" class="w-24 h-auto rounded-lg">
                    <label class="flex items-center gap-2">
                        <input type="checkbox" name="remove_image" value="1" class="form-checkbox">
                        <span>Hapus gambar ini</span>
                    </label>
                </div>
            @endif

            <button type="submit"
                class="bg-teal-500 text-white px-6 py-2 rounded-lg hover:bg-teal-600 focus:outline-none focus:ring-2 focus:ring-teal-500">
                Update
            </button>
        </form>
    </div>
@endsection
