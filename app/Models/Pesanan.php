<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;

    protected $table = 'pesanans';
    protected $primaryKey = 'id_pesanan';
    public $timestamps = false;

    protected $fillable = [
        'tanggal', 'id_status', 'id_metode', 'id_akun', 'id_produk', 'jumlah_produk',
    ];

    // Relasi dengan Status
    public function status()
    {
        return $this->belongsTo(Status::class, 'id_status', 'id_status');
    }

    // Relasi dengan Metode Pembayaran
    public function metodePembayaran()
    {
        return $this->belongsTo(MetodePembayaran::class, 'id_metode', 'id_metode');
    }

    // Relasi dengan Akun
    public function akun()
    {
        return $this->belongsTo(Akun::class, 'id_akun', 'id_akun');
    }

    // Relasi dengan Produk
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk', 'id_produk');
    }

    // Relasi dengan Detail Pesanan
    public function detailPesanans()
    {
        return $this->hasMany(DetailPesanan::class, 'id_pesanan', 'id_pesanan');
    }
}
