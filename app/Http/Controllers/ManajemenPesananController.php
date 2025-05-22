<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class ManajemenPesananController extends Controller
{
    public function index()
    {
        // Debug query untuk melihat apakah data ada
        $pesanans = Pesanan::with([
            'status',
            'akun',
            'metodePembayaran',
            'detailPesanans' => function ($query) {
                $query->with('produk');
            }
        ])
            ->orderBy('tanggal', 'desc')
            ->get();

        // Debug: cek apakah relasi produk ter-load
        foreach ($pesanans as $pesanan) {
            foreach ($pesanan->detailPesanans as $detail) {
                if (!$detail->produk) {
                    Log::warning("Produk tidak ditemukan untuk detail pesanan ID: {$detail->id_detail}, id_produk: {$detail->id_produk}");
                }
            }
        }

        $statuses = Status::all();

        return view('admin.manajemen-pesanan.index', compact('pesanans', 'statuses'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'id_status' => 'required|in:1,2',
        ]);

        $pesanan = Pesanan::findOrFail($id);

        if ($pesanan->id_status != 1) {
            return back()->with('error', 'Hanya status Diproses yang bisa diubah.');
        }

        if ($request->id_status != 2) {
            return back()->with('error', 'Status hanya bisa diubah ke Dikirim.');
        }

        $pesanan->id_status = $request->id_status;
        $pesanan->save();

        return redirect()->route('manajemen.pesanan.index')->with('success', 'Status berhasil diubah.');
    }

    // Method untuk debug
    public function debug()
    {
        // Cek data di detail_pesanans
        $details = DB::table('detail_pesanans')->get();

        // Cek data di produks  
        $products = DB::table('produks')->get();

        // Cek join manual
        $joined = DB::table('detail_pesanans')
            ->leftJoin('produks', 'detail_pesanans.id_produk', '=', 'produks.id_produk')
            ->select('detail_pesanans.*', 'produks.nama_produk')
            ->get();

        return response()->json([
            'detail_pesanans' => $details,
            'produks' => $products,
            'joined_data' => $joined
        ]);
    }
}
