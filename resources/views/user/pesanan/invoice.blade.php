@extends('layouts.user')

@section('title', 'Invoice')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="bg-white shadow-md rounded p-6">
        <h2 class="text-2xl font-bold mb-4">Invoice Pesanan #{{ $pesanan->id_pesanan }}</h2>

        <!-- Informasi Umum -->
        <div class="mb-6">
            <p><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($pesanan->tanggal)->format('d M Y') }}</p>
            <p><strong>Status:</strong> {{ $pesanan->status->nama_status }}</p>
            <p><strong>Metode Pembayaran:</strong> {{ $pesanan->metodePembayaran->nama_metode ?? '-' }}</p>
        </div>

        <!-- Tabel Produk -->
        <div class="overflow-x-auto">
            <table class="w-full border text-left mb-6">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 border">Nama Produk</th>
                        <th class="px-4 py-2 border">Harga</th>
                        <th class="px-4 py-2 border">Jumlah</th>
                        <th class="px-4 py-2 border">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @php $total = 0; @endphp
                    @foreach ($pesanan->detailPesanans as $item)
                        @php
                            $subtotal = $item->qty * $item->harga;
                            $total += $subtotal;
                        @endphp
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-2 border">{{ $item->produk->nama_produk }}</td>
                            <td class="px-4 py-2 border">Rp{{ number_format($item->harga, 0, ',', '.') }}</td>
                            <td class="px-4 py-2 border">{{ $item->qty }}</td>
                            <td class="px-4 py-2 border">Rp{{ number_format($subtotal, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                    <tr class="font-semibold bg-gray-200">
                        <td colspan="3" class="px-4 py-2 border text-right">Total</td>
                        <td class="px-4 py-2 border">Rp{{ number_format($total, 0, ',', '.') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Info -->
        <div class="bg-blue-50 border-l-4 border-blue-500 p-4 mb-6">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zM9 9a1 1 0 100 2v3a1 1 0 001 1h1a1 1 0 100-2h-1V9z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-blue-700">
                        Pesanan Anda sedang menunggu konfirmasi. Silakan tunggu notifikasi selanjutnya.
                    </p>
                </div>
            </div>
        </div>

        <div class="text-right">
            <a href="{{ route('user.dashboard') }}"
               class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Kembali ke Dashboard
            </a>
        </div>
    </div>
</div>
@endsection
