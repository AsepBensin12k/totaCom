<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RiwayatUserController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $pesanans = Pesanan::with(['status', 'metodePembayaran', 'detailPesanans.produk', 'akun.alamat'])
            ->where('id_akun', $userId)
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        $currentPage = $pesanans->currentPage();
        $perPage = $pesanans->perPage();

        foreach ($pesanans as $index => $pesanan) {
            $pesanan->nomor_pesanan = ($currentPage - 1) * $perPage + $index + 1;

            // Total produk
            $totalProduk = $pesanan->detailPesanans->sum(function ($detail) {
                return $detail->harga * $detail->qty;
            });

            // Tambahkan ongkir jika ada
            $pesanan->total_harga = $totalProduk + $this->hitungOngkir($pesanan);
        }

        return view('user.pesanan.riwayat', compact('pesanans'));
    }

    public function updateStatus(Request $request, $id)
    {
        $pesanan = Pesanan::where('id_pesanan', $id)
            ->where('id_akun', auth()->id())
            ->firstOrFail();

        if ($pesanan->id_status != 2) {
            return back()->with('error', 'Status hanya bisa diubah dari Dikirim ke Selesai.');
        }

        $pesanan->id_status = 3; // 3 = Selesai
        $pesanan->save();

        return back()->with('success', 'Status pesanan berhasil diubah menjadi Selesai.');
    }

    private function hitungOngkir($pesanan)
    {
        $tarif = [
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

        $idKecamatan = $pesanan->akun->alamat->id_kecamatan ?? null;

        return $tarif[$idKecamatan] ?? 0;
    }
}
