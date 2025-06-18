@extends('layouts.admin')

@section('title', 'Manajemen Pesanan')

@section('content')
    <div class="container mx-auto px-4 py-6">

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

        @if (session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded mb-6">
                {{ session('error') }}
            </div>
        @endif

        {{-- Search Bar dan Filter --}}
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 mb-4">
            <form method="GET" action="{{ route('manajemen.pesanan.index') }}" id="filterForm">
                <div class="flex flex-col lg:flex-row lg:justify-between gap-4">

                    <div class="flex flex-col sm:flex-row items-stretch gap-2 w-full lg:max-w-md">
                        <input type="text" name="search" placeholder="Cari nomor pesanan atau nama pemesan..."
                            value="{{ request('search') }}" class="border border-gray-300 rounded-md px-4 py-2 w-full" />
                        <button type="submit"
                            class="bg-teal-500 text-white px-4 py-2 rounded-md hover:bg-teal-600 whitespace-nowrap">
                            Cari
                        </button>
                    </div>

                    <div class="flex flex-col sm:flex-row flex-wrap gap-4 w-full justify-end">

                        <div class="relative w-full sm:w-auto">
                            <button type="button" id="statusFilterBtn"
                                class="flex items-center justify-between px-4 py-2 w-full sm:w-[140px] border border-gray-300 rounded-md bg-white hover:bg-gray-50 focus:ring-2 focus:ring-teal-500 focus:border-teal-500">
                                <span class="text-sm text-gray-700">
                                    Status
                                    @if (request('status'))
                                        @php
                                            $selectedStatuses = is_array(request('status'))
                                                ? request('status')
                                                : [request('status')];
                                            $count = count($selectedStatuses);
                                        @endphp
                                        <span
                                            class="ml-1 bg-teal-100 text-teal-800 text-xs px-2 py-0.5 rounded-full">{{ $count }}</span>
                                    @endif
                                </span>
                                <svg class="w-4 h-4 ml-2 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>

                            <div id="statusDropdown"
                                class="hidden absolute top-full left-0 mt-1 w-64 bg-white border border-gray-200 rounded-md shadow-lg z-10">
                                <div class="p-3 space-y-2">
                                    @foreach ($statuses as $status)
                                        <label class="flex items-center hover:bg-gray-50 p-2 rounded cursor-pointer">
                                            <input type="checkbox" name="status[]" value="{{ $status->id_status }}"
                                                class="h-4 w-4 text-teal-600 focus:ring-teal-500 border-gray-300 rounded"
                                                {{ in_array($status->id_status, (array) request('status', [])) ? 'checked' : '' }}>
                                            <span class="ml-2 text-sm text-gray-700">{{ $status->nama_status }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        {{-- Filter Metode Pembayaran --}}
                        <div class="relative w-full sm:w-auto">
                            <button type="button" id="metodePembayaranFilterBtn"
                                class="flex items-center justify-between px-4 py-2 w-full sm:w-[160px] border border-gray-300 rounded-md bg-white hover:bg-gray-50 focus:ring-2 focus:ring-teal-500 focus:border-teal-500">
                                <span class="text-sm text-gray-700">
                                    Metode Bayar
                                    @if (request('metode_pembayaran'))
                                        @php
                                            $selectedMetodes = is_array(request('metode_pembayaran'))
                                                ? request('metode_pembayaran')
                                                : [request('metode_pembayaran')];
                                            $count = count($selectedMetodes);
                                        @endphp
                                        <span
                                            class="ml-1 bg-purple-100 text-purple-800 text-xs px-2 py-0.5 rounded-full">{{ $count }}</span>
                                    @endif
                                </span>
                                <svg class="w-4 h-4 ml-2 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>

                            <div id="metodePembayaranDropdown"
                                class="hidden absolute top-full left-0 mt-1 w-64 bg-white border border-gray-200 rounded-md shadow-lg z-10">
                                <div class="p-3 space-y-2">
                                    @foreach ($metodePembayarans as $metode)
                                        <label class="flex items-center hover:bg-gray-50 p-2 rounded cursor-pointer">
                                            <input type="checkbox" name="metode_pembayaran[]"
                                                value="{{ $metode->id_metode }}"
                                                class="h-4 w-4 text-teal-600 focus:ring-teal-500 border-gray-300 rounded"
                                                {{ in_array($metode->id_metode, (array) request('metode_pembayaran', [])) ? 'checked' : '' }}>
                                            <span class="ml-2 text-sm text-gray-700">{{ $metode->nama_metode }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        {{-- Tombol Filter & Reset --}}
                        <div class="flex gap-2 w-full sm:w-auto">
                            <button type="submit"
                                class="bg-teal-500 hover:bg-teal-600 text-white px-6 py-2 rounded-md transition duration-200 flex items-center justify-center w-full sm:w-auto font-medium">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                                Filter
                            </button>
                            <a href="{{ route('manajemen.pesanan.index') }}"
                                class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md transition duration-200 flex items-center justify-center w-full sm:w-auto">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                                    </path>
                                </svg>
                                Reset
                            </a>
                        </div>
                    </div>
                </div>
            </form>

            {{-- Info filter aktif --}}
            @if (request()->hasAny(['search', 'status', 'metode_pembayaran']))
                <div class="mt-4 pt-3 border-t border-gray-200">
                    <div class="flex flex-wrap items-center gap-2">
                        <span class="text-sm text-gray-600 font-medium">Filter aktif:</span>

                        @if (request('search'))
                            <span
                                class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800 border border-blue-200">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                                "{{ request('search') }}"
                                <a href="{{ request()->fullUrlWithQuery(['search' => null]) }}"
                                    class="ml-1 text-blue-600 hover:text-blue-800 font-bold">×</a>
                            </span>
                        @endif

                        @if (request('status'))
                            @php
                                $selectedStatuses = is_array(request('status'))
                                    ? request('status')
                                    : [request('status')];
                            @endphp
                            @foreach ($selectedStatuses as $statusId)
                                @php
                                    $selectedStatus = $statuses->firstWhere('id_status', $statusId);
                                @endphp
                                @if ($selectedStatus)
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 border border-green-200">
                                        {{ $selectedStatus->nama_status }}
                                        <a href="{{ request()->fullUrlWithQuery(['status' => array_diff($selectedStatuses, [$statusId])]) }}"
                                            class="ml-1 text-green-600 hover:text-green-800 font-bold">×</a>
                                    </span>
                                @endif
                            @endforeach
                        @endif

                        @if (request('metode_pembayaran'))
                            @php
                                $selectedMetodes = is_array(request('metode_pembayaran'))
                                    ? request('metode_pembayaran')
                                    : [request('metode_pembayaran')];
                            @endphp
                            @foreach ($selectedMetodes as $metodeId)
                                @php
                                    $selectedMetode = $metodePembayarans->firstWhere('id_metode', $metodeId);
                                @endphp
                                @if ($selectedMetode)
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800 border border-purple-200">
                                        {{ $selectedMetode->nama_metode }}
                                        <a href="{{ request()->fullUrlWithQuery(['metode_pembayaran' => array_diff($selectedMetodes, [$metodeId])]) }}"
                                            class="ml-1 text-purple-600 hover:text-purple-800 font-bold">×</a>
                                    </span>
                                @endif
                            @endforeach
                        @endif
                    </div>
                </div>
            @endif
        </div>

        {{-- Info hasil --}}
        @if ($pesanans->count() > 0)
            <div class="mb-4">
                <p class="text-sm text-gray-600">
                    Menampilkan <span class="font-semibold text-gray-800">{{ $pesanans->count() }}</span> pesanan
                    @if (request()->hasAny(['search', 'status', 'metode_pembayaran']))
                        dari hasil filter
                    @endif
                </p>
            </div>
        @endif

        {{-- Tabel utama --}}
        <div class="overflow-x-auto sm:rounded-lg">
            <table class="min-w-full bg-white border border-gray-300 shadow mb-2">
                <thead class="bg-teal-500 text-white text-sm">
                    <tr>
                        <th class="px-4 py-3 border">No.</th>
                        <th class="px-4 py-3 border">Nomor Pesanan</th>
                        <th class="px-4 py-3 border">Tanggal</th>
                        <th class="px-4 py-3 border">Akun</th>
                        <th class="px-4 py-3 border">Metode</th>
                        <th class="px-4 py-3 border">Status</th>
                        <th class="px-4 py-3 border">Bukti Pembayaran</th>
                        <th class="px-4 py-3 border">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-sm text-gray-700">
                    @forelse ($pesanans as $index => $pesanan)
                        <tr class="hover:bg-gray-50 transition-colors duration-150">
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
                                    @elseif($pesanan->status->id_status == 4) bg-red-100 text-red-800
                                    @else bg-gray-100 text-gray-800 @endif">
                                    {{ $pesanan->status->nama_status ?? '-' }}
                                </span>
                            </td>
                            <td class="border px-4 py-2 text-center">
                                @if ($pesanan->bukti_pembayaran)
                                    <a href="{{ asset('storage/' . $pesanan->bukti_pembayaran) }}" target="_blank"
                                        class="text-blue-600 hover:underline">Lihat Bukti</a>
                                @else
                                    <span class="text-red-500">Belum ada bukti</span>
                                @endif
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
                            <td colspan="8" class="p-4">
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
                                                        <td colspan="3" class="border px-4 py-2 text-right">Subtotal
                                                            Produk</td>
                                                        <td class="border px-4 py-2 text-right">
                                                            Rp{{ number_format($total, 0, ',', '.') }}
                                                        </td>
                                                    </tr>
                                                    <tr class="bg-gray-100 font-semibold">
                                                        <td colspan="3" class="border px-4 py-2 text-right">Ongkos
                                                            Kirim</td>
                                                        <td class="border px-4 py-2 text-right">
                                                            Rp{{ number_format($pesanan->total_ongkir ?? 0, 0, ',', '.') }}
                                                        </td>
                                                    </tr>
                                                    <tr class="bg-gray-200 font-bold">
                                                        <td colspan="3" class="border px-4 py-2 text-right">Total
                                                            (Produk + Ongkir)
                                                        </td>
                                                        <td class="border px-4 py-2 text-right text-lg">
                                                            Rp{{ number_format($pesanan->total_harga ?? 0, 0, ',', '.') }}
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
                                        <div class="flex gap-2">
                                            <form
                                                action="{{ route('manajemen.pesanan.updateStatus', $pesanan->id_pesanan) }}"
                                                method="POST" class="inline">
                                                @csrf
                                                <input type="hidden" name="id_status" value="2">
                                                <button type="submit"
                                                    onclick="return confirm('Yakin ingin mengubah status pesanan #PSN{{ str_pad($pesanan->nomor_pesanan, 4, '0', STR_PAD_LEFT) }} menjadi Dikirim?')"
                                                    class="bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded transition duration-200 font-semibold">
                                                    📦 Tandai Sebagai Dikirim
                                                </button>
                                            </form>
                                            <form
                                                action="{{ route('manajemen.pesanan.updateStatus', $pesanan->id_pesanan) }}"
                                                method="POST" class="inline">
                                                @csrf
                                                <input type="hidden" name="id_status" value="4">
                                                <button type="submit"
                                                    onclick="return confirm('Yakin ingin menolak pesanan #PSN{{ str_pad($pesanan->nomor_pesanan, 4, '0', STR_PAD_LEFT) }}?')"
                                                    class="bg-red-500 hover:bg-red-600 text-white px-6 py-2 rounded transition duration-200 font-semibold">
                                                    ❌ Tolak Pesanan
                                                </button>
                                            </form>
                                        </div>
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
                                @if (request()->hasAny(['search', 'status', 'metode_pembayaran']))
                                    Tidak ada pesanan yang sesuai dengan filter yang dipilih.
                                @else
                                    Tidak ada data pesanan.
                                @endif
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="mt-4">
            {{ $pesanans->links() }}
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
                <div class="flex items-center mb-1">
                    <span class="px-2 py-1 rounded text-xs font-semibold bg-red-100 text-red-800 mr-2">Ditolak</span>
                    <span>Pesanan dibatalkan oleh admin</span>
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

        // Toggle dropdown filters
        document.addEventListener('DOMContentLoaded', function() {
            // For Status Filter
            const statusBtn = document.getElementById('statusFilterBtn');
            const statusDropdown = document.getElementById('statusDropdown');

            statusBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                statusDropdown.classList.toggle('hidden');
                // Close other dropdown
                document.getElementById('metodePembayaranDropdown').classList.add('hidden');
            });

            // For Metode Pembayaran Filter
            const metodeBtn = document.getElementById('metodePembayaranFilterBtn');
            const metodeDropdown = document.getElementById('metodePembayaranDropdown');

            metodeBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                metodeDropdown.classList.toggle('hidden');
                // Close other dropdown
                statusDropdown.classList.add('hidden');
            });

            // Close dropdowns when clicking outside
            document.addEventListener('click', function(e) {
                if (!statusBtn.contains(e.target) && !statusDropdown.contains(e.target)) {
                    statusDropdown.classList.add('hidden');
                }
                if (!metodeBtn.contains(e.target) && !metodeDropdown.contains(e.target)) {
                    metodeDropdown.classList.add('hidden');
                }
            });

            // Prevent dropdown from closing when clicking inside
            statusDropdown.addEventListener('click', function(e) {
                e.stopPropagation();
            });
            metodeDropdown.addEventListener('click', function(e) {
                e.stopPropagation();
            });
        });
    </script>
@endsection
