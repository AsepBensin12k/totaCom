<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\KabupatenController;
use App\Http\Controllers\Api\KecamatanController;
use App\Http\Controllers\Api\ProvinsiController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\AnalisaProdukController;
use App\Http\Controllers\DataAkunController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\ManajemenPesananController;

Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard.dashboard');
    })->name('dashboard');

    Route::get('/user/dashboard', function () {
        return view('user.dashboard.dashboard');
    })->name('user.dashboard');

    Route::get('/analisa', [AnalisaProdukController::class, 'index'])->name('analisa.index');
    Route::get('/analisa/grafik', [AnalisaProdukController::class, 'grafik'])->name('analisa.grafik');

    Route::get('/data-akun', [DataAkunController::class, 'index'])->name('data_akun.index');

    Route::get('/profile', [ProfilController::class, 'index'])->name('profile.index');
    Route::put('/profile', [ProfilController::class, 'update'])->name('profile.update');


    Route::prefix('admin/pesanan')->group(function () {
        Route::get('/produk', [PesananController::class, 'index'])->name('pesanan.index');
        Route::post('/produk/tambah/{id_produk}', [PesananController::class, 'tambahKeranjang'])->name('pesanan.tambahKeranjang');
        Route::get('/keranjang', [PesananController::class, 'keranjang'])->name('keranjang.index');
        Route::post('/keranjang/tambah-qty', [PesananController::class, 'tambahQty'])->name('keranjang.tambahQty');
        Route::post('/keranjang/kurang-qty', [PesananController::class, 'kurangQty'])->name('keranjang.kurangQty');
        Route::post('/keranjang/hapus', [PesananController::class, 'hapusKeranjang'])->name('keranjang.hapus');
        Route::post('/keranjang/checkout', [PesananController::class, 'checkout'])->name('keranjang.checkout');
        Route::get('/pesanan/invoice/{id_pesanan}', [PesananController::class, 'invoice'])->name('pesanan.invoice');
    });


    Route::get('/admin/manajemen-pesanan', [ManajemenPesananController::class, 'index'])->name('manajemen.pesanan.index');
    Route::post('/admin/manajemen-pesanan/update-status/{id}', [ManajemenPesananController::class, 'updateStatus'])->name('manajemen.pesanan.updateStatus');
});

Route::prefix('api')->group(function () {
    Route::get('/provinsi', [ProvinsiController::class, 'getAllProvinsi']);
    Route::get('/kabupaten/{provinsiId}', [KabupatenController::class, 'getKabupatenByProvinsi']);
    Route::get('/kecamatan/{kabupatenId}', [KecamatanController::class, 'getKecamatanByKabupaten']);
    Route::get('/kecamatan', [KecamatanController::class, 'index']);
});

Route::resource('stok', StokController::class);
