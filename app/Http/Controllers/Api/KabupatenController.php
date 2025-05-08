<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kabupaten;

class KabupatenController extends Controller
{
    public function getKabupatenByProvinsi($provinsiId)
    {
        $kabupaten = Kabupaten::where('id_provinsi', $provinsiId)->get(['id_kabupaten as id', 'nama_kabupaten']);

        return response()->json($kabupaten);
    }
}
