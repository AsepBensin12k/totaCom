@extends('layouts.user')

@section('content')
<div class="container mx-auto p-4 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-extrabold text-gray-900 mb-8 text-center">Riwayat Pesanan Saya</h1>

    @if($pesanans->isEmpty())
        <div class="bg-white p-6 rounded-lg shadow-md text-center">
            <p class="text-gray-600 text-lg mb-4">Anda belum memiliki riwayat pesanan. Mari mulai jelajahi produk kami!</p>
            <a href="{{ url('/') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg transition duration-300 transform hover:scale-105">
                Mulai Belanja
            </a>
        </div>
    @else
        <div class="space-y-8"> {{-- Menambah jarak antar setiap kartu pesanan --}}
            @foreach($pesanans as $index => $pesanan)
                <div class="bg-white border border-gray-200 rounded-xl shadow-lg p-6 hover:shadow-xl transition-shadow duration-300">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-4 pb-4 border-b border-gray-200">
                        {{-- Nomor Pesanan --}}
                        <h2 class="font-bold text-xl text-gray-800 mb-2 md:mb-0">
                            Pesanan #{{ str_pad($pesanans->count() - $loop->index, 3, '0', STR_PAD_LEFT) }} {{-- Penomoran dari yang terbaru ke terlama --}}
                        </h2>
                        {{-- Tanggal dan Metode Pembayaran --}}
                        <div class="text-right">
                            <p class="text-sm text-gray-500">Tanggal Pesanan: <span class="font-medium text-gray-700">{{ \Carbon\Carbon::parse($pesanan->created_at)->format('d F Y, H:i') }}</span></p>
                            <p class="text-sm text-gray-500">Metode Pembayaran: <span class="font-medium text-gray-700">{{ $pesanan->metodePembayaran->nama_metode ?? 'Belum dipilih' }}</span></p>
                        </div>
                    </div>

                    {{-- Status Pesanan --}}
                    <div class="mb-4">
                        <p class="font-semibold text-gray-700 mb-1">Status Pesanan:</p>
                        @php
                            $statusClass = [
                                'Dikemas' => 'bg-yellow-100 text-yellow-800',
                                'Dikirim' => 'bg-blue-100 text-blue-800',
                                'Selesai' => 'bg-green-100 text-green-800',
                                'Ditolak' => 'bg-red-100 text-red-800',
                            ][$pesanan->status->nama_status] ?? 'bg-gray-100 text-gray-800'; // Default jika status tidak terdefinisi
                        @endphp
                        <span class="px-3 py-1 rounded-full text-sm font-semibold {{ $statusClass }}">
                            {{ $pesanan->status->nama_status }}
                        </span>
                    </div>

                    {{-- Detail Produk dalam Tabel --}}
                    <h3 class="font-bold text-gray-800 text-lg mb-3 mt-5">Detail Produk:</h3>
                    <div class="overflow-x-auto rounded-lg border border-gray-300"> {{-- Membuat tabel responsif dengan border --}}
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="py-3 px-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Produk</th>
                                    <th class="py-3 px-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Jumlah</th>
                                    <th class="py-3 px-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Harga Satuan</th>
                                    <th class="py-3 px-4 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($pesanan->detailPesanans as $detail)
                                    <tr class="hover:bg-gray-50">
                                        <td class="py-3 px-4 whitespace-nowrap text-gray-800">{{ $detail->produk->nama_produk ?? 'Produk tidak ditemukan' }}</td>
                                        <td class="py-3 px-4 whitespace-nowrap text-gray-800">{{ $detail->qty ?? '0' }}</td>
                                        <td class="py-3 px-4 whitespace-nowrap text-gray-800">Rp {{ number_format($detail->harga ?? 0, 0, ',', '.') }}</td>
                                        <td class="py-3 px-4 whitespace-nowrap text-right text-gray-800">Rp {{ number_format(($detail->qty ?? 0) * ($detail->harga ?? 0), 0, ',', '.') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="py-4 px-4 text-center text-gray-500">Tidak ada detail produk untuk pesanan ini.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                            <tfoot class="bg-gray-50">
                                <tr>
                                    <td colspan="3" class="py-3 px-4 text-right font-bold text-gray-800 uppercase">Total Pesanan:</td>
                                    <td class="py-3 px-4 text-right font-bold text-green-600 text-lg">Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    {{-- Bagian Aksi (Invoice & Tandai Selesai) --}}
                    <div class="flex flex-col sm:flex-row justify-between items-center mt-6 pt-4 border-t border-gray-200">

                        {{-- Tombol "Tandai Selesai" hanya jika statusnya "Dikirim" (ID 2) --}}
                        @if($pesanan->status->id_status == 2)
                            <form id="form-selesai-{{ $pesanan->id_pesanan }}"
                                  action="{{ route('pesanan.selesai', $pesanan->id_pesanan) }}"
                                  method="POST">
                                @csrf
                                <button type="button" onclick="konfirmasiSelesai('{{ $pesanan->id_pesanan }}')"
                                        class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-5 rounded-lg text-sm transition duration-300 ease-in-out transform hover:scale-105 shadow-md">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline-block mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Tandai Selesai
                                </button>
                            </form>
                        {{-- Tampilkan pesan jika status bukan "Dikirim" --}}
                        @else
                            <span class="bg-gray-200 text-gray-700 px-3 py-1 rounded-lg text-sm">
                                Status: {{ $pesanan->status->nama_status }}
                            </span>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
        {{-- Jika Anda menambahkan paginasi di controller nantinya, ini tempatnya --}}
        {{-- @if($pesanans->hasPages())
            <div class="mt-8">
                {{ $pesanans->links() }}
            </div>
        @endif --}}
    @endif
</div>

{{-- SweetAlert2 CDN (Pastikan koneksi internet tersedia) --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function konfirmasiSelesai(pesananId) {
        Swal.fire({
            title: 'Apakah pesanan ini sudah Anda terima?',
            text: "Pesanan akan ditandai sebagai selesai dan tidak dapat diubah kembali.",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#22C55E', // Tailwind green-500
            cancelButtonColor: '#EF4444', // Tailwind red-500
            confirmButtonText: 'Ya, Sudah Diterima',
            cancelButtonText: 'Belum'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('form-selesai-' + pesananId).submit();
            }
        });
    }
</script>
@endsection
