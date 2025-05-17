<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AnalisaProdukController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->input('filter', '12bulan');
        $bulanIni = Carbon::now()->format('m');
        $tahunIni = Carbon::now()->format('Y');

        $produkTerlaris = DB::table('riwayat_transaksies')
            ->join('detail_pesanans', 'riwayat_transaksies.id_detail', '=', 'detail_pesanans.id_detail')
            ->join('pesanans', 'detail_pesanans.id_pesanan', '=', 'pesanans.id_pesanan')
            ->join('produks', 'detail_pesanans.id_produk', '=', 'produks.id_produk')
            ->join('statuses', 'pesanans.id_status', '=', 'statuses.id_status')
            ->where('statuses.id_status', 3)
            ->select('produks.nama_produk', DB::raw('SUM(detail_pesanans.qty) as total_terjual'))
            ->groupBy('produks.id_produk', 'produks.nama_produk')
            ->orderByDesc('total_terjual')
            ->limit(10)
            ->get();

        $kategoriTerlaris = DB::table('riwayat_transaksies')
            ->join('detail_pesanans', 'riwayat_transaksies.id_detail', '=', 'detail_pesanans.id_detail')
            ->join('pesanans', 'detail_pesanans.id_pesanan', '=', 'pesanans.id_pesanan')
            ->join('produks', 'detail_pesanans.id_produk', '=', 'produks.id_produk')
            ->join('jenises', 'produks.id_jenis', '=', 'jenises.id_jenis')
            ->join('statuses', 'pesanans.id_status', '=', 'statuses.id_status')
            ->where('statuses.id_status', 3)
            ->select('jenises.nama_jenis', DB::raw('SUM(detail_pesanans.qty) as total_terjual'))
            ->groupBy('jenises.id_jenis', 'jenises.nama_jenis')
            ->orderByDesc('total_terjual')
            ->get();


        $query = DB::table('riwayat_transaksies')
            ->join('detail_pesanans', 'riwayat_transaksies.id_detail', '=', 'detail_pesanans.id_detail')
            ->join('pesanans', 'detail_pesanans.id_pesanan', '=', 'pesanans.id_pesanan')
            ->join('produks', 'detail_pesanans.id_produk', '=', 'produks.id_produk')
            ->join('statuses', 'pesanans.id_status', '=', 'statuses.id_status')
            ->where('statuses.id_status', 3);

        if ($filter == '2minggu') {
            // Filter untuk 2 minggu terakhir
            $start = Carbon::now()->subWeeks(2)->startOfDay();
            $end = Carbon::now()->endOfDay();
            $query->whereBetween('pesanans.tanggal', [$start, $end])
                ->select(
                    DB::raw("DATE_FORMAT(pesanans.tanggal, '%Y-%m-%d') as label"),
                    DB::raw("SUM(detail_pesanans.qty) as total_terjual")
                )
                ->groupBy('label');
        } elseif ($filter == 'perbulan') {
            // Filter untuk penjualan 1 bulan terakhir
            $month = $request->input('bulan', Carbon::now()->format('m'));
            $year = $request->input('tahun', Carbon::now()->format('Y'));
            $query->whereMonth('pesanans.tanggal', $month)
                ->whereYear('pesanans.tanggal', $year)
                ->select(
                    DB::raw("DATE_FORMAT(pesanans.tanggal, '%Y-%m-%d') as label"),
                    DB::raw("SUM(detail_pesanans.qty) as total_terjual")
                )
                ->groupBy('label');
        } else {
            // Default: 12 bulan terakhir
            $query->whereBetween('pesanans.tanggal', [
                Carbon::now()->subMonths(11)->startOfMonth(),
                Carbon::now()->endOfMonth()
            ])
                ->select(
                    DB::raw("DATE_FORMAT(pesanans.tanggal, '%Y-%m') as label"),
                    DB::raw("SUM(detail_pesanans.qty) as total_terjual")
                )
                ->groupBy('label');
        }

        $warnaKategori = [
            '#f87171',
            '#facc15',
            '#34d399',
            '#60a5fa',
            '#a78bfa',
            '#f472b6',
            '#fb923c',
            '#4ade80',
            '#38bdf8',
            '#c084fc'
        ];

        $data = $query->orderBy('label')->get();

        return view('admin.analisa.index', compact('produkTerlaris', 'data', 'kategoriTerlaris', 'warnaKategori'));
    }
}
