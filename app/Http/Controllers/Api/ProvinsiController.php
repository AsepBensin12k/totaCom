<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Provinsi;
use Illuminate\Http\JsonResponse;

class ProvinsiController extends Controller
{
    public function getAllProvinsi(): JsonResponse
    {
        $provinsis = Provinsi::select('id_provinsi', 'nama_provinsi')->get();
        return response()->json($provinsis);
    }
}
