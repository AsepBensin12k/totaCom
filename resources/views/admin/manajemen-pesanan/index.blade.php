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
                        <th class="px-4 py-3 border">No.</th>
                        <th class="px-4 py-3 border">Nomor Pesanan</th>
                        <th class="px-4 py-3 border">Tanggal</th>
                        <th class="px-4 py-3 border">Akun</th>
                        <th class="px-4 py-3 border">Metode</th>
                        <th class="px-4 py-3 border">Status</th>
                        <th class="px-4 py-3 border">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-sm text-gray-700">
                    @forelse ($pesanans as $index => $pesanan)
                        <tr class="hover:bg-gray-50">
                            <td class="border px-4 py-2 text-center">{{ $index + 1 }}</td>
                            <td class="border px-4 py-2 text-center">
                                <span
                                    class="font-semibold text-blue-600">#PSN{{ str_pad($pesanan->nomor_pesanan, 4, '0', STR_PAD_LEFT) }}</span>
                            </td>
                            <td class="border px-4 py-2 text-center">
                                {{ \Carbon\Carbon::parse($pesanan->tanggal)->format('d/m/Y') }}
                            </td>
                            <td class="border px-4 py-2 text-center">{{ $pesanan->akun->username ?? '-' }}</td>
                            <td class="border px-4 py-2 text-center">{{ $pesanan->metodePembayaran->nama_metode ?? '-' }}
                            </td>
                            <td class="border px-4 py-2 text-center">
                                <span
                                    class="px-2 py-1 rounded text-sm font-semibold
                                    @if ($pesanan->status->id_status == 1) bg-yellow-100 text-yellow-800
                                    @elseif($pesanan->status->id_status == 2) bg-blue-100 text-blue-800
                                    @elseif($pesanan->status->id_status == 3) bg-green-100 text-green-800
                                    @else bg-gray-100 text-gray-800 @endif">
                                    {{ $pesanan->status->nama_status ?? '-' }}
                                </span>
                            </td>
                            <td class="border px-4 py-2 text-center">
                                <button onclick="toggleDetail({{ $pesanan->id_pesanan }})"
                                    class="bg-indigo-500 hover:bg-indigo-600 text-white text-sm px-4 py-2 rounded transition duration-200">
                                    Lihat Detail
                                </button>
                            </td>
                        </tr>

                        {{-- Detail Pesanan --}}
                        <tr id="detail-{{ $pesanan->id_pesanan }}" class="hidden bg-gray-50">
                            <td colspan="7" class="p-4">
                                <div class="mb-4">
                                    <h3 class="font-semibold text-gray-800 text-lg">
                                        Detail Pesanan #PSN{{ str_pad($pesanan->nomor_pesanan, 4, '0', STR_PAD_LEFT) }}
                                    </h3>
                                    <div
                                        class="text-sm text-gray-600 mb-3 px-3 py-2 bg-gray-100 border border-gray-200 rounded">
                                        <p><strong>Pemesan :</strong> {{ $pesanan->akun->nama ?? '-' }}</p>
                                        <p><strong>Metode Pembayaran :</strong>
                                            {{ $pesanan->metodePembayaran->nama_metode ?? '-' }}</p>
                                        <p><strong>Tanggal pesanan :</strong>
                                            {{ \Carbon\Carbon::parse($pesanan->tanggal)->format('d F Y') }}</p>
                                    </div>

                                    @if ($pesanan->detailPesanans->count() > 0)
                                        <div class="overflow-x-auto">
                                            <table class="min-w-full text-sm border rounded">
                                                <thead>
                                                    <tr class="bg-gray-200">
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
                                                        <td colspan="3" class="border px-4 py-2 text-right">Total Pesanan
                                                        </td>
                                                        <td class="border px-4 py-2 text-right text-lg">
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
                                    <div
                                        class="flex justify-between items-center mt-4 px-3 py-2 bg-yellow-50 border border-yellow-200 rounded">
                                        <div class="text-sm text-gray-600">
                                            <p><strong>Status saat ini:</strong> <span
                                                    class="text-yellow-600 font-semibold">{{ $pesanan->status->nama_status }}</span>
                                            </p>
                                        </div>
                                        <form action="{{ route('manajemen.pesanan.updateStatus', $pesanan->id_pesanan) }}"
                                            method="POST" class="inline">
                                            @csrf
                                            <input type="hidden" name="id_status" value="2">
                                            <button type="submit"
                                                onclick="return confirm('Yakin ingin mengubah status pesanan #PSN{{ str_pad($pesanan->nomor_pesanan, 4, '0', STR_PAD_LEFT) }} menjadi Dikirim?')"
                                                class="bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded transition duration-200 font-semibold">
                                                📦 Tandai Sebagai Dikirim
                                            </button>
                                        </form>
                                    </div>
                                @elseif ($pesanan->id_status == 2)
                                    <div class="mt-4 p-3 bg-blue-50 border border-blue-200 rounded">
                                        <p class="text-blue-700"><strong>Status:</strong> Pesanan ini sedang dalam
                                            pengiriman</p>
                                    </div>
                                @elseif ($pesanan->id_status == 3)
                                    <div class="mt-4 p-3 bg-green-50 border border-green-200 rounded">
                                        <p class="text-green-700"><strong>Status:</strong> Pesanan telah selesai</p>
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="border px-4 py-6 text-center text-gray-500">
                                Tidak ada data pesanan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Info tambahan --}}
        <div class="mt-6 bg-blue-50 border border-blue-200 rounded p-4">
            <h4 class="font-semibold text-blue-800 mb-2">Keterangan Status:</h4>
            <div class="text-sm text-blue-700">
                <div class="flex items-center mb-1">
                    <span class="px-2 py-1 rounded text-xs font-semibold bg-yellow-100 text-yellow-800 mr-2">Dikemas</span>
                    <span>Pesanan sedang dikemas</span>
                </div>
                <div class="flex items-center mb-1">
                    <span class="px-2 py-1 rounded text-xs font-semibold bg-blue-100 text-blue-800 mr-2">Dikirim</span>
                    <span>Pesanan sedang dalam pengiriman</span>
                </div>
                <div class="flex items-center">
                    <span class="px-2 py-1 rounded text-xs font-semibold bg-green-100 text-green-800 mr-2">Selesai</span>
                    <span>Pesanan telah selesai dan diterima</span>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleDetail(id) {
            const row = document.getElementById(`detail-${id}`);
            row.classList.toggle('hidden');
        }
    </script>
@endsection
