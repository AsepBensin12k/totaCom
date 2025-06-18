@extends('layouts.user')

@section('content')
    <div class="container mx-auto p-4 mt-4 mb-48">
        <h1 class="text-2xl font-bold mb-4">Keranjang Belanja</h1>
        <a href="{{ route('pesanan.buat') }}"
            class="inline-block bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded mb-4">
            + Pilih Produk</a>

        @if (session('success'))
            <div class="bg-green-200 text-green-800 p-2 mb-4 rounded">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="bg-red-200 text-red-800 p-2 mb-4 rounded">{{ session('error') }}</div>
        @endif

        @if ($keranjang->isEmpty())
            <p>Keranjang kosong.</p>
        @else
            <!-- Form hapus produk yang dipilih -->
            <form action="{{ route('pesanan.hapusMultiple') }}" method="POST" id="formHapusMultiple">
                @csrf
                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded mb-4 hover:bg-red-700"
                    onclick="return confirm('Yakin ingin hapus produk yang dipilih?')">
                    Hapus Produk yang Dipilih
                </button>

                <table class="w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border border-gray-300 p-2 text-center">
                                <input type="checkbox" id="selectAll" />
                            </th>
                            <th class="border border-gray-300 p-2">Nama Produk</th>
                            <th class="border border-gray-300 p-2">Harga</th>
                            <th class="border border-gray-300 p-2">Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($keranjang as $item)
                            <tr class="bg-gray-100">
                                <td class="border border-gray-300 p-2 text-center">
                                    <input type="checkbox" name="selected_produk[]" value="{{ $item['id_produk'] }}"
                                        class="selectItem" />
                                </td>
                                <td class="border border-gray-300 p-2">{{ $item['nama_produk'] }}</td>
                                <td class="border border-gray-300 p-2">Rp {{ number_format($item['harga'], 0, ',', '.') }}
                                </td>
                                <td class="border border-gray-300 p-2 text-center">{{ $item['qty'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </form>

            <!-- Form checkout produk terpilih -->
            <form action="{{ route('user.pesanan.checkout') }}" method="POST" class="mt-4" id="formCheckout">
                @csrf
                <!-- Hidden inputs akan ditambahkan dengan JS -->
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700"
                    onclick="return validateCheckout()">
                    Checkout Produk yang Dipilih
                </button>
            </form>
        @endif
    </div>

    <script>
        document.getElementById('selectAll').addEventListener('change', function() {
            const checked = this.checked;
            document.querySelectorAll('.selectItem').forEach(el => el.checked = checked);
            syncCheckoutInputs();
        });

        // Perubahan: tambah event listener ulang agar selalu sinkron
        document.querySelectorAll('.selectItem').forEach(cb => {
            cb.addEventListener('change', syncCheckoutInputs);
        });

        function syncCheckoutInputs() {
            const selectedIds = Array.from(document.querySelectorAll('.selectItem:checked')).map(cb => cb.value);
            const formCheckout = document.getElementById('formCheckout');

            // Hapus input sebelumnya
            document.querySelectorAll('#formCheckout input[name="selected_produk[]"]').forEach(i => i.remove());

            // Tambahkan yang baru
            selectedIds.forEach(id => {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'selected_produk[]';
                input.value = id;
                formCheckout.appendChild(input);
            });
        }

        function validateCheckout() {
            const selected = document.querySelectorAll('.selectItem:checked');
            if (selected.length === 0) {
                alert('Silakan pilih minimal satu produk untuk checkout.');
                return false;
            }

            // Penting: pastikan hidden inputs diperbarui sebelum kirim
            syncCheckoutInputs();
            return true;
        }

        // Saat halaman dimuat, tetap sinkron
        window.onload = syncCheckoutInputs;
    </script>

@endsection
