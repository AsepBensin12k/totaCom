<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Provinsi;
use Illuminate\Http\JsonResponse;

class ProvinsiController extends Controller
{
    public function getAllProvinsi(): JsonResponse
    {
        $provinsis = Provinsi::all(['id_provinsi as id', 'nama_provinsi']);
        return response()->json($provinsis);
    }
}
