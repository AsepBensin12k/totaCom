@extends('layouts.admin')

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
                <p><strong>Pemesan:</strong> {{ $pesanan->akun->nama ?? 'Tidak diketahui' }}</p>
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

            {{-- <!-- Tombol Cetak -->
            <div class="text-right">
                <button onclick="window.print()" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Cetak Invoice
                </button>
            </div> --}}
        </div>
    </div>
@endsection
