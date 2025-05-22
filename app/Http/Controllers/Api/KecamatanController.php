<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kecamatan;
use Illuminate\Http\JsonResponse;

class KecamatanController extends Controller
{
    public function getKecamatanByKabupaten($kabupatenId): JsonResponse
    {
        $kecamatan = Kecamatan::where('id_kabupaten', $kabupatenId)
            ->get(['id_kecamatan', 'nama_kecamatan']);

        return response()->json($kecamatan);
    }

    public function index()
    {
        $kecamatans = Kecamatan::all();
        return response()->json($kecamatans);
    }
}
