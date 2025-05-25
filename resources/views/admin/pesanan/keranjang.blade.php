@extends('layouts.admin')
@section('title', 'Keranjang')

@section('content')
    <div class="container mx-auto px-4 py-4">
        <h2 class="text-2xl font-bold mb-4">Keranjang</h2>

        @if (session('success'))
            <div id="flash-message" class="bg-green-100 text-green-800 p-3 rounded mb-4">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div id="flash-message" class="bg-red-100 text-red-800 p-3 rounded mb-4">{{ session('error') }}</div>
        @endif

        @if ($errors->any())
            <div id="flash-message" class="bg-red-100 text-red-800 p-3 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
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

            <form action="{{ route('keranjang.checkout') }}" method="POST"
                @if (!$isAdmin) enctype="multipart/form-data" @endif class="mt-6">
                @csrf
                <div class="mt-4">
                    <label class="block font-semibold mb-4 text-lg">Pilih Metode Pembayaran:</label>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Cash Option -->
                        <label
                            class="flex items-center gap-3 p-4 border-2 rounded-lg cursor-pointer hover:bg-gray-50 transition-colors border-gray-300 hover:border-blue-400">
                            <input type="radio" name="metode_pembayaran" value="cash" required
                                class="w-4 h-4 text-blue-600">
                            <div class="flex items-center gap-3">
                                <div class="p-2 bg-green-100 rounded-full">
                                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z">
                                        </path>
                                    </svg>
                                </div>
                                <div>
                                    <span class="font-medium text-gray-900">Cash</span>
                                    <p class="text-sm text-gray-500">
                                        @if ($isAdmin)
                                            Langsung diselesaikan
                                        @else
                                            Bayar langsung di tempat
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </label>

                        <label
                            class="flex items-start gap-3 p-4 border-2 rounded-lg cursor-pointer hover:bg-gray-50 transition-colors border-gray-300 hover:border-blue-400">
                            <input type="radio" name="metode_pembayaran" value="transfer" required
                                class="w-4 h-4 text-blue-600 mt-1" id="transfer-radio">
                            <div class="flex-1">
                                <div class="flex items-center gap-3 mb-3">
                                    <div class="p-2 bg-blue-100 rounded-full">
                                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z">
                                            </path>
                                        </svg>
                                    </div>
                                    <div>
                                        <span class="font-medium text-gray-900">Transfer Bank</span>
                                        <p class="text-sm text-gray-500">
                                            @if ($isAdmin)
                                                Langsung diselesaikan
                                            @else
                                                Transfer ke rekening toko
                                            @endif
                                        </p>
                                    </div>
                                </div>
                                <div class="bg-blue-50 rounded-lg p-3 border border-blue-200">
                                    <div class="flex items-center gap-3 mb-2">
                                        <div class="w-10 h-8 bg-blue-600 rounded flex items-center justify-center">
                                            <span class="text-white text-xs font-bold">BCA</span>
                                        </div>
                                        <div>
                                            <p class="font-medium text-blue-900">Bank Central Asia (BCA)</p>
                                            <p class="text-sm text-blue-700">No. Rekening: <span
                                                    class="font-mono font-bold">1234567890</span></p>
                                            <p class="text-sm text-blue-700">A.n: Toko ABC</p>
                                        </div>
                                    </div>
                                    <div class="text-xs text-blue-600 mt-2">
                                        <p>• Upload bukti pembayaran setelah transfer</p>
                                    </div>
                                </div>
                                <div class="bg-green-50 rounded-lg p-3 border border-green-200 mt-2">
                                    <div class="flex items-center gap-3 mb-2">
                                        <div class="w-10 h-8 bg-green-600 rounded flex items-center justify-center">
                                            <span class="text-white text-xs font-bold">BRI</span>
                                        </div>
                                        <div>
                                            <p class="font-medium text-green-900">Bank Rakyat Indonesia (BRI)</p>
                                            <p class="text-sm text-green-700">No. Rekening: <span
                                                    class="font-mono font-bold">0987654321</span></p>
                                            <p class="text-sm text-green-700">A.n: Toko ABC</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </label>
                    </div>
                </div>

                <div class="mt-6 flex gap-4">
                    <button type="submit"
                        class="bg-green-600 text-white px-8 py-3 rounded-lg hover:bg-green-700 font-medium flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        @if ($isAdmin)
                            Selesaikan Pesanan
                        @else
                            Proses Pesanan
                        @endif
                    </button>

                    <a href="{{ route('pesanan.index') }}"
                        class="bg-gray-500 text-white px-6 py-3 rounded-lg hover:bg-gray-600 font-medium">
                        Kembali Belanja
                    </a>
                </div>
            </form>
        @endif
    </div>

    <script>
        // Auto hide flash messages
        setTimeout(() => {
            const msg = document.getElementById('flash-message');
            if (msg) msg.style.display = 'none';
        }, 5000);

        document.querySelectorAll('input[name="metode_pembayaran"]').forEach(radio => {
            radio.addEventListener('change', function() {
                document.querySelectorAll('label').forEach(label => {
                    label.classList.remove('border-blue-500', 'bg-blue-50');
                    label.classList.add('border-gray-300');
                });

                // Add active styling to selected label
                if (this.checked) {
                    const label = this.closest('label');
                    label.classList.remove('border-gray-300');
                    label.classList.add('border-blue-500', 'bg-blue-50');
                }
            });
        });
    </script>
@endsection
