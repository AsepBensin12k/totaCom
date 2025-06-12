<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\KabupatenController;
use App\Http\Controllers\Api\KecamatanController;
use App\Http\Controllers\Api\ProvinsiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\AnalisaProdukController;
use App\Http\Controllers\DataAkunController;
use App\Http\Controllers\AdminProfilController;
use App\Http\Controllers\CustomerProfilController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\ManajemenPesananController;
use App\Http\Controllers\UserStokController;
use App\Http\Controllers\UserPesananController;
use App\Http\Controllers\RiwayatUserController;
use App\Http\Controllers\UserDashboardController;

Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', function () {
    return redirect()->route('login');
});

// ADMIN ROUTES - Terpisah dengan middleware admin
Route::middleware(['auth:admin'])->group(function () {
    Route::prefix('admin')->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::get('/profile', [AdminProfilController::class, 'index'])->name('admin.profile.index');
        Route::put('/profile', [AdminProfilController::class, 'update'])->name('admin.profile.update');

        Route::get('/analisa', [AnalisaProdukController::class, 'index'])->name('analisa.index');
        Route::get('/analisa/grafik', [AnalisaProdukController::class, 'grafik'])->name('analisa.grafik');

        Route::get('/data-akun', [DataAkunController::class, 'index'])->name('data_akun.index');

        Route::resource('stok', StokController::class);

        Route::get('/pesanan/produk', [PesananController::class, 'index'])->name('pesanan.index');
        Route::post('/pesanan/produk/tambah/{id_produk}', [PesananController::class, 'tambahKeranjang'])->name('pesanan.tambahKeranjang');
        Route::get('/pesanan/keranjang', [PesananController::class, 'keranjang'])->name('keranjang.index');
        Route::post('/pesanan/keranjang/tambah-qty', [PesananController::class, 'tambahQty'])->name('keranjang.tambahQty');
        Route::post('/pesanan/keranjang/kurang-qty', [PesananController::class, 'kurangQty'])->name('keranjang.kurangQty');
        Route::post('/pesanan/keranjang/hapus', [PesananController::class, 'hapusKeranjang'])->name('keranjang.hapus');
        Route::post('/pesanan/keranjang/checkout', [PesananController::class, 'checkout'])->name('keranjang.checkout');
        Route::get('/pesanan/invoice/{id_pesanan}', [PesananController::class, 'invoice'])->name('pesanan.invoice');

        Route::get('/manajemen-pesanan', [ManajemenPesananController::class, 'index'])->name('manajemen.pesanan.index');
        Route::post('/manajemen-pesanan/update-status/{id}', [ManajemenPesananController::class, 'updateStatus'])->name('manajemen.pesanan.updateStatus');
    });
});

// USER/CUSTOMER ROUTES - Terpisah dengan middleware customer
// USER/CUSTOMER ROUTES - Terpisah dengan middleware customer
Route::prefix('user')->middleware(['auth:web'])->group(function () {
    // --- GANTI RUTE INI ---
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
    // -----------------------

    Route::get('/profil', [CustomerProfilController::class, 'index'])->name('user.profile.index');
    Route::put('/profil', [CustomerProfilController::class, 'update'])->name('user.profile.update');

    Route::get('/produk', [UserStokController::class, 'index'])->name('user.produk.index');

    Route::get('/pesanan/buat', [UserPesananController::class, 'pesananIndex'])->name('pesanan.buat');
    Route::get('/pesanan/keranjang', [UserPesananController::class, 'pesananKeranjang'])->name('pesanan.keranjang');
    Route::post('/pesanan/tambah-keranjang/{id_produk}', [UserPesananController::class, 'tambahKeranjang'])->name('user.pesanan.tambahKeranjang');
    Route::post('/pesanan/tambah-qty', [UserPesananController::class, 'tambahQty'])->name('pesanan.tambahQty');
    Route::post('/pesanan/kurang-qty', [UserPesananController::class, 'kurangQty'])->name('pesanan.kurangQty');
    Route::post('/pesanan/hapus-keranjang', [UserPesananController::class, 'hapusKeranjang'])->name('pesanan.hapusKeranjang');
    Route::post('/pesanan/hapus-produk-terpilih', [UserPesananController::class, 'hapusMultiple'])->name('pesanan.hapusMultiple');

    // checkout
    Route::post('/pesanan/checkout', [UserPesananController::class, 'checkoutForm'])->name('user.pesanan.checkout');
    Route::post('/pesanan/checkout/simpan', [UserPesananController::class, 'checkout'])->name('user.pesanan.checkout.simpan');

    Route::get('/pesanan/invoice/{id_pesanan}', [UserPesananController::class, 'invoice'])->name('user.pesanan.invoice');
    Route::get('/pesanan/riwayat', [UserPesananController::class, 'riwayat'])->name('temp.pesanan.riwayat'); // Ini masih ada temp, perlu dikonfirmasi
    Route::get('/pesanan/riwayat-pesanan', [RiwayatUserController::class, 'index'])->name('pesanan.riwayat');
    Route::post('/pesanan/{id}/selesai', [RiwayatUserController::class, 'updateStatus'])->name('pesanan.selesai');
});

// API ROUTES
Route::prefix('api')->group(function () {
    Route::get('/provinsi', [ProvinsiController::class, 'getAllProvinsi']);
    Route::get('/kabupaten/{provinsiId}', [KabupatenController::class, 'getKabupatenByProvinsi']);
    Route::get('/kecamatan/{kabupatenId}', [KecamatanController::class, 'getKecamatanByKabupaten']);
    Route::get('/kecamatan', [KecamatanController::class, 'index']);
});
