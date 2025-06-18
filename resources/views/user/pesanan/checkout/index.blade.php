@extends('layouts.user')

@section('title', 'Checkout')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="bg-white shadow-md rounded p-6">
        <h2 class="text-2xl font-bold mb-4">Checkout</h2>

        <form action="{{ route('user.pesanan.checkout.simpan') }}" method="POST" enctype="multipart/form-data">
            @csrf
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
                    @foreach ($checkoutItems as $item)
                        @php
                            $subtotal = $item->jumlah_produk * $item->produk->harga;
                            $total += $subtotal;
                        @endphp
                        <tr>
                            <td class="px-4 py-2 border">{{ $item->produk->nama_produk }}</td>
                            <td class="px-4 py-2 border">Rp{{ number_format($item->produk->harga, 0, ',', '.') }}</td>
                            <td class="px-4 py-2 border">{{ $item->jumlah_produk }}</td>
                            <td class="px-4 py-2 border">Rp{{ number_format($subtotal, 0, ',', '.') }}</td>
                        </tr>
                        <input type="hidden" name="produk_terpilih[]" value="{{ $item->id }}">
                    @endforeach
                </tbody>
            </table>

            @php
                $idKecamatan = Auth::user()->alamat->id_kecamatan ?? null;
                $tarifOngkir = [
        1 => 30000,
        2 => 30000,
        3 => 30000,
        4 => 20000,
        5 => 25000,
        6 => 35000,
        7 => 35000,
        8 => 15000,
        9 => 12000,
        10 => 15000,
        11 => 0,
        12 => 15000,
        13 => 20000,
        14 => 22000,
        15 => 25000,
        16 => 30000,
        17 => 35000,
        18 => 30000,
        19 => 25000,
        20 => 22000,
        21 => 20000,
        22 => 20000,
        23 => 15000,
        24 => 20000,
        25 => 25000,
        26 => 25000,
        27 => 22000,
        28 => 22000,
        29 => 10000,
        30 => 5000,
        31 => 12000,
        ];
                $ongkir = $tarifOngkir[$idKecamatan] ?? 0;
                $totalWithOngkir = $total + $ongkir;
            @endphp

            <div class="text-right mb-2">
                <p>Ongkir: <strong>Rp{{ number_format($ongkir, 0, ',', '.') }}</strong></p>
            </div>
            <div class="text-right mb-4">
                <strong>Total + Ongkir: Rp{{ number_format($totalWithOngkir, 0, ',', '.') }}</strong>
            </div>



            <div class="mb-4">
                <label for="metode_pembayaran" class="block mb-2 font-medium">Metode Pembayaran:</label>
                <select name="metode_pembayaran" id="metode_pembayaran" class="w-full border p-2 rounded" required>
                    <option value="">-- Pilih Metode --</option>
                    <option value="transfer">Transfer</option>
                    <option value="cash" hidden>Cash</option>
                </select>
            </div>

            {{-- Info rekening bank dan input bukti pembayaran --}}
            <div id="bank-info" class="hidden mb-4 bg-gray-50 border p-3 rounded">
                <p class="font-semibold mb-2">Silakan transfer ke salah satu rekening berikut:</p>
                <ul class="list-disc ml-5 text-sm">
                    <li>BRI - 1234567890 a.n Toko Kita</li>
                    <li>Mandiri - 9876543210 a.n Toko Kita</li>
                </ul>
            </div>

            <div id="bukti-section" class="hidden mb-4">
                <label for="bukti_pembayaran" class="block mb-2 font-medium">Upload Bukti Pembayaran:</label>
                <input type="file" name="bukti_pembayaran" id="bukti_pembayaran" class="w-full border p-2 rounded" accept="image/*">
                <p class="text-sm text-gray-500 mt-1">Format: JPG/PNG, maksimal 2MB</p>
            </div>

            <div class="text-right">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Konfirmasi Pembayaran
                </button>
            </div>
        </form>
    </div>
</div>

{{-- Script dinamis --}}
<script>
    const metodeSelect = document.getElementById('metode_pembayaran');
    const bankInfo = document.getElementById('bank-info');
    const buktiSection = document.getElementById('bukti-section');

    metodeSelect.addEventListener('change', function () {
        const buktiInput = document.getElementById('bukti_pembayaran');

        if (this.value === 'transfer') {
            bankInfo.classList.remove('hidden');
            buktiSection.classList.remove('hidden');
            buktiInput.setAttribute('required', 'required');
        } else {
            bankInfo.classList.add('hidden');
            buktiSection.classList.add('hidden');
            buktiInput.removeAttribute('required');
        }
    });
</script>
@endsection
