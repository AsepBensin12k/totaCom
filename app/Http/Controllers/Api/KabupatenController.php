<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kabupaten;
use Illuminate\Http\JsonResponse;

class KabupatenController extends Controller
{
    public function getKabupatenByProvinsi($provinsiId): JsonResponse
    {
        $kabupaten = Kabupaten::where('id_provinsi', $provinsiId)
            ->where(function ($query) {
                $query->where('nama_kabupaten', 'KABUPATEN JEMBER');
            })
            ->get(['id_kabupaten', 'nama_kabupaten']);

        return response()->json($kabupaten);
    }
}
