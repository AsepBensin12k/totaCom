@extends('layouts.admin')
@section('title', 'Keranjang')

@section('content')
    <h2 class="text-2xl font-bold mb-4">Keranjang</h2>

    @if (session('success'))
        <div id="flash-message" class="bg-green-100 text-green-800 p-3 rounded mb-4">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div id="flash-message" class="bg-red-100 text-red-800 p-3 rounded mb-4">{{ session('error') }}</div>
    @endif

    @if (empty($keranjang))
        <p class="text-gray-500">Keranjang kosong.</p>
    @else
        <div class="overflow-x-auto rounded-lg shadow-md">
            <table class="w-full text-left border border-collapse rounded-lg overflow-hidden">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 border">Nama Produk</th>
                        <th class="px-4 py-2 border">Harga</th>
                        <th class="px-4 py-2 border">Jumlah</th>
                        <th class="px-4 py-2 border">Subtotal</th>
                        <th class="px-4 py-2 border">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php $total = 0; @endphp
                    @foreach ($keranjang as $item)
                        @php
                            $subtotal = $item['qty'] * $item['harga'];
                            $total += $subtotal;
                        @endphp
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-2 border">{{ $item['nama_produk'] }}</td>
                            <td class="px-4 py-2 border">Rp{{ number_format($item['harga'], 0, ',', '.') }}</td>
                            <td class="px-4 py-2 border">
                                <div class="flex items-center gap-2">
                                    <form action="{{ route('keranjang.kurangQty') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id_produk" value="{{ $item['id_produk'] }}">
                                        <button type="submit"
                                            class="bg-gray-400 text-white px-2 py-1 rounded hover:bg-gray-500">–</button>
                                    </form>

                                    <span>{{ $item['qty'] }}</span>

                                    <form action="{{ route('keranjang.tambahQty') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id_produk" value="{{ $item['id_produk'] }}">
                                        <button type="submit"
                                            class="bg-gray-400 text-white px-2 py-1 rounded hover:bg-gray-500">+</button>
                                    </form>
                                </div>
                            </td>
                            <td class="px-4 py-2 border">Rp{{ number_format($subtotal, 0, ',', '.') }}</td>
                            <td class="px-4 py-2 border">
                                <form action="{{ route('keranjang.hapus') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id_produk" value="{{ $item['id_produk'] }}">
                                    <button type="submit"
                                        class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    <tr class="font-semibold bg-gray-200">
                        <td colspan="3" class="px-4 py-2 border text-right">Total</td>
                        <td colspan="2" class="px-4 py-2 border">Rp{{ number_format($total, 0, ',', '.') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Form Checkout -->
        <form action="{{ route('keranjang.checkout') }}" method="POST" class="mt-6">
            @csrf
            <div class="mt-4">
                <label class="block font-semibold mb-2">Pilih Metode Pembayaran:</label>
                <div class="flex flex-wrap gap-4">
                    <label class="flex items-center gap-2 p-3 border rounded cursor-pointer hover:bg-gray-100">
                        <input type="radio" name="metode_pembayaran" value="cash" required>
                        <span>Cash</span>
                    </label>
                    <label class="flex items-center gap-2 p-3 border rounded cursor-pointer hover:bg-gray-100">
                        <input type="radio" name="metode_pembayaran" value="transfer" required>
                        <span>Transfer</span>
                    </label>
                </div>
            </div>

            <button type="submit" class="mt-4 bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">
                Checkout
            </button>
        </form>
    @endif

    <script>
        setTimeout(() => {
            const msg = document.getElementById('flash-message');
            if (msg) msg.style.display = 'none';
        }, 1000);
    </script>
@endsection
