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

        // Ubah baseQuery untuk menggunakan tabel pesanans sebagai basis dan left join detail_pesanans
        $baseQuery = DB::table('pesanans')
            ->leftJoin('detail_pesanans', 'pesanans.id_pesanan', '=', 'detail_pesanans.id_pesanan')
            ->leftJoin('produks', 'detail_pesanans.id_produk', '=', 'produks.id_produk')
            ->join('statuses', 'pesanans.id_status', '=', 'statuses.id_status')
            ->where('statuses.id_status', 3);

        // Terapkan filter waktu ke base query
        if ($filter === '2minggu') {
            $start = Carbon::now()->subWeeks(2)->startOfDay();
            $end = Carbon::now()->endOfDay();
            $baseQuery->whereBetween('pesanans.tanggal', [$start, $end]);
        } elseif ($filter === 'perbulan') {
            // Ambil bulan dan tahun dari request, jika tidak ada gunakan bulan dan tahun sekarang
            $month = $request->input('bulan');
            $year = $request->input('tahun');
            if (!$month || !$year) {
                $month = Carbon::now()->format('m');
                $year = Carbon::now()->format('Y');
            }
            // Gunakan whereRaw untuk memastikan filter bulan dan tahun tepat
            $baseQuery->whereRaw('MONTH(pesanans.tanggal) = ? AND YEAR(pesanans.tanggal) = ?', [$month, $year]);
        } else {
            $baseQuery->whereBetween('pesanans.tanggal', [
                Carbon::now()->subMonths(11)->startOfMonth(),
                Carbon::now()->endOfMonth()
            ]);
        }

        $produkTerlaris = (clone $baseQuery)
            ->join('jenises', 'produks.id_jenis', '=', 'jenises.id_jenis')
            ->select(
                'produks.nama_produk',
                'jenises.nama_jenis',
                'produks.harga',
                DB::raw('SUM(detail_pesanans.qty) as total_terjual'),
                DB::raw('SUM(detail_pesanans.qty * produks.harga) as total_pendapatan'),
                DB::raw('AVG(detail_pesanans.qty) as rata_rata_per_transaksi'),
                DB::raw('COUNT(DISTINCT pesanans.id_pesanan) as total_transaksi_produk')
            )
            ->groupBy('produks.id_produk', 'produks.nama_produk', 'jenises.nama_jenis', 'produks.harga')
            ->orderByDesc('total_terjual')
            ->limit(10)
            ->get();

        $kategoriTerlaris = (clone $baseQuery)
            ->join('jenises', 'produks.id_jenis', '=', 'jenises.id_jenis')
            ->select(
                'jenises.nama_jenis',
                DB::raw('SUM(detail_pesanans.qty) as total_terjual'),
                DB::raw('SUM(detail_pesanans.qty * produks.harga) as total_pendapatan'),
                DB::raw('COUNT(DISTINCT produks.id_produk) as jumlah_produk'),
                DB::raw('COUNT(DISTINCT pesanans.id_pesanan) as total_transaksi_kategori')
            )
            ->groupBy('jenises.id_jenis', 'jenises.nama_jenis')
            ->orderByDesc('total_terjual')
            ->get();

        $statistikUmum = (clone $baseQuery)
            ->select(
                DB::raw('SUM(detail_pesanans.qty) as total_produk_terjual'),
                DB::raw('SUM(detail_pesanans.qty * produks.harga) as total_pendapatan'),
                DB::raw('COUNT(DISTINCT pesanans.id_pesanan) as total_transaksi'),
                DB::raw('AVG(detail_pesanans.qty * produks.harga) as rata_rata_nilai_transaksi'),
                DB::raw('COUNT(DISTINCT detail_pesanans.id_produk) as total_produk_unik')
            )
            ->first();

        $query = clone $baseQuery;
        $query->whereNotNull('pesanans.tanggal');
        if ($filter === '2minggu' || $filter === 'perbulan') {
            $query->select(
                'pesanans.tanggal as label',
                DB::raw("DATE_FORMAT(pesanans.tanggal, '%d %M %Y') as display_label"),
                DB::raw("SUM(detail_pesanans.qty) as total_terjual"),
                DB::raw("SUM(detail_pesanans.qty * produks.harga) as total_pendapatan"),
                DB::raw("COUNT(DISTINCT pesanans.id_pesanan) as total_transaksi")
            )->groupBy('label', 'display_label');
        } else {
            $query->select(
                DB::raw("DATE_FORMAT(pesanans.tanggal, '%Y-%m') as label"),
                DB::raw("DATE_FORMAT(pesanans.tanggal, '%M %Y') as display_label"),
                DB::raw("SUM(detail_pesanans.qty) as total_terjual"),
                DB::raw("SUM(detail_pesanans.qty * produks.harga) as total_pendapatan"),
                DB::raw("COUNT(DISTINCT pesanans.id_pesanan) as total_transaksi")
            )->groupBy('label', 'display_label');
        }
        $data = $query->orderBy('label')->get();

        // Konversi label tanggal ke ISO 8601 string untuk menghindari invalid date di frontend
        $data = $data->map(function ($item) {
            try {
                $item->label = \Carbon\Carbon::parse($item->label)->toIso8601String();
            } catch (\Exception $e) {
                $item->label = null;
            }
            return $item;
        });

        $performaKategori = (clone $baseQuery)
            ->join('jenises', 'produks.id_jenis', '=', 'jenises.id_jenis')
            ->select(
                'jenises.nama_jenis',
                DB::raw('SUM(detail_pesanans.qty) as total_qty'),
                DB::raw('SUM(detail_pesanans.qty * produks.harga) as total_revenue'),
                DB::raw('AVG(detail_pesanans.qty * produks.harga) as avg_revenue'),
                DB::raw('COUNT(DISTINCT pesanans.id_pesanan) as total_transaksi')
            )
            ->groupBy('jenises.id_jenis', 'jenises.nama_jenis')
            ->orderByDesc('total_revenue')
            ->get();

        $totalKategori = $kategoriTerlaris->sum('total_terjual');
        $kategoriTerlaris = $kategoriTerlaris->map(function ($item) use ($totalKategori) {
            $item->persentase = $totalKategori > 0 ? round(($item->total_terjual / $totalKategori) * 100, 1) : 0;
            return $item;
        });

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

        $analisisLanjutan = $this->getAnalisisLanjutan($baseQuery);

        return view('admin.analisa.index', compact(
            'produkTerlaris',
            'data',
            'kategoriTerlaris',
            'warnaKategori',
            'statistikUmum',
            'performaKategori',
            'analisisLanjutan',
            'filter'
        ));
    }

    public function getRealtimeData(Request $request)
    {
        $filter = $request->input('filter', '12bulan');

        // Ubah baseQuery untuk menggunakan tabel pesanans sebagai basis dan left join detail_pesanans
        $baseQuery = DB::table('pesanans')
            ->leftJoin('detail_pesanans', 'pesanans.id_pesanan', '=', 'detail_pesanans.id_pesanan')
            ->leftJoin('produks', 'detail_pesanans.id_produk', '=', 'produks.id_produk')
            ->join('statuses', 'pesanans.id_status', '=', 'statuses.id_status')
            ->where('statuses.id_status', 3);

        if ($filter === '2minggu') {
            $baseQuery->whereBetween('pesanans.tanggal', [Carbon::now()->subWeeks(2)->startOfDay(), Carbon::now()->endOfDay()]);
        } elseif ($filter === 'perbulan') {
            $month = $request->input('bulan');
            $year = $request->input('tahun');
            if (!$month || !$year) {
                $month = Carbon::now()->format('m');
                $year = Carbon::now()->format('Y');
            }
            // Gunakan whereRaw untuk memastikan filter bulan dan tahun tepat
            $baseQuery->whereRaw('MONTH(pesanans.tanggal) = ? AND YEAR(pesanans.tanggal) = ?', [$month, $year]);
        } else {
            $baseQuery->whereBetween('pesanans.tanggal', [
                Carbon::now()->subMonths(11)->startOfMonth(),
                Carbon::now()->endOfMonth()
            ]);
        }

        $statistik = (clone $baseQuery)->select(
            DB::raw('SUM(detail_pesanans.qty) as total_produk'),
            DB::raw('SUM(detail_pesanans.qty * produks.harga) as total_pendapatan'),
            DB::raw('COUNT(DISTINCT pesanans.id_pesanan) as total_transaksi'),
            DB::raw('AVG(detail_pesanans.qty * produks.harga) as rata_rata_transaksi')
        )->first();

        $chartQuery = clone $baseQuery;
        $chartQuery->whereNotNull('pesanans.tanggal');
        if ($filter === '2minggu' || $filter === 'perbulan') {
            $chartData = $chartQuery->select(
                'pesanans.tanggal as label',
                DB::raw("DATE_FORMAT(pesanans.tanggal, '%d %M %Y') as display_label"),
                DB::raw("SUM(detail_pesanans.qty) as total_terjual"),
                DB::raw("SUM(detail_pesanans.qty * produks.harga) as total_pendapatan"),
                DB::raw("COUNT(DISTINCT pesanans.id_pesanan) as total_transaksi")
            )->groupBy('label', 'display_label')->orderBy('label')->get();
        } else {
            $chartData = $chartQuery->select(
                DB::raw("DATE_FORMAT(pesanans.tanggal, '%Y-%m') as label"),
                DB::raw("DATE_FORMAT(pesanans.tanggal, '%M %Y') as display_label"),
                DB::raw("SUM(detail_pesanans.qty) as total_terjual"),
                DB::raw("SUM(detail_pesanans.qty * produks.harga) as total_pendapatan"),
                DB::raw("COUNT(DISTINCT pesanans.id_pesanan) as total_transaksi")
            )->groupBy('label', 'display_label')->orderBy('label')->get();
        }

        $topProduk = (clone $baseQuery)
            ->join('jenises', 'produks.id_jenis', '=', 'jenises.id_jenis')
            ->select(
                'produks.nama_produk',
                'jenises.nama_jenis',
                'produks.harga',
                DB::raw('SUM(detail_pesanans.qty) as total_terjual'),
                DB::raw('SUM(detail_pesanans.qty * produks.harga) as total_pendapatan')
            )
            ->groupBy('produks.id_produk', 'produks.nama_produk', 'jenises.nama_jenis', 'produks.harga')
            ->orderByDesc('total_terjual')
            ->limit(10)
            ->get();

        $kategori = (clone $baseQuery)
            ->join('jenises', 'produks.id_jenis', '=', 'jenises.id_jenis')
            ->select(
                'jenises.nama_jenis',
                DB::raw('SUM(detail_pesanans.qty) as total_terjual'),
                DB::raw('SUM(detail_pesanans.qty * produks.harga) as total_pendapatan')
            )
            ->groupBy('jenises.id_jenis', 'jenises.nama_jenis')
            ->orderByDesc('total_terjual')
            ->get();

        return response()->json([
            'statistik' => $statistik,
            'chartData' => $chartData,
            'topProduk' => $topProduk,
            'kategori' => $kategori,
            'timestamp' => now()->toISOString()
        ]);
    }


    public function grafik(Request $request)
    {
        // This can return the same data as getRealtimeData for now
        return $this->getRealtimeData($request);
    }
    // Method untuk AJAX request data real-time
    // Method untuk mendapatkan analisis lanjutan
    private function getAnalisisLanjutan($baseQuery)
    {
        // Trend growth calculation
        $currentMonth = (clone $baseQuery)
            ->whereMonth('pesanans.tanggal', Carbon::now()->format('m'))
            ->whereYear('pesanans.tanggal', Carbon::now()->format('Y'))
            ->select(
                DB::raw('SUM(detail_pesanans.qty) as current_qty'),
                DB::raw('SUM(detail_pesanans.qty * produks.harga) as current_revenue')
            )->first();

        $previousMonth = (clone $baseQuery)
            ->whereMonth('pesanans.tanggal', Carbon::now()->subMonth()->format('m'))
            ->whereYear('pesanans.tanggal', Carbon::now()->subMonth()->format('Y'))
            ->select(
                DB::raw('SUM(detail_pesanans.qty) as previous_qty'),
                DB::raw('SUM(detail_pesanans.qty * produks.harga) as previous_revenue')
            )->first();

        // Calculate growth percentage
        $qtyGrowth = 0;
        $revenueGrowth = 0;

        if ($previousMonth && $previousMonth->previous_qty > 0) {
            $qtyGrowth = (($currentMonth->current_qty - $previousMonth->previous_qty) / $previousMonth->previous_qty) * 100;
        }

        if ($previousMonth && $previousMonth->previous_revenue > 0) {
            $revenueGrowth = (($currentMonth->current_revenue - $previousMonth->previous_revenue) / $previousMonth->previous_revenue) * 100;
        }

        return [
            'qty_growth' => round($qtyGrowth, 1),
            'revenue_growth' => round($revenueGrowth, 1),
            'current_month' => $currentMonth,
            'previous_month' => $previousMonth
        ];
    }

    // Method untuk mendapatkan data export
    public function exportData(Request $request)
    {
        $filter = $request->input('filter', '12bulan');

        $baseQuery = DB::table('riwayat_transaksies')
            ->join('detail_pesanans', 'riwayat_transaksies.id_detail', '=', 'detail_pesanans.id_detail')
            ->join('pesanans', 'detail_pesanans.id_pesanan', '=', 'pesanans.id_pesanan')
            ->join('produks', 'detail_pesanans.id_produk', '=', 'produks.id_produk')
            ->join('jenises', 'produks.id_jenis', '=', 'jenises.id_jenis')
            ->join('statuses', 'pesanans.id_status', '=', 'statuses.id_status')
            ->where('statuses.id_status', 3);

        // Apply filter
        if ($filter == '2minggu') {
            $start = Carbon::now()->subWeeks(2)->startOfDay();
            $end = Carbon::now()->endOfDay();
            $baseQuery->whereBetween('pesanans.tanggal', [$start, $end]);
        } elseif ($filter == 'perbulan') {
            $baseQuery->whereMonth('pesanans.tanggal', Carbon::now()->format('m'))
                ->whereYear('pesanans.tanggal', Carbon::now()->format('Y'));
        } else {
            $baseQuery->whereBetween('pesanans.tanggal', [
                Carbon::now()->subMonths(11)->startOfMonth(),
                Carbon::now()->endOfMonth()
            ]);
        }

        $data = $baseQuery->select(
            'pesanans.tanggal',
            'produks.nama_produk',
            'jenises.nama_jenis',
            'detail_pesanans.qty',
            'produks.harga',
            DB::raw('detail_pesanans.qty * produks.harga as total')
        )->orderBy('pesanans.tanggal', 'desc')->get();

        return response()->json($data);
    }
}
