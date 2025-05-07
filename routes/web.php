<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\KabupatenController;
use App\Http\Controllers\Api\KecamatanController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\AnalisaProdukController;


Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/api/kabupaten/{provinsiId}', [KabupatenController::class, 'getKabupaten']);
Route::get('/api/kecamatan/{kabupatenId}', [KecamatanController::class, 'getKecamatan']);

Route::get('/', function () {return redirect()->route('login');});

Route::get('/dashboard', function () {return view('admin.dashboard.dashboard');})->middleware('auth')->name('dashboard');

Route::get('/analisa', [AnalisaProdukController::class, 'index'])->middleware('auth')->name('analisa.index');
Route::get('/analisa/grafik', [AnalisaProdukController::class, 'grafik'])->middleware('auth')->name('analisa.grafik');

Route::resource('stok', StokController::class);

require base_path('routes/api.php');

