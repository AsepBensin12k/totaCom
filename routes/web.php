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
        return view('user.dashboard');
    })->name('user.dashboard');

    Route::get('/analisa', [AnalisaProdukController::class, 'index'])->name('analisa.index');
    Route::get('/analisa/grafik', [AnalisaProdukController::class, 'grafik'])->name('analisa.grafik');

    Route::get('/data-akun', [DataAkunController::class, 'index'])->name('data_akun.index');

    Route::get('/profile', [ProfilController::class, 'index'])->name('profile.index');
    Route::put('/profile', [ProfilController::class, 'update'])->name('profile.update');
});

Route::prefix('api')->group(function () {
    Route::get('/provinsi', [ProvinsiController::class, 'getAllProvinsi']);
    Route::get('/kabupaten/{provinsiId}', [KabupatenController::class, 'getKabupatenByProvinsi']);
    Route::get('/kecamatan/{kabupatenId}', [KecamatanController::class, 'getKecamatanByKabupaten']);
    Route::get('/kecamatan', [KecamatanController::class, 'index']);
});

Route::resource('stok', StokController::class);
