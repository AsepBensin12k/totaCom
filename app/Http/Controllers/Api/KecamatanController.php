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
            ->get(['id', 'nama_kecamatan']);
        return response()->json($kecamatan);
    }
}
