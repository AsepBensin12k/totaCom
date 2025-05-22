<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class PesananController extends Controller
{

    public function index(Request $request)
    {
        $query = Produk::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('nama_produk', 'like', "%{$search}%")
                ->orWhereHas('jenis', function ($q) use ($search) {
                    $q->where('nama_jenis', 'like', "%{$search}%");
                });
        }

        if ($request->filled('filter_jenis')) {
            $query->where('id_jenis', $request->input('filter_jenis'));
        }

        $produks = $query->paginate(12)->withQueryString();

        return view('admin.pesanan.index', compact('produks'));
    }


    public function keranjang()
    {
        $keranjang = session('keranjang', []);
        return view('admin.pesanan.keranjang', compact('keranjang'));
    }

    public function tambahKeranjang(Request $request, $id_produk)
    {
        $request->validate(['qty' => 'required|integer|min:1']);

        $produk = Produk::findOrFail($id_produk);

        $keranjang = session('keranjang', []);

        $qtySekarang = $keranjang[$id_produk]['qty'] ?? 0;
        $qtyBaru = $qtySekarang + $request->qty;

        if ($qtyBaru > $produk->stok) {
            return back()->with('error', 'Jumlah melebihi stok yang tersedia');
        }

        $keranjang[$id_produk] = [
            'id_produk' => $id_produk,
            'nama_produk' => $produk->nama_produk,
            'harga' => $produk->harga,
            'qty' => $qtyBaru,
        ];

        session(['keranjang' => $keranjang]);

        return back()->with('success', 'Produk berhasil ditambahkan ke keranjang');
    }

    // Tambahkan method untuk increment dan decrement langsung
    public function tambahQty(Request $request)
    {
        $request->validate(['id_produk' => 'required|exists:produks,id_produk']);

        $keranjang = session('keranjang', []);
        $produk = Produk::findOrFail($request->id_produk);

        if (isset($keranjang[$request->id_produk])) {
            $qtyBaru = $keranjang[$request->id_produk]['qty'] + 1;
            if ($qtyBaru > $produk->stok) {
                return back()->with('error', 'Jumlah melebihi stok');
            }
            $keranjang[$request->id_produk]['qty'] = $qtyBaru;
            session(['keranjang' => $keranjang]);
        }

        return back()->with('success', 'Jumlah produk bertambah');
    }

    public function kurangQty(Request $request)
    {
        $request->validate(['id_produk' => 'required|exists:produks,id_produk']);

        $keranjang = session('keranjang', []);

        if (isset($keranjang[$request->id_produk])) {
            $qtySekarang = $keranjang[$request->id_produk]['qty'];

            if ($qtySekarang > 1) {
                $keranjang[$request->id_produk]['qty'] = $qtySekarang - 1;
                session(['keranjang' => $keranjang]);
                return back()->with('success', 'Jumlah produk dikurangi');
            } else {
                unset($keranjang[$request->id_produk]);
                session(['keranjang' => $keranjang]);
                return back()->with('success', 'Produk dihapus dari keranjang');
            }
        }

        return back();
    }

    public function hapusKeranjang(Request $request)
    {
        $request->validate([
            'id_produk' => 'required|exists:produks,id_produk',
        ]);

        $keranjang = session('keranjang', []);

        if (isset($keranjang[$request->id_produk])) {
            unset($keranjang[$request->id_produk]);
            session(['keranjang' => $keranjang]);
        }

        return back()->with('success', 'Produk berhasil dihapus dari keranjang');
    }

    public function checkout(Request $request)
    {
        $request->validate([
            'metode_pembayaran' => 'required|in:cash,transfer',
        ]);


        $metode = $request->metode_pembayaran;
        $keranjang = session('keranjang', []);

        if (empty($keranjang)) {
            return back()->with('error', 'Keranjang kosong.');
        }

        // TODO: Implementasi pembayaran dan simpan pesanan ke DB sesuai metode pembayaran
        // Untuk sekarang, hanya hapus keranjang dan kasih flash message

        session()->forget('keranjang');

        return back()->with('success', "Checkout berhasil dengan metode pembayaran: $metode");
    }
}
