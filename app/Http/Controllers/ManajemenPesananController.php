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
            'akun.alamat',
            'metodePembayaran',
            'detailPesanans' => function ($query) {
                $query->with('produk');
            }
        ]);

        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm, $nomorPesananMap) {
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

                if (preg_match('/^#?PSN(\d+)$/i', $searchTerm, $matches)) {
                    $nomorPesanan = (int)$matches[1];
                    $pesananIds = array_keys($nomorPesananMap, $nomorPesanan);
                    if (!empty($pesananIds)) {
                        $q->orWhereIn('id_pesanan', $pesananIds);
                    }
                }
            });
        }

        if ($request->filled('status')) {
            $statusIds = is_array($request->status) ? $request->status : [$request->status];
            $query->whereIn('id_status', $statusIds);
        }

        if ($request->filled('metode_pembayaran')) {
            $metodeIds = is_array($request->metode_pembayaran) ? $request->metode_pembayaran : [$request->metode_pembayaran];
            $query->whereIn('id_metode', $metodeIds);
        }

        $pesanans = $query->orderBy('tanggal', 'desc')
            ->orderBy('id_pesanan', 'desc')
            ->get();

        foreach ($pesanans as $pesanan) {
            $pesanan->nomor_pesanan = $nomorPesananMap[$pesanan->id_pesanan];

            $totalProduk = $pesanan->detailPesanans->sum(function ($detail) {
                return $detail->harga * $detail->qty;
            });

            $pesanan->total_ongkir = $this->hitungOngkir($pesanan);
            $pesanan->total_harga = $totalProduk + $pesanan->total_ongkir;
        }

        foreach ($pesanans as $pesanan) {
            foreach ($pesanan->detailPesanans as $detail) {
                if (!$detail->produk) {
                    Log::warning("Produk tidak ditemukan untuk detail pesanan ID: {$detail->id_detail}, id_produk: {$detail->id_produk}");
                }
            }
        }

        $statuses = Status::all();
        $metodePembayarans = MetodePembayaran::all();

        return view('admin.manajemen-pesanan.index', compact('pesanans', 'statuses', 'metodePembayarans'));
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

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'id_status' => 'required|in:2,4',
        ]);

        $pesanan = Pesanan::findOrFail($id);

        if ($pesanan->id_status != 1) {
            return back()->with('error', 'Hanya status Diproses yang bisa diubah.');
        }

        if ($request->id_status == 4) {
            $pesanan->load('detailPesanans.produk');
            foreach ($pesanan->detailPesanans as $detail) {
                if ($detail->produk) {
                    $detail->produk->increment('stok', $detail->qty);
                }
            }
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
