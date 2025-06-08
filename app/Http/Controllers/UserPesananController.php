<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Pesanan;
use App\Models\DetailPesanan;
use App\Models\Keranjang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserPesananController extends Controller
{
    public function pesananIndex(Request $request)
    {
        $query = Produk::query();

        if ($request->filled('search')) {
            $query->where('nama_produk', 'like', "%{$request->search}%")
                ->orWhereHas('jenis', fn($q) => $q->where('nama_jenis', 'like', "%{$request->search}%"));
        }

        if ($request->filled('filter_jenis')) {
            $query->where('id_jenis', $request->filter_jenis);
        }

        $produks = $query->paginate(12)->withQueryString();

        return view('user.pesanan.index', compact('produks'));
    }

    public function pesananKeranjang()
    {
        $userId = Auth::id();

        $keranjangItems = Keranjang::with('produk')
            ->where('id_akun', $userId)
            ->get();

        $keranjang = $keranjangItems->map(function ($item) {
            if (!$item->produk) return null;

            return [
                'id_produk' => $item->produk->id_produk,
                'nama_produk' => $item->produk->nama_produk,
                'harga' => $item->produk->harga,
                'qty' => $item->jumlah_produk,
            ];
        })->filter();

        return view('user.pesanan.keranjang', compact('keranjang'));
    }


    public function tambahKeranjang(Request $request, $id_produk)
    {
        $request->validate(['qty' => 'required|integer|min:1']);
        $userId = Auth::id();
        $produk = Produk::findOrFail($id_produk);

        $keranjang = Keranjang::firstOrNew([
            'id_akun' => $userId,
            'id_produk' => $id_produk
        ]);

        $jumlahBaru = $keranjang->jumlah_produk + $request->qty;
        if ($jumlahBaru > $produk->stok) {
            return back()->with('error', 'Jumlah melebihi stok tersedia');
        }

        $keranjang->jumlah_produk = $jumlahBaru;
        $keranjang->save();

        return back()->with('success', 'Produk ditambahkan ke keranjang');
    }

    public function tambahQty(Request $request)
    {
        $keranjang = Keranjang::where('id_akun', Auth::id())->where('id_produk', $request->id_produk)->firstOrFail();
        $produk = $keranjang->produk;

        if ($keranjang->jumlah_produk + 1 > $produk->stok) {
            return back()->with('error', 'Stok tidak mencukupi');
        }

        $keranjang->increment('jumlah_produk');
        return back()->with('success', 'Jumlah produk ditambah');
    }

    public function kurangQty(Request $request)
    {
        $keranjang = Keranjang::where('id_akun', Auth::id())->where('id_produk', $request->id_produk)->firstOrFail();

        if ($keranjang->jumlah_produk > 1) {
            $keranjang->decrement('jumlah_produk');
        } else {
            $keranjang->delete();
        }

        return back()->with('success', 'Jumlah produk dikurangi');
    }

    public function hapusKeranjang(Request $request)
    {
        Keranjang::where('id_akun', Auth::id())->where('id_produk', $request->id_produk)->delete();

        return back()->with('success', 'Produk dihapus dari keranjang');
    }

    public function checkoutForm(Request $request)
    {
        $selectedProduk = $request->input('selected_produk', []);
        $keranjang = Keranjang::with('produk')
            ->where('id_akun', Auth::id())
            ->whereIn('id_produk', $selectedProduk)
            ->get();

        if ($keranjang->isEmpty()) {
            return back()->with('error', 'Tidak ada produk yang dipilih');
        }

        session(['checkout_items' => $keranjang->toArray()]);

        return view('user.pesanan.checkout.index', [
            'checkoutItems' => $keranjang
        ]);
    }

public function checkout(Request $request)
{
    $request->validate([
        'metode_pembayaran' => 'required|in:cash,transfer',
        'bukti_pembayaran' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
    ]);

    $checkoutItems = session('checkout_items', []);

    if (empty($checkoutItems)) {
        return redirect()->route('pesanan.keranjang')->with('error', 'Tidak ada item untuk di-checkout');
    }

    $userId = Auth::id();

    DB::beginTransaction();

    try {
        $total = collect($checkoutItems)->sum(fn($item) => $item['jumlah_produk'] * $item['produk']['harga']);


        $buktiPembayaranPath = null;
        if ($request->metode_pembayaran === 'transfer' && $request->hasFile('bukti_pembayaran')) {
            $buktiPembayaranPath = $request->file('bukti_pembayaran')->store('bukti', 'public');
        }

        $pesanan = Pesanan::create([
            'id_akun' => $userId,
            'tanggal' => now(),
            'total' => $total,
            'id_metode' => $this->getMetodePembayaranId($request->metode_pembayaran),
            'id_status' => 1, // status "Dikemas"
            'bukti_pembayaran' => $buktiPembayaranPath
        ]);

        foreach ($checkoutItems as $item) {
            $produk = Produk::findOrFail($item['id_produk']);

            if ($produk->stok < $item['jumlah_produk']) {
                throw new \Exception("Stok {$produk->nama_produk} tidak cukup");
            }

            DetailPesanan::create([
                'id_pesanan' => $pesanan->id_pesanan,
                'id_produk' => $item['id_produk'],
                'qty' => $item['jumlah_produk'],
                'harga' => $produk->harga,
                'subtotal' => $item['jumlah_produk'] * $produk->harga,
            ]);

            $produk->decrement('stok', $item['jumlah_produk']);

            Keranjang::where('id_akun', $userId)
                ->where('id_produk', $item['id_produk'])
                ->delete();
        }

        session()->forget('checkout_items');
        DB::commit();

        return redirect()->route('user.pesanan.invoice', $pesanan->id_pesanan)
            ->with('success', 'Pesanan berhasil dibuat');
    } catch (\Exception $e) {
        DB::rollBack();
        return redirect()->route('pesanan.keranjang')->with('error', 'Gagal checkout: ' . $e->getMessage());
    }
}

    public function invoice($id_pesanan)
    {
        $pesanan = Pesanan::with(['detailPesanans.produk', 'akun', 'status', 'metodePembayaran'])
            ->findOrFail($id_pesanan);

        return view('user.pesanan.invoice', compact('pesanan'));
    }

    private function getMetodePembayaranId($metode)
    {
        return [
            'transfer' => 1,
            'cash' => 2,
        ][$metode] ?? 1;
    }

    public function hapusMultiple(Request $request)
    {
    $selectedProduk = $request->input('selected_produk', []);

    if (empty($selectedProduk)) {
        return back()->with('error', 'Tidak ada produk yang dipilih untuk dihapus');
    }

    Keranjang::where('id_akun', Auth::id())
            ->whereIn('id_produk', $selectedProduk)
            ->delete();

    return back()->with('success', 'Produk berhasil dihapus dari keranjang');
    }



}
