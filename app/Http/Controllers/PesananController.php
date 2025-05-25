<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Pesanan;
use App\Models\DetailPesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        $user = Auth::user();
        $isAdmin = $user->role === 'admin';

        if ($isAdmin) {
            // Admin menggunakan session keranjang
            $keranjang = session('keranjang', []);
        } else {
            // Customer menggunakan database keranjang (implementasi sesuai kebutuhan)
            // Untuk sementara tetap menggunakan session, tapi bisa diubah ke database
            $keranjang = session('keranjang', []);
        }

        return view('admin.pesanan.keranjang', compact('keranjang', 'isAdmin'));
    }

    public function tambahKeranjang(Request $request, $id_produk)
    {
        $request->validate(['qty' => 'required|integer|min:1']);

        $produk = Produk::findOrFail($id_produk);
        $user = Auth::user();
        $isAdmin = $user->role === 'admin';

        if ($isAdmin) {
            // Admin menggunakan session keranjang
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
        } else {
            // Customer bisa menggunakan database atau session persistent
            // Untuk implementasi database, buat model Keranjang dan simpan ke database
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
        }

        return back()->with('success', 'Produk berhasil ditambahkan ke keranjang');
    }

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

        $keranjang = session('keranjang', []);

        if (empty($keranjang)) {
            return redirect()->route('keranjang.index')->with('error', 'Keranjang kosong');
        }

        $user = Auth::user();
        $isAdmin = $user->id_role === 1;

        DB::beginTransaction();

        try {
            $total = 0;
            foreach ($keranjang as $item) {
                $total += $item['qty'] * $item['harga'];
            }

            $pesanan = Pesanan::create([
                'id_akun' => $user->id_akun,
                'tanggal' => now(),
                'total' => $total,
                'id_metode' => $this->getMetodePembayaranId($request->metode_pembayaran),
                'id_status' => $isAdmin ? 3 : 1,
            ]);

            // Simpan detail pesanan dan update stok
            foreach ($keranjang as $item) {
                // Ambil produk untuk update stok
                $produk = Produk::findOrFail($item['id_produk']);

                // Cek stok tersedia
                if ($produk->stok < $item['qty']) {
                    throw new \Exception("Stok produk {$produk->nama_produk} tidak mencukupi");
                }

                // Buat detail pesanan
                DetailPesanan::create([
                    'id_pesanan' => $pesanan->id_pesanan,
                    'id_produk' => $item['id_produk'],
                    'qty' => $item['qty'],
                    'harga' => $item['harga'],
                    'subtotal' => $item['qty'] * $item['harga'],
                ]);

                // Update stok produk
                $produk->decrement('stok', $item['qty']);
            }

            // Hapus keranjang dari session
            session()->forget('keranjang');

            DB::commit();

            // Redirect ke invoice
            if ($isAdmin) {
                return redirect()->route('pesanan.invoice', $pesanan->id_pesanan)
                    ->with('success', 'Pesanan berhasil diselesaikan');
            } else {
                return redirect()->route('pesanan.invoice', $pesanan->id_pesanan)
                    ->with('success', 'Pesanan berhasil dibuat dan menunggu konfirmasi');
            }
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('keranjang.index')
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Helper method untuk mendapatkan ID metode pembayaran
     */
    private function getMetodePembayaranId($metode)
    {
        $metodePembayaran = [
            'transfer' => 1,
            'cash' => 2,
        ];

        return $metodePembayaran[$metode] ?? 1;
    }

    public function invoice($id_pesanan)
    {
        $pesanan = Pesanan::with([
            'detailPesanans.produk',
            'akun',
            'status',
            'metodePembayaran'
        ])->findOrFail($id_pesanan);

        return view('admin.pesanan.invoice', compact('pesanan'));
    }
}
