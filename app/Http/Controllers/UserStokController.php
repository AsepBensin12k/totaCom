<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Jenis;

class UserStokController extends Controller
{
    // Menampilkan produk kepada customer dengan fitur pencarian dan filter jenis
    public function index(Request $request)
    {
        $query = Produk::with('jenis');

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;

            $query->where('nama_produk', 'like', "%{$search}%")
                  ->orWhereHas('jenis', function ($q) use ($search) {
                      $q->where('nama_jenis', 'like', "%{$search}%");
                  });
        }

        if ($request->has('filter_jenis') && $request->filter_jenis != '') {
            $query->where('id_jenis', $request->filter_jenis);
        }

        $produks = $query->get();
        $kategori = Jenis::all();

        return view('user.produk.index', compact('produks', 'kategori'));
    }
}
