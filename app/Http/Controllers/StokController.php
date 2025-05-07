<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Models\Jenis;

class StokController extends Controller
{
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
    
        return view('admin.stok.index', compact('produks'));
    }
    

    public function create()
    {
        $jenisProduks = Jenis::all();
        return view('admin.stok.create', compact('jenisProduks'));
    }

    public function store(Request $request)
    {
        Log::info('Semua file dari form:', $request->allFiles());

        $request->validate([
            'nama_produk' => 'required|unique:produks,nama_produk',
            'stok' => 'required|integer',
            'harga' => 'required|integer',
            'id_jenis' => 'required|exists:jenises,id_jenis',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $data = $request->only(['nama_produk', 'harga', 'stok', 'id_jenis']);

        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('produk_gambar', 'public');
            $data['gambar'] = $gambarPath;
            Log::info('File berhasil diupload: ' . $gambarPath);
        } else {
            Log::warning('Tidak ada gambar diunggah!');
        }

        Produk::create($data);
        return redirect()->route('stok.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $produk = Produk::findOrFail($id);
        $jenisProduks = Jenis::all();
        return view('admin.stok.edit', compact('produk', 'jenisProduks'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_produk' => 'required|unique:produks,nama_produk,' . $id . ',id_produk',
            'stok' => 'required|integer|min:0',
            'harga' => 'required|numeric|min:0',
            'id_jenis' => 'required|exists:jenises,id_jenis',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'remove_image' => 'nullable|boolean'
        ]);

        $produk = Produk::findOrFail($id);
        $data = $request->only(['nama_produk', 'harga', 'stok', 'id_jenis']);

        if ($request->hasFile('gambar')) {
            if ($produk->gambar) {
                Storage::disk('public')->delete($produk->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('produk_gambar', 'public');
        } elseif ($request->input('remove_image')) {
            if ($produk->gambar) {
                Storage::disk('public')->delete($produk->gambar);
            }
            $data['gambar'] = null;
        }

        $produk->update($data);

        return redirect()->route('stok.index')->with('success', 'Produk berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);

        if ($produk->gambar) {
            Storage::disk('public')->delete($produk->gambar);
        }

        $produk->delete();

        return redirect()->route('stok.index')->with('success', 'Produk berhasil dihapus!');
    }
}
