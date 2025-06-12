<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\Status;
use App\Models\MetodePembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ManajemenPesananController extends Controller
{
    public function index(Request $request)
    {

        $allPesanans = Pesanan::orderBy('tanggal', 'asc')->orderBy('id_pesanan', 'asc')->get();
        $nomorPesananMap = [];
        foreach ($allPesanans as $index => $pesanan) {
            $nomorPesananMap[$pesanan->id_pesanan] = $index + 1;
        }

        $query = Pesanan::with([
            'status',
            'akun',
            'metodePembayaran',
            'detailPesanans' => function ($query) {
                $query->with('produk');
            }
        ]);

        // Filter berdasarkan search (nomor pesanan atau nama pemesan)
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm, $nomorPesananMap) {
                // Search berdasarkan nama pemesan
                $q->whereHas('akun', function ($subQuery) use ($searchTerm) {
                    $subQuery->where('nama', 'LIKE', '%' . $searchTerm . '%')
                        ->orWhere('username', 'LIKE', '%' . $searchTerm . '%');
                });

                if (is_numeric($searchTerm)) {
                    $pesananIds = array_keys($nomorPesananMap, (int)$searchTerm);
                    if (!empty($pesananIds)) {
                        $q->orWhereIn('id_pesanan', $pesananIds);
                    }
                }

                // Search berdasarkan format nomor pesanan (#PSN0001, PSN0001, PSN1, dll)
                if (preg_match('/^#?PSN(\d+)$/i', $searchTerm, $matches)) {
                    $nomorPesanan = (int)$matches[1];
                    $pesananIds = array_keys($nomorPesananMap, $nomorPesanan);
                    if (!empty($pesananIds)) {
                        $q->orWhereIn('id_pesanan', $pesananIds);
                    }
                }
            });
        }

        // Filter berdasarkan status (mendukung multiple selection)
        if ($request->filled('status')) {
            $statusIds = is_array($request->status) ? $request->status : [$request->status];
            $query->whereIn('id_status', $statusIds);
        }

        // Filter berdasarkan metode pembayaran (mendukung multiple selection)
        if ($request->filled('metode_pembayaran')) {
            $metodeIds = is_array($request->metode_pembayaran) ? $request->metode_pembayaran : [$request->metode_pembayaran];
            $query->whereIn('id_metode', $metodeIds);
        }

        $pesanans = $query->orderBy('tanggal', 'desc')
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

        // Ambil data untuk dropdown filter
        $statuses = Status::all();
        $metodePembayarans = MetodePembayaran::all();

        return view('admin.manajemen-pesanan.index', compact('pesanans', 'statuses', 'metodePembayarans'));
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
