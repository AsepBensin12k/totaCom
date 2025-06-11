@extends('layouts.user')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-6">Riwayat Pesanan Saya</h1>

    @if($pesanans->isEmpty())
        <p>Belum ada pesanan.</p>
    @else
        @foreach($pesanans as $pesanan)
            <div class="bg-white border rounded shadow p-4 flex flex-col mb-6">
<h2 class="font-semibold text-lg mb-2">Pesanan {{ $pesanans->count() - $loop->index }}</h2>
                <p><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($pesanan->tanggal)->format('d M Y') }}</p>
                <p><strong>Status:</strong> {{ $pesanan->status->nama_status }}</p>
                <p><strong>Metode Pembayaran:</strong> {{ $pesanan->metodePembayaran->nama_metode ?? '-' }}</p>

                <h3 class="mt-4 font-semibold">Detail Produk:</h3>
                <ul class="list-disc list-inside">
                    @foreach($pesanan->detailPesanans as $detail)
                    <li>
                        {{ $detail->produk->nama_produk ?? 'Produk tidak ditemukan' }} -
                        Jumlah: {{ $detail->qty ?? '-' }} -
                        Subtotal: Rp {{ number_format(($detail->qty ?? 0) * ($detail->harga ?? 0), 0, ',', '.') }}
                    </li>
                    @endforeach
                </ul>
                <p class="font-semibold mt-2">
                    Total Pesanan: Rp {{
                        number_format($pesanan->detailPesanans->sum(function($d) {
                            return ($d->qty ?? 0) * ($d->harga ?? 0);
                        }), 0, ',', '.')
                    }}
                </p>

                @if($pesanan->status->id_status == 2) {{-- id 2 = Dikirim --}}
                <form id="form-selesai-{{ $pesanan->id_pesanan }}" action="{{ route('pesanan.selesai', $pesanan->id_pesanan) }}" method="POST" class="mt-3">
                    @csrf
                    <button type="button" onclick="konfirmasiSelesai('{{ $pesanan->id_pesanan }}')" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">
                        Tandai Selesai
                    </button>
                </form>
                @endif
            </div>
        @endforeach
    @endif
</div>

{{-- SweetAlert2 CDN --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

{{-- Script konfirmasi --}}
<script>
    function konfirmasiSelesai(pesananId) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Pesanan akan ditandai sebagai selesai.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#16a34a',
            cancelButtonColor: '#dc2626',
            confirmButtonText: 'Iya, Selesaikan',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('form-selesai-' + pesananId).submit();
            }
        });
    }
</script>
@endsection
