<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\KecamatanController;
use App\Http\Controllers\Api\KabupatenController;
use App\Http\Controllers\Api\ProvinsiController;


Route::get('/provinsi', [ProvinsiController::class, 'getAllProvinsi']);
Route::get('kabupaten/{provinsiId}', [KabupatenController::class, 'getKabupatenByProvinsi']);
Route::get('/kecamatan/{kabupatenId}', [KecamatanController::class, 'getKecamatanByKabupaten']);
Route::get('/kecamatan', [KecamatanController::class, 'index']);
