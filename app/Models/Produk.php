<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produks';
    protected $primaryKey = 'id_produk';
    public $timestamps = true;

    protected $fillable = [
        'nama_produk',
        'gambar',
        'harga',
        'stok',
        'id_jenis',
    ];

    public function jenis()
    {
        return $this->belongsTo(Jenis::class, 'id_jenis', 'id_jenis');
    }

    // Relasi dengan Keranjang
    public function keranjangs()
    {
        return $this->hasMany(Keranjang::class, 'id_produk', 'id_produk');
    }

    // Relasi dengan Detail Pesanan
    public function detailPesanans()
    {
        return $this->hasMany(DetailPesanan::class, 'id_produk', 'id_produk');
    }
}
