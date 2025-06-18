<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan; // Pastikan model Pesanan diimpor
use App\Models\Produk;  // Pastikan model Produk diimpor
use Illuminate\Support\Facades\Auth; // Pastikan facade Auth diimpor

class UserDashboardController extends Controller
{
    /**
     * Tampilkan dashboard untuk pengguna yang masuk.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {

        $latestOrders = Pesanan::where('id_akun', Auth::id())
                                ->with(['status', 'detailPesanans'])
                                ->orderBy('created_at', 'desc')
                                ->limit(3)
                                ->get();


        $recommendedProducts = Produk::inRandomOrder()
                                     ->limit(4)
                                     ->get();

        // Kirim data ke view dashboard
        return view('user.dashboard.index', compact('latestOrders', 'recommendedProducts'));
    }
}
