<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Pesanan;
use App\Models\Akun;
use App\Models\Jenis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Basic Statistics
        $totalProduk = Produk::count();
        $totalPesanan = Pesanan::count();
        $totalPesananSelesai = Pesanan::where('id_status', 3)->count();
        $totalAkun = Akun::count();

        // Revenue calculations
        $totalRevenue = DB::table('detail_pesanans')
            ->join('pesanans', 'detail_pesanans.id_pesanan', '=', 'pesanans.id_pesanan')
            ->join('produks', 'detail_pesanans.id_produk', '=', 'produks.id_produk')
            ->where('pesanans.id_status', 3)
            ->sum(DB::raw('detail_pesanans.qty * produks.harga'));

        $revenueHariIni = DB::table('detail_pesanans')
            ->join('pesanans', 'detail_pesanans.id_pesanan', '=', 'pesanans.id_pesanan')
            ->join('produks', 'detail_pesanans.id_produk', '=', 'produks.id_produk')
            ->where('pesanans.id_status', 3)
            ->whereDate('pesanans.tanggal', Carbon::today())
            ->sum(DB::raw('detail_pesanans.qty * produks.harga'));

        $revenueBulanIni = DB::table('detail_pesanans')
            ->join('pesanans', 'detail_pesanans.id_pesanan', '=', 'pesanans.id_pesanan')
            ->join('produks', 'detail_pesanans.id_produk', '=', 'produks.id_produk')
            ->where('pesanans.id_status', 3)
            ->whereMonth('pesanans.tanggal', Carbon::now()->month)
            ->whereYear('pesanans.tanggal', Carbon::now()->year)
            ->sum(DB::raw('detail_pesanans.qty * produks.harga'));

        // Low stock products
        $produkMenipis = Produk::where('stok', '<=', 5)
            ->orderBy('stok', 'asc')
            ->get(['id_produk', 'nama_produk', 'stok']);

        // Pending orders
        $pesananPending = Pesanan::where('id_status', 1)->count();

        // Recent orders
        $pesananTerbaru = Pesanan::with(['akun', 'status'])
            ->orderBy('tanggal', 'desc')
            ->limit(5)
            ->get();

        // Top products this month
        $bulanIni = date('Y-m');
        $produkTerlaris = DB::table('detail_pesanans')
            ->join('pesanans', 'detail_pesanans.id_pesanan', '=', 'pesanans.id_pesanan')
            ->join('produks', 'detail_pesanans.id_produk', '=', 'produks.id_produk')
            ->select('produks.id_produk', 'produks.nama_produk', DB::raw('SUM(detail_pesanans.qty) as total_terjual'))
            ->where('pesanans.id_status', 3)
            ->whereRaw("DATE_FORMAT(pesanans.tanggal, '%Y-%m') = ?", [$bulanIni])
            ->groupBy('produks.id_produk', 'produks.nama_produk')
            ->orderByDesc('total_terjual')
            ->limit(5)
            ->get();

        // Category performance
        $kategoriTerlaris = DB::table('detail_pesanans')
            ->join('pesanans', 'detail_pesanans.id_pesanan', '=', 'pesanans.id_pesanan')
            ->join('produks', 'detail_pesanans.id_produk', '=', 'produks.id_produk')
            ->join('jenises', 'produks.id_jenis', '=', 'jenises.id_jenis')
            ->select('jenises.id_jenis', 'jenises.nama_jenis', DB::raw('SUM(detail_pesanans.qty) as total_terjual'))
            ->where('pesanans.id_status', 3)
            ->whereRaw("DATE_FORMAT(pesanans.tanggal, '%Y-%m') = ?", [$bulanIni])
            ->groupBy('jenises.id_jenis', 'jenises.nama_jenis')
            ->orderByDesc('total_terjual')
            ->get();

        // Daily sales for the last 7 days
        $dailySales = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $sales = DB::table('detail_pesanans')
                ->join('pesanans', 'detail_pesanans.id_pesanan', '=', 'pesanans.id_pesanan')
                ->join('produks', 'detail_pesanans.id_produk', '=', 'produks.id_produk')
                ->where('pesanans.id_status', 3)
                ->whereDate('pesanans.tanggal', $date)
                ->sum(DB::raw('detail_pesanans.qty * produks.harga'));

            $dailySales[] = [
                'date' => $date->format('M d'),
                'sales' => $sales ?: 0
            ];
        }

        // Monthly comparison
        $bulanLalu = Carbon::now()->subMonth();
        $revenueBulanLalu = DB::table('detail_pesanans')
            ->join('pesanans', 'detail_pesanans.id_pesanan', '=', 'pesanans.id_pesanan')
            ->join('produks', 'detail_pesanans.id_produk', '=', 'produks.id_produk')
            ->where('pesanans.id_status', 3)
            ->whereMonth('pesanans.tanggal', $bulanLalu->month)
            ->whereYear('pesanans.tanggal', $bulanLalu->year)
            ->sum(DB::raw('detail_pesanans.qty * produks.harga'));

        $growthRate = $revenueBulanLalu > 0 ? (($revenueBulanIni - $revenueBulanLalu) / $revenueBulanLalu) * 100 : 0;

        // Order status distribution
        $statusDistribution = DB::table('pesanans')
            ->join('statuses', 'pesanans.id_status', '=', 'statuses.id_status')
            ->select('statuses.nama_status', DB::raw('COUNT(*) as total'))
            ->groupBy('statuses.id_status', 'statuses.nama_status')
            ->get();

        return view('admin.dashboard.dashboard', compact(
            'totalProduk',
            'totalPesanan',
            'totalPesananSelesai',
            'totalAkun',
            'totalRevenue',
            'revenueHariIni',
            'revenueBulanIni',
            'produkMenipis',
            'pesananPending',
            'pesananTerbaru',
            'produkTerlaris',
            'kategoriTerlaris',
            'dailySales',
            'growthRate',
            'statusDistribution'
        ));
    }
}
