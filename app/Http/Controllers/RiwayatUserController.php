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

        $pesanans = Pesanan::with(['status', 'metodePembayaran', 'detailPesanans.produk'])
            ->where('id_akun', $userId)
            ->orderBy('created_at', 'desc')
            ->get();

        foreach ($pesanans as $index => $pesanan) {
            $pesanan->nomor_pesanan = $index + 1;
            $pesanan->total_harga = $pesanan->detailPesanans->sum(function ($detail) {
                return $detail->harga * $detail->jumlah;
            });
        }

        return view('user.pesanan.riwayat', compact('pesanans'));
    }

    public function updateStatus(Request $request, $id)
    {
        $pesanan = Pesanan::where('id_pesanan', $id)
            ->where('id_akun', auth()->id()) // pastikan user cuma bisa update pesanan miliknya
            ->firstOrFail();

        // Cek status sekarang harus "Dikirim" (misal id_status = 2)
        if ($pesanan->id_status != 2) {
            return back()->with('error', 'Status hanya bisa diubah dari Dikirim ke Selesai.');
        }

        // Update status ke "Selesai" (misal id_status = 3)
        $pesanan->id_status = 3;
        $pesanan->save();

        return back()->with('success', 'Status pesanan berhasil diubah menjadi Selesai.');
    }
}
