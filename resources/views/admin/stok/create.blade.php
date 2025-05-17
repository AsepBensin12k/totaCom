@extends('layouts.admin')

@section('title', 'Manajemen Stok')
@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-semibold text-gray-800 mb-6">Tambah Produk Baru</h1>

        @if ($errors->any())
            <div class="bg-red-100 text-red-600 p-4 mb-4 rounded-lg shadow-sm">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('stok.store') }}" method="POST" enctype="multipart/form-data"
            class="space-y-6 max-w-2xl mx-auto">
            @csrf

            <div>
                <label class="block font-medium text-gray-700">Nama Produk:</label>
                <input type="text" name="nama_produk" required
                    class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block font-medium text-gray-700">Harga:</label>
                <input type="number" name="harga" required
                    class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block font-medium text-gray-700">Stok:</label>
                <input type="number" name="stok" required
                    class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block font-medium text-gray-700">Jenis Produk:</label>
                <select name="id_jenis" required
                    class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value=""> -- Pilih Jenis Produk -- </option>
                    @foreach ($jenisProduks as $jenis)
                        <option value="{{ $jenis->id_jenis }}">{{ $jenis->nama_jenis }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block font-medium text-gray-700">Gambar (opsional):</label>
                <input type="file" name="gambar" class="w-full border border-gray-300 rounded-md px-4 py-2">
            </div>

            <button type="submit"
                class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500">
                Simpan
            </button>
        </form>
    </div>
@endsection
