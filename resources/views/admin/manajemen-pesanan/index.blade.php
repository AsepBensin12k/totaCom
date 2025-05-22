@extends('layouts.admin')

@section('title', 'Manajemen Pesanan')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-2xl font-bold mb-6 text-gray-800">Manajemen Pesanan</h1>

        {{-- Notifikasi sukses --}}
        @if (session('success'))
            <div id="success-alert"
                class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded shadow relative"
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

        {{-- Notifikasi error --}}
        @if (session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded mb-6">
                {{ session('error') }}
            </div>
        @endif

        {{-- Tabel utama --}}
        <div class="overflow-x-auto sm:rounded-lg">
            <table class="min-w-full bg-white border border-gray-300 shadow">
                <thead class="bg-teal-500 text-white text-sm">
                    <tr>
                        <th class="px-4 py-3 border">ID</th>
                        <th class="px-4 py-3 border">Tanggal</th>
                        <th class="px-4 py-3 border">Akun</th>
                        <th class="px-4 py-3 border">Metode</th>
                        <th class="px-4 py-3 border">Status</th>
                        <th class="px-4 py-3 border">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-sm text-gray-700">
                    @forelse ($pesanans as $pesanan)
                        <tr class="hover:bg-gray-50">
                            <td class="border px-4 py-2 text-center">{{ $pesanan->id_pesanan }}</td>
                            <td class="border px-4 py-2 text-center">{{ $pesanan->tanggal }}</td>
                            <td class="border px-4 py-2 text-center">{{ $pesanan->akun->nama ?? '-' }}</td>
                            <td class="border px-4 py-2 text-center">{{ $pesanan->metodePembayaran->nama_metode ?? '-' }}
                            </td>
                            <td class="border px-4 py-2 text-center">{{ $pesanan->status->nama_status ?? '-' }}</td>
                            <td class="border px-4 py-2 text-center">
                                <button onclick="toggleDetail({{ $pesanan->id_pesanan }})"
                                    class="bg-indigo-500 hover:bg-indigo-600 text-white text-sm px-4 py-2 rounded transition duration-200">
                                    Lihat Detail Pesanan
                                </button>
                            </td>
                        </tr>

                        {{-- Detail Pesanan --}}
                        <tr id="detail-{{ $pesanan->id_pesanan }}" class="hidden bg-gray-50">
                            <td colspan="6" class="p-4">
                                <div class="mb-4">
                                    <h3 class="font-semibold text-gray-800 mb-2">Detail Pesanan:</h3>

                                    @if ($pesanan->detailPesanans->count() > 0)
                                        <div class="overflow-x-auto">
                                            <table class="min-w-full text-sm border rounded">
                                                <thead>
                                                    <tr class="bg-gray-200">
                                                        <th class="border px-4 py-2 text-left">ID Produk</th>
                                                        <th class="border px-4 py-2 text-left">Nama Produk</th>
                                                        <th class="border px-4 py-2 text-center">Jumlah</th>
                                                        <th class="border px-4 py-2 text-right">Harga Satuan</th>
                                                        <th class="border px-4 py-2 text-right">Subtotal</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php $total = 0; @endphp
                                                    @foreach ($pesanan->detailPesanans as $detail)
                                                        @php
                                                            $subtotal = $detail->qty * $detail->harga;
                                                            $total += $subtotal;
                                                        @endphp
                                                        <tr class="hover:bg-white">
                                                            <td class="border px-4 py-2">{{ $detail->id_produk }}</td>
                                                            <td class="border px-4 py-2">
                                                                @if ($detail->produk)
                                                                    {{ $detail->produk->nama_produk }}
                                                                @else
                                                                    <span class="text-red-500">Produk tidak ditemukan (ID:
                                                                        {{ $detail->id_produk }})</span>
                                                                @endif
                                                            </td>
                                                            <td class="border px-4 py-2 text-center">{{ $detail->qty }}
                                                            </td>
                                                            <td class="border px-4 py-2 text-right">
                                                                Rp{{ number_format($detail->harga, 0, ',', '.') }}
                                                            </td>
                                                            <td class="border px-4 py-2 text-right">
                                                                Rp{{ number_format($subtotal, 0, ',', '.') }}
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    <tr class="bg-gray-100 font-semibold">
                                                        <td colspan="4" class="border px-4 py-2 text-right">Total</td>
                                                        <td class="border px-4 py-2 text-right">
                                                            Rp{{ number_format($total, 0, ',', '.') }}
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    @else
                                        <p class="text-gray-500">Tidak ada detail pesanan</p>
                                    @endif
                                </div>

                                @if ($pesanan->id_status == 1)
                                    <form action="{{ route('manajemen.pesanan.updateStatus', $pesanan->id_pesanan) }}"
                                        method="POST">
                                        @csrf
                                        <input type="hidden" name="id_status" value="2">
                                        <button type="submit"
                                            onclick="return confirm('Yakin ingin mengubah status menjadi Dikirim?')"
                                            class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded transition duration-200">
                                            Tandai Dikirim
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="border px-4 py-6 text-center text-gray-500">
                                Tidak ada data pesanan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <script>
        function toggleDetail(id) {
            const row = document.getElementById(`detail-${id}`);
            row.classList.toggle('hidden');
        }
    </script>
@endsection
