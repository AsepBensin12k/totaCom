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
        $allPesanans = Pesanan::orderBy('tanggal', 'asc')->orderBy('id_pesanan', 'asc')->get();
        $nomorPesananMap = [];
        foreach ($allPesanans as $index => $pesanan) {
            $nomorPesananMap[$pesanan->id_pesanan] = $index + 1;
        }

        $pesanans = Pesanan::with([
            'status',
            'akun',
            'metodePembayaran',
            'detailPesanans' => function ($query) {
                $query->with('produk');
            }
        ])
            ->orderBy('tanggal', 'desc')
            ->orderBy('id_pesanan', 'desc')
            ->get();

        foreach ($pesanans as $pesanan) {
            $pesanan->nomor_pesanan = $nomorPesananMap[$pesanan->id_pesanan];
        }

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

    public function debug()
    {

        $details = DB::table('detail_pesanans')->get();

        $products = DB::table('produks')->get();

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
